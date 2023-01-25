<?php

namespace Laraflow\TripleA\Services\Auth;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laraflow\Core\Supports\Constant;

/**
 * Class AuthenticatedSessionService
 * @package Laraflow\TripleA\Services\Auth
 */
class AuthenticatedSessionService
{
    /**
     * @var PasswordResetService
     */
    private $passwordResetService;

    /**
     * @param PasswordResetService $passwordResetService
     * @return void
     */
    public function __construct(PasswordResetService $passwordResetService)
    {
        $this->passwordResetService = $passwordResetService;
    }

    /**
     * Handle an incoming auth request.
     *
     * @param array $request
     * @return array
     */
    public function attemptLogin(array $request): array
    {
        return $this->authenticate($request);
    }

    /**
     * Verify that current request user is who he claim to be
     *
     * @param Request $request
     * @return bool
     */
    public function validate(Request $request): bool
    {
        if (config('auth.credential_field') != Constant::LOGIN_OTP) {
            $credentials = [];

            if (config('auth.credential_field') == Constant::LOGIN_EMAIL
                || (config('auth.credential_field') == Constant::LOGIN_OTP
                    && config('auth.credential_otp_field') == Constant::OTP_EMAIL)) {
                $credentials['email'] = $request->user()->email;
            } elseif (config('auth.credential_field') == Constant::LOGIN_MOBILE
                || (config('auth.credential_field') == Constant::LOGIN_OTP
                    && config('auth.credential_otp_field') == Constant::OTP_MOBILE)) {
                $credentials['mobile'] = $request->user()->mobile;
            } elseif (config('auth.credential_field') == Constant::LOGIN_USERNAME) {
                $credentials['username'] = $request->user()->username;
            }

            //Password Field
            $credentials['password'] = $request->password;

            return Auth::guard('web')->validate($credentials);
        } else {
            return true;
        }
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return array
     */
    public function attemptLogout(Request $request): array
    {
        try {
            Auth::logout();

            $request->session()->invalidate();

            $request->session()->regenerateToken();

            return ['status' => true, 'message' => 'User Logout Successful',
                'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification!', ];
        } catch (\Exception $exception) {
            return ['status' => false, 'message' => 'Error: ' . $exception->getMessage(),
                'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Error!', ];
        }
    }

    /**
     * Verify is current user is super admin
     * @return bool
     */
    public static function isSuperAdmin(): bool
    {
        if ($authUser = Auth::user()) {
            return ($authUser->hasRole(Constant::SUPER_ADMIN_ROLE));
        }

        return false;
    }

    /**
     * decided is if user status is disabled
     * @return bool
     */
    public static function isUserEnabled(): bool
    {
        if ($authUser = Auth::user()) {
            return ($authUser->enabled == Constant::ENABLED_OPTION);
        }

        return false;
    }

    /**
     * if user has to reset password forced
     *
     * @return bool
     */
    public function hasForcePasswordReset(): bool
    {
        if ($authUser = Auth::user()) {
            return (bool)$authUser->force_pass_reset;
        }

        return false;
    }

    /**
     * Attempt to authenticate the request's credentials.
     *
     * @param array $request
     * @return array
     */
    private function authenticate(array $request): array
    {
        //Format config based request value
        $authInfo = $this->formatAuthCredential($request);

        $remember_me = $request['remember'] ?? false;

        $confirmation = ['status' => false,
            'message' => __('auth.login.failed'),
            'level' => Constant::MSG_TOASTR_ERROR,
            'title' => 'Alert!', ];


        //authentication is OTP
        $confirmation = (! isset($authInfo['password']))
            ? $this->otpBasedLogin($authInfo, $remember_me)
            : $this->credentialBasedLogin($authInfo, $remember_me);

        if ($confirmation['status'] === true) {
            //is user is banned to log in
            if (! self::isUserEnabled()) {
                //logout from all guard
                Auth::logout();
                $confirmation = ['status' => false,
                    'message' => __('auth.login.banned'),
                    'level' => Constant::MSG_TOASTR_WARNING,
                    'title' => 'Alert!', ];
            } elseif ($this->hasForcePasswordReset()) {
                //make this user as guest to reset password
                Auth::logout();

                //create reset token
                $tokenInfo = $this->passwordResetService->createPasswordResetToken($authInfo);

                //reset message
                $confirmation = ['status' => true,
                    'message' => __('auth.login.forced'),
                    'level' => Constant::MSG_TOASTR_WARNING,
                    'title' => 'Notification!',
                    'landing_page' => route('auth.password.reset', $tokenInfo['token']), ];
            } else {
                //set the auth user redirect page
                $confirmation['landing_page'] = (Auth::user()->home_page ?? Constant::DASHBOARD_ROUTE);
            }
        }

        return $confirmation;
    }

    /**
     * @param array $credential
     * @param bool $remember_me
     * @return array
     */
    private function credentialBasedLogin(array $credential, bool $remember_me = false): array
    {
        $confirmation = ['status' => false, 'message' => __('auth.login.failed'), 'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];

        if (Auth::attempt($credential, $remember_me)) {
            $confirmation = ['status' => true, 'message' => __('auth.login.success'), 'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification'];
        }

        return $confirmation;
    }

    /**
     * @param array $credential
     * @param bool $remember_me
     * @return array
     */
    private function otpBasedLogin(array $credential, bool $remember_me = false): array
    {
        $confirmation = ['status' => false, 'message' => __('auth.login.failed'), 'level' => Constant::MSG_TOASTR_ERROR, 'title' => 'Alert!'];

        if (Auth::attempt($credential, $remember_me)) {
            $confirmation = ['status' => true, 'message' => __('auth.login.success'), 'level' => Constant::MSG_TOASTR_SUCCESS, 'title' => 'Notification'];
        }

        return $confirmation;
    }

    /**
     * Collect Credential Info from Request based on Config
     *
     * @param array $request
     * @return array
     */
    private function formatAuthCredential(array $request): array
    {
        $credentials = [];

        if (config('auth.credential_field') == Constant::LOGIN_EMAIL
            || (config('auth.credential_field') == Constant::LOGIN_OTP
                && config('auth.credential_otp_field') == Constant::OTP_EMAIL)) {
            $credentials['email'] = $request['email'] ?? null;
        } elseif (config('auth.credential_field') == Constant::LOGIN_MOBILE
            || (config('auth.credential_field') == Constant::LOGIN_OTP
                && config('auth.credential_otp_field') == Constant::OTP_MOBILE)) {
            $credentials['mobile'] = $request['mobile'] ?? null;
        } elseif (config('auth.credential_field') == Constant::LOGIN_USERNAME) {
            $credentials['username'] = $request['username'] ?? null;
        }

        //Password Field
        if (config('auth.credential_field') != Constant::LOGIN_OTP) {
            $credentials['password'] = $request['password'] ?? null;
        }

        return $credentials;
    }
}
