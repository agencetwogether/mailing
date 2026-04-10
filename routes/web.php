<?php

use Agencetwogether\Mailing\Http\Controllers\ConfirmSubscriptionController;
use Agencetwogether\Mailing\Http\Controllers\SubscriptionController;
use Illuminate\Support\Facades\Route;

Route::middleware(['web'])
    ->group(function () {
        Route::get('/inscription/newsletter', SubscriptionController::class)
            ->name('mailing.subscription');

        Route::get('/confirmation/inscription/newsletter', ConfirmSubscriptionController::class)
            ->name('mailing.confirm')
            ->middleware('signed');
    });
