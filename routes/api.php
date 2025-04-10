<?php

use App\Http\Controllers\Api\ChargeController;
use App\Http\Controllers\Api\CustomerController;
use App\Http\Controllers\Api\PaymentIntentController;
use App\Http\Controllers\Api\PaymentLinkController;
use App\Http\Controllers\Api\PaymentMethodController;
use App\Http\Controllers\Api\PriceController;
use App\Http\Controllers\Api\RefundController;
use App\Http\Controllers\Api\SetupIntentController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::middleware(['auth:sanctum'])->get('/user', function (Request $request) {
    return $request->user();
    Route::prefix('customer')->group(function () {
        Route::post('/create', [CustomerController::class, 'create']);
        Route::post('/update', [CustomerController::class, 'update']);
        Route::get('/retrieve/{customer_id}', [CustomerController::class, 'retrieve']);
        Route::delete('/delete/{customer_id}', [CustomerController::class, 'delete']);
        Route::get('/list', [CustomerController::class, 'list']);
        Route::get('/search', [CustomerController::class, 'search']);
    });


    Route::prefix('charge')->group(function () {
        Route::post('/create', [ChargeController::class, 'create']);
        Route::post('/update', [ChargeController::class, 'update']);
        Route::get('/retrieve/{charge_id}', [ChargeController::class, 'retrieve']);
        Route::get('/list', [ChargeController::class, 'list']);
        Route::post('/capture', [ChargeController::class, 'capture']);
        Route::post('/cancel', [ChargeController::class, 'cancel']);
        Route::get('/search', [ChargeController::class, 'search']);
    });

    Route::prefix('setup-intent')->group(function () {
        // Create a SetupIntent
        Route::post('/create', [SetupIntentController::class, 'create']);

        // Retrieve a SetupIntent by ID
        Route::post('/retrieve', [SetupIntentController::class, 'retrieve']);

        // Update a SetupIntent
        Route::post('/update', [SetupIntentController::class, 'update']);

        // Cancel a SetupIntent
        Route::post('/cancel', [SetupIntentController::class, 'cancel']);

        // Confirm a SetupIntent
        Route::post('/confirm', [SetupIntentController::class, 'confirm']);

        // Verify microdeposits for a SetupIntent
        Route::post('/verify-microdeposits', [SetupIntentController::class, 'verifyMicrodeposits']);

        // List all SetupIntents
        Route::get('/list', [SetupIntentController::class, 'list']);
    });

    Route::prefix('payment-intents')->group(function () {
        Route::post('/create', [PaymentIntentController::class, 'create']); // Create a PaymentIntent
        Route::post('/update', [PaymentIntentController::class, 'update']); // Update a PaymentIntent
        Route::get('/{payment_intent_id}', [PaymentIntentController::class, 'retrieve']); // Retrieve a PaymentIntent by ID
        Route::post('/{payment_intent_id}/cancel', [PaymentIntentController::class, 'cancel']); // Cancel a PaymentIntent
        Route::post('/{payment_intent_id}/capture', [PaymentIntentController::class, 'capture']); // Capture a PaymentIntent
        Route::post('/{payment_intent_id}/confirm', [PaymentIntentController::class, 'confirm']); // Confirm a PaymentIntent
        Route::get('/', [PaymentIntentController::class, 'list']); // List PaymentIntents
        Route::get('/search', [PaymentIntentController::class, 'search']); // Search PaymentIntents
        Route::post('/{payment_intent_id}/increment-authorization', [PaymentIntentController::class, 'incrementAuthorization']); // Increment authorization for PaymentIntent
        Route::post('/{payment_intent_id}/apply-customer-balance', [PaymentIntentController::class, 'applyCustomerBalance']); // Apply customer balance to PaymentIntent
        Route::post('/{payment_intent_id}/verify-microdeposits', [PaymentIntentController::class, 'verifyMicrodeposits']); // Verify microdeposits for PaymentIntent
    });

    Route::prefix('refund')->group(function () {
        Route::post('/create', [RefundController::class, 'create']);
        Route::post('/update', [RefundController::class, 'update']);
        Route::get('/retrieve/{refund_id}', [RefundController::class, 'retrieve']);
        Route::get('/list', [RefundController::class, 'list']);
        Route::post('/cancel/{refund_id}', [RefundController::class, 'cancel']);
    });

    Route::prefix('payment-methods')->group(function () {
        // Create a payment method
        Route::post('create', [PaymentMethodController::class, 'createPaymentMethod']);

        // Update a payment method
        Route::post('update', [PaymentMethodController::class, 'updatePaymentMethod']);

        // Retrieve a payment method
        Route::post('retrieve', [PaymentMethodController::class, 'retrievePaymentMethod']);

        // List all payment methods
        Route::post('list', [PaymentMethodController::class, 'listPaymentMethods']);

        // Attach a payment method to a customer
        Route::post('attach', [PaymentMethodController::class, 'attachPaymentMethod']);

        // Detach a payment method from a customer
        Route::post('detach', [PaymentMethodController::class, 'detachPaymentMethod']);

        // Reinstate a previously detached payment method
        Route::post('reinstate', [PaymentMethodController::class, 'reinstatePaymentMethod']);

        // Retrieve a customer's specific payment method
        Route::post('retrieve-customer', [PaymentMethodController::class, 'retrieveCustomerPaymentMethod']);

        // List all payment methods for a customer
        Route::post('list-customer', [PaymentMethodController::class, 'listCustomerPaymentMethods']);
    });

    Route::prefix('payment-links')->group(function () {
        Route::post('create', [PaymentLinkController::class, 'createPaymentLink']);
        Route::post('update', [PaymentLinkController::class, 'updatePaymentLink']);
        Route::post('retrieve', [PaymentLinkController::class, 'retrievePaymentLink']);
        Route::post('list', [PaymentLinkController::class, 'listPaymentLinks']);
        Route::post('retrieve-line-items', [PaymentLinkController::class, 'retrieveLineItems']);
        Route::post('initialise', [PaymentLinkController::class, 'initialisePaymentLink']);
    });

    Route::prefix('price')->group(function () {
        Route::post('create', [PriceController::class, 'createPrice']);
        Route::post('update', [PriceController::class, 'updatePrice']);
        Route::post('retrieve', [PriceController::class, 'retrievePrice']);
        Route::post('list', [PriceController::class, 'listPrices']);
        Route::post('search', [PriceController::class, 'searchPrices']);
    });
});
