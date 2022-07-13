<?php

namespace Laraflow\TripleA\Services\Auth;

use function back;
use Illuminate\Http\Request;
use Laraflow\TripleA\Providers\RouteServiceProvider;
use function redirect;

class EmailVerificationNotificationService
{
    /**
     * Send a new email verification notification.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        if ($request->user()->hasVerifiedEmail()) {
            return redirect()->intended(RouteServiceProvider::HOME);
        }

        $request->user()->sendEmailVerificationNotification();

        return back()->with('status', 'verification-link-sent');
    }
}
