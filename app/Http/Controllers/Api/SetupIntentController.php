<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Payment\PaymentServiceStrategy;
use Illuminate\Http\Request;

class SetupIntentController extends Controller
{
    public function create(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to create a SetupIntent
        $response = $paymentService->createSetupIntent($request->all());

        return response()->json($response);
    }

    public function retrieve(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the setup_intent_id to retrieve setup intent details
        $response = $paymentService->retrieveSetupIntent();

        return response()->json($response);
    }

    public function update(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to update a SetupIntent
        $response = $paymentService->updateSetupIntent($request->all());

        return response()->json($response);
    }

    public function cancel(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the setup_intent_id to cancel the SetupIntent
        $response = $paymentService->cancelSetupIntent($request->all());

        return response()->json($response);
    }

    public function confirm(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to confirm a SetupIntent
        $response = $paymentService->confirmSetupIntent($request->all());

        return response()->json($response);
    }

    public function verifyMicrodeposits(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to verify microdeposits for a SetupIntent
        $response = $paymentService->verifyMicrodeposits($request->all());

        return response()->json($response);
    }

    public function list(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        // Pass the filters to list SetupIntents
        $response = $paymentService->listSetupIntents($request->all());

        return response()->json($response);
    }
}
