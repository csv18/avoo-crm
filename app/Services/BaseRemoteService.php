<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Cache;
use Carbon\Carbon;

abstract class BaseRemoteService
{
    protected string $baseUrl;
    protected string $email;
    protected string $password;

    public function __construct()
    {
        $this->baseUrl = config('services.customer_api.base_url');
        $this->email = config('services.customer_api.email');
        $this->password = config('services.customer_api.password');
    }

    protected function getAccessToken(): string
    {
        if (Cache::has('customer_api_access_token') && now()->lt(Cache::get('customer_api_token_expiry'))) {
            return Cache::get('customer_api_access_token');
        }

        if (Cache::has('customer_api_refresh_token')) {
            $refreshToken = Cache::get('customer_api_refresh_token');

            $response = Http::post("{$this->baseUrl}/refresh-token", [
                'refresh_token' => $refreshToken,
            ]);

            if ($response->successful()) {
                return $this->storeToken($response->json());
            }
        }

        // Fallback to login
        $response = Http::post("{$this->baseUrl}/login", [
            'email' => $this->email,
            'password' => $this->password,
        ]);

        if ($response->successful()) {
            return $this->storeToken($response->json('data'));
        }

        throw new \Exception('Unable to authenticate with customer API');
    }

    protected function storeToken(array $data): string
    {
        Cache::put('customer_api_access_token', $data['access_token'], Carbon::parse($data['expires_in']));
        Cache::put('customer_api_refresh_token', $data['refresh_token'], now()->addDays(7));
        Cache::put('customer_api_token_expiry', Carbon::parse($data['expires_in']));

        return $data['access_token'];
    }

    protected function sendRequest(array $payload, string $endpoint, string $prefix = ''): mixed
    {
        $token = $this->getAccessToken();

        return Http::withHeaders([
            'Authorization' => 'Bearer ' . $token,
            'Accept'        => 'application/json',
            'Content-Type'  => 'application/json',
        ])
            ->post("{$this->baseUrl}/{$prefix}{$endpoint}", $payload)
            ->throw()
            ->json();
    }
}
