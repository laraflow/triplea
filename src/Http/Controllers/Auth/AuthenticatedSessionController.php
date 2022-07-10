<?php

namespace Laraflow\TripleA\Http\Controllers\Auth;

use Laraflow\TripleA\Http\Controllers\Controller;
use Laraflow\TripleA\Http\Requests\Auth\LoginRequest;
use Laraflow\TripleA\Services\Auth\AuthenticatedSessionService;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

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
    public function create(): View
    {
        return view('auth.login');
    }

    /**
     * Handle an incoming auth request.
     *
     * @param LoginRequest $request
     * @return RedirectResponse
     */
    public function store(LoginRequest $request): RedirectResponse
    {
        $confirm = $this->authenticatedSessionService->attemptLogin($request);

        \Log::info("Login Info Tapping", $confirm);
        if ($confirm['status'] === true) {
            Session::put('locale', 'bd');
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
    public function destroy(Request $request): RedirectResponse
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
