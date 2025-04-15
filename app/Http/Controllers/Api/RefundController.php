<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Payment\PaymentServiceStrategy;
use Illuminate\Http\Request;

class RefundController extends Controller
{
    public function create(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to create a refund
        $response = $paymentService->createRefund($request->all());
        return response()->json($response);
    }

    public function update(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to update a refund
        $response = $paymentService->updateRefund($request->all());
        return response()->json($response);
    }

    public function retrieve(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the refund_id to retrieve refund details
        $response = $paymentService->retrieveRefund();
        return response()->json($response);
    }

    public function list(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the filters to list refunds
        $response = $paymentService->listRefunds($request->all());
        return response()->json($response);
    }

    public function cancel(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the refund_id to cancel the refund
        $response = $paymentService->cancelRefund();
        return response()->json($response);
    }
}
