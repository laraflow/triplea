<?php

namespace Laraflow\TripleA\Http\Controllers\Auth;

use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller;
use Laraflow\TripleA\Http\Requests\Auth\LoginRequest;
use Laraflow\TripleA\Services\Auth\AuthenticatedSessionService;

/**
 * @class AuthenticatedSessionController
 * @package Laraflow\TripleA\Http\Controllers\Auth;
 */
class AuthenticatedSessionController extends Controller
{
    /**
     * @var AuthenticatedSessionService
     */
    private $authenticatedSessionService;

    /**
     * @param AuthenticatedSessionService $authenticatedSessionService
     */
    public function __construct(AuthenticatedSessionService $authenticatedSessionService)
    {
        $this->authenticatedSessionService = $authenticatedSessionService;
    }

    /**
     * Display the login view.
     *
     * @return View
     */
    public function __invoke(): View
    {
        return view(config('triplea.view.login'));
    }

    /**
     * Handle an incoming auth request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function login(LoginRequest $request): RedirectResponse
    {
        $inputs = $request->validated();

        $confirm = $this->authenticatedSessionService->attemptLogin($inputs);

        if ($confirm['status'] === true) {
            //start Auth session
            $request->session()->regenerate();

            //session popup
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->route($confirm['landing_page']);
        }

        notify($confirm['message'], $confirm['level'], $confirm['title']);
        return redirect()->back();
    }

    /**
     * Destroy an authenticated session.
     *
     * @param Request $request
     * @return RedirectResponse
     */
    public function logout(Request $request): RedirectResponse
    {
        $confirm = $this->authenticatedSessionService->attemptLogout($request);
        if ($confirm['status'] === true) {
            notify($confirm['message'], $confirm['level'], $confirm['title']);
            return redirect()->to(route('home'));
        }

        notify($confirm['message'], $confirm['level'], $confirm['title']);
        return redirect()->back();
    }
}
