<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Payment\PaymentServiceStrategy;
use Illuminate\Http\Request;

class PaymentIntentController extends Controller
{
    public function create(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->createPaymentIntent($request->all());
        return response()->json($response);
    }

    public function update(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->updatePaymentIntent($request->all());
        return response()->json($response);
    }

    public function retrieve(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->retrievePaymentIntent();
        return response()->json($response);
    }

    public function cancel(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->cancelPaymentIntent();
        return response()->json($response);
    }

    public function capture(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->capturePaymentIntent();
        return response()->json($response);
    }

    public function confirm(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->confirmPaymentIntent();
        return response()->json($response);
    }

    public function list(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->listPaymentIntents($request->all());
        return response()->json($response);
    }

    public function search(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->searchPaymentIntents($request->all());
        return response()->json($response);
    }

    public function incrementAuthorization(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->incrementAuthorization();
        return response()->json($response);
    }

    public function applyCustomerBalance(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->applyCustomerBalance();
        return response()->json($response);
    }

    public function verifyMicrodeposits(Request $request)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->verifyPaymentIntentMicrodeposits();
        return response()->json($response);
    }
}
