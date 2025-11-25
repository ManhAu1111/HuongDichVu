<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class RedirectIfAuthenticatedToken
{
    public function handle(Request $request, Closure $next)
    {
        $token = $request->cookie('auth_token');

        if ($token) {
            // Gọi auth-service /me để check token có hợp lệ
            $client = new Client([
                'base_uri' => 'http://localhost:8001',
                'http_errors' => false,
            ]);

            $response = $client->get('/me', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $token
                ]
            ]);

            $data = json_decode($response->getBody()->getContents(), true);

            // Nếu token hợp lệ → redirect dashboard
            if (isset($data['ok']) && $data['ok'] === true) {
                return redirect('/dashboard');
            }
        }

        return $next($request);
    }
}
