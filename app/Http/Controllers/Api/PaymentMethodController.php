<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Payment\PaymentServiceStrategy;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class PaymentMethodController extends Controller
{
    /**
     * Create a new payment method.
     */
    public function createPaymentMethod(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to create a payment method
        $response = $paymentService->createPaymentMethod($request->all());

        return response()->json($response);
    }

    /**
     * Update an existing payment method.
     */
    public function updatePaymentMethod(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to update a payment method
        $response = $paymentService->updatePaymentMethod($request->all());

        return response()->json($response);
    }

    /**
     * Retrieve a specific payment method by ID.
     */
    public function retrievePaymentMethod(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the payment method ID to retrieve the details
        $response = $paymentService->retrievePaymentMethod($request->all());

        return response()->json($response);
    }

    /**
     * List all payment methods (with optional filters like customer ID and limit).
     */
    public function listPaymentMethods(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the filters to list all payment methods
        $response = $paymentService->listPaymentMethods($request->all());

        return response()->json($response);
    }

    /**
     * Attach a payment method to a customer.
     */
    public function attachPaymentMethod(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to attach a payment method
        $response = $paymentService->attachPaymentMethod($request->all());

        return response()->json($response);
    }

    /**
     * Detach a payment method from a customer.
     */
    public function detachPaymentMethod(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the payment method ID to detach it
        $response = $paymentService->detachPaymentMethod($request->all());

        return response()->json($response);
    }

    /**
     * Reinstate a previously detached payment method.
     */
    public function reinstatePaymentMethod(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the payment method ID to reinstate it
        $response = $paymentService->reinstatePaymentMethod($request->all());

        return response()->json($response);
    }

    /**
     * Retrieve a customer's specific payment method by ID.
     */
    public function retrieveCustomerPaymentMethod(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass customer ID and payment method ID to retrieve the payment method
        $response = $paymentService->retrieveCustomerPaymentMethod($request->all());

        return response()->json($response);
    }

    /**
     * List all payment methods attached to a customer.
     */
    public function listCustomerPaymentMethods(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass customer ID and limit to list payment methods
        $response = $paymentService->listCustomerPaymentMethods($request->all());

        return response()->json($response);
    }
}
