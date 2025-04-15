<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Payment\PaymentServiceStrategy;
use Illuminate\Http\Request;

class ChargeController extends Controller
{
    public function create(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to create a charge
        $response = $paymentService->createCharge($request->all());

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to update a charge
        $response = $paymentService->updateCharge($request->all());

        return response()->json($response);
    }

    public function retrieve(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the charge_id to retrieve charge details
        $response = $paymentService->retrieveCharge();

        return response()->json($response);
    }

    public function list(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the filters to list charges
        $response = $paymentService->listCharges($request->all());

        return response()->json($response);
    }

    public function capture(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to capture a charge
        $response = $paymentService->captureCharge($request->all());

        return response()->json($response);
    }

    public function cancel(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the charge_id to cancel the charge
        $response = $paymentService->cancelCharge($request->all());

        return response()->json($response);
    }

    public function search(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the search query to search for charges
        $response = $paymentService->searchCharges($request->all());

        return response()->json($response);
    }
}
