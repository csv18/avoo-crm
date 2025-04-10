<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Strategies\Payment\PaymentServiceStrategy;
use Illuminate\Http\Request;
use App\Traits\HttpResponses;

class PriceController extends Controller
{
    /**
     * Create a new price.
     */
    public function createPrice(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $priceService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to create a price
        $response = $priceService->createPrice($request->all());

        return response()->json($response);
    }

    /**
     * Update an existing price.
     */
    public function updatePrice(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $priceService = PaymentServiceStrategy::getStrategy($service);

        // Pass the request data to update a price
        $response = $priceService->updatePrice($request->all());

        return response()->json($response);
    }

    /**
     * Retrieve a specific price by ID.
     */
    public function retrievePrice(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $priceService = PaymentServiceStrategy::getStrategy($service);

        // Pass the price ID to retrieve the details
        $response = $priceService->retrievePrice($request->all());

        return response()->json($response);
    }

    /**
     * List all prices (with optional filters like product ID and limit).
     */
    public function listPrices(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $priceService = PaymentServiceStrategy::getStrategy($service);

        // Pass the filters to list all prices
        $response = $priceService->listPrices($request->all());

        return response()->json($response);
    }

    /**
     * Search prices based on a query.
     */
    public function searchPrices(Request $request)
    {
        $service = $request->input('service', 'stripe'); // Default service is Stripe
        $priceService = PaymentServiceStrategy::getStrategy($service);

        // Pass the search query to search prices
        $response = $priceService->searchPrice($request->all());

        return response()->json($response);
    }
}
