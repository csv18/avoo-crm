<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Customer\CustomerServiceStrategy;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function createCustomer(Request $request)
    {
        $service = $request->input('service', 'customer');
        $paymentService = CustomerServiceStrategy::getStrategy($service);

        $response = $paymentService->createCustomer($request->all());
        return response()->json($response);
    }

    public function updateCustomer(Request $request)
    {
        $service = $request->input('service', 'customer');
        $paymentService = CustomerServiceStrategy::getStrategy($service);

        $response = $paymentService->updateCustomer($request->all());
        return response()->json($response);
    }
}
