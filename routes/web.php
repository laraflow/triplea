<?php

use Laraflow\TripleA\Http\Controllers\Auth\AuthenticatedSessionController;
use Laraflow\TripleA\Http\Controllers\Auth\ConfirmablePasswordController;
use Laraflow\TripleA\Http\Controllers\Auth\EmailVerificationNotificationController;
use Laraflow\TripleA\Http\Controllers\Auth\EmailVerificationPromptController;
use Laraflow\TripleA\Http\Controllers\Auth\PasswordResetController;
use Laraflow\TripleA\Http\Controllers\Auth\RegisteredUserController;
use Laraflow\TripleA\Http\Controllers\Auth\VerifyEmailController;
use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;
/**
 * Authentication Route
 */
Route::name('auth.')->group(function () {

    Route::get('/login', AuthenticatedSessionController::class)
        ->middleware('guest')
        ->name('login');

    Route::post('/login', [AuthenticatedSessionController::class, 'login'])
        ->middleware('guest');

    Route::match(['get', 'post'], '/logout', [AuthenticatedSessionController::class, 'logout'])
        ->middleware('auth')
        ->name('logout');

    if (Config::get('triplea.allow_register')):
        Route::get('/register', [RegisteredUserController::class, 'create'])
            ->middleware('guest')
            ->name('register');

        Route::post('/register', [RegisteredUserController::class, 'store'])
            ->middleware('guest');
    endif;

    if (Config::get('triplea.allow_password_reset')):
        Route::get('/forgot-password', [PasswordResetController::class, 'create'])
            ->middleware('guest')
            ->name('password.request');
    endif;

    Route::post('/forgot-password', [PasswordResetController::class, 'store'])
        ->middleware('guest')
        ->name('password.email');

    Route::get('/reset-password/{token}', [PasswordResetController::class, 'edit'])
        ->middleware('guest')
        ->name('password.reset');

    Route::post('/reset-password', [PasswordResetController::class, 'update'])
        ->middleware('guest')
        ->name('password.update');

    Route::get('/verify-email', [EmailVerificationPromptController::class, '__invoke'])
        ->middleware('auth')
        ->name('verification.notice');

    Route::get('/verify-email/{id}/{hash}', [VerifyEmailController::class, '__invoke'])
        ->middleware(['auth', 'signed', 'throttle:6,1'])
        ->name('verification.verify');

    Route::post('/email/verification-notification', [EmailVerificationNotificationController::class, 'store'])
        ->middleware(['auth', 'throttle:6,1'])
        ->name('verification.send');

    Route::get('/confirm-password', [ConfirmablePasswordController::class, 'show'])
        ->middleware('auth')
        ->name('password.confirm');

    Route::post('/confirm-password', [ConfirmablePasswordController::class, 'store'])
        ->middleware('auth');
});
