<?php

namespace Laraflow\TripleA\Http\Controllers\Auth;;

use Laraflow\TripleA\Http\Controllers\Controller;
use Laraflow\TripleA\Http\Requests\Auth\NewPasswordRequest;
use Laraflow\TripleA\Services\Auth\NewPasswordService;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class NewPasswordController extends Controller
{
    /**
     * @var NewPasswordService
     */
    private $newPasswordService;

    /**
     * @param NewPasswordService $newPasswordService
     */
    public function __construct(NewPasswordService $newPasswordService)
    {
        $this->newPasswordService = $newPasswordService;
    }
    /**
     * Display the password reset view.
     *
     * @param Request $request
     * @return View
     */
    public function create(Request $request): View
    {

    }

    /**
     * Handle an incoming new password request.
     *
     * @param NewPasswordRequest $request
     * @return RedirectResponse
     *
     */
    public function store(NewPasswordRequest $request)
    {

    }
}
