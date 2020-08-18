<?php

use codicastudio\LaravelMixpanel\Http\Controllers\StripeWebhooksController;

Route::post('codicastudio/mixpanel/stripe', StripeWebhooksController::class .'@postTransaction');
