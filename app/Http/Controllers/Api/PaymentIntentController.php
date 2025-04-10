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

    public function retrieve(Request $request, string $payment_intent_id)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->retrievePaymentIntent(['payment_intent_id' => $payment_intent_id]);
        return response()->json($response);
    }

    public function cancel(Request $request, string $payment_intent_id)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->cancelPaymentIntent(['payment_intent_id' => $payment_intent_id]);
        return response()->json($response);
    }

    public function capture(Request $request, string $payment_intent_id)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->capturePaymentIntent(['payment_intent_id' => $payment_intent_id] + $request->all());
        return response()->json($response);
    }

    public function confirm(Request $request, string $payment_intent_id)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->confirmPaymentIntent(['payment_intent_id' => $payment_intent_id] + $request->all());
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

    public function incrementAuthorization(Request $request, string $payment_intent_id)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->incrementAuthorization(['payment_intent_id' => $payment_intent_id] + $request->all());
        return response()->json($response);
    }

    public function applyCustomerBalance(Request $request, string $payment_intent_id)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->applyCustomerBalance(['payment_intent_id' => $payment_intent_id]);
        return response()->json($response);
    }

    public function verifyMicrodeposits(Request $request, string $payment_intent_id)
    {
        $service = $request->input('service', 'stripe');
        $paymentService = PaymentServiceStrategy::getStrategy($service);

        $response = $paymentService->verifyPaymentIntentMicrodeposits(['payment_intent_id' => $payment_intent_id] + $request->all());
        return response()->json($response);
    }
}
