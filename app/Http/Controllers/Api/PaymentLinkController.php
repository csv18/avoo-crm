<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Payment\PaymentServiceStrategy;
use Illuminate\Http\Request;

class PaymentLinkController extends Controller
{
    /**
     * Create a new payment link.
     */
    public function createPaymentLink(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to create a payment link
        $response = $paymentService->createPaymentLink($request->all());

        return response()->json($response);
    }

    /**
     * Update an existing payment link.
     */
    public function updatePaymentLink(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to update a payment link
        $response = $paymentService->updatePaymentLink($request->all());

        return response()->json($response);
    }

    /**
     * Retrieve a specific payment link by ID.
     */
    public function retrievePaymentLink(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the payment link ID to retrieve the payment link
        $response = $paymentService->retrievePaymentLink($request->all());

        return response()->json($response);
    }

    /**
     * List all payment links with optional filters.
     */
    public function listPaymentLinks(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the filters to list payment links
        $response = $paymentService->listPaymentLinks($request->all());

        return response()->json($response);
    }

    /**
     * Retrieve line items from a specific payment link by ID.
     */
    public function retrieveLineItems(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the payment link ID to retrieve line items
        $response = $paymentService->retrieveLineItems($request->all());

        return response()->json($response);
    }

    /**
     * Initialize a new payment link.
     */
    public function initialisePaymentLink(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to initialize a payment link
        $response = $paymentService->initialisePaymentLink($request->all());

        return response()->json($response);
    }
}
