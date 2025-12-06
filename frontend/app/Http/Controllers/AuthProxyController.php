<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use GuzzleHttp\Client;

class AuthProxyController extends Controller
{
    private $client;

    public function __construct()
    {
        $this->client = new Client([
            'base_uri' => 'http://127.0.0.1:8001', // URL của auth-service
            'http_errors' => false
        ]);
    }

    public function login(Request $request)
    {
        $response = $this->client->post('/login', [
            'headers' => ['Content-Type' => 'application/json'],
            'body' => json_encode([
                'email' => $request->email,
                'password' => $request->password
            ])
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if (!$data['ok']) {
            return back()->with('error', $data['message']);
        }

        //Cookie HttpOnly chuẩn
        $cookie = cookie(
            'auth_token',
            $data['token'],
            60,          // 60 minutes
            '/',
            null,        // để null để Laravel tự dùng domain hiện tại
            false,
            true,
            false,
            'Lax'
        );

        // $cookie = cookie(
        //     name: 'auth_token',
        //     value: $data['token'],
        //     minutes: 60,
        //     path: '/',
        //     domain: null,   // BẮT BUỘC, nếu không chrome block
        //     secure: false,         // vì bạn dùng http, không phải https
        //     httpOnly: true,
        //     raw: false,
        //     sameSite: 'Lax'       // QUAN TRỌNG NHẤT
        // );



        return redirect()->route('dashboard')->withCookie($cookie);
    }



    public function register(Request $request)
    {
        $request->validate([
            'fname' => 'required|string|max:50',
            'lname' => 'required|string|max:50',
            'email' => 'required|email',
            'password' => 'required|min:6'
        ]);
        $response = $this->client->post('/register', [
            'json' => [
                'fullname' => $request->fname . ' ' . $request->lname,
                'email'    => $request->email,
                'password' => $request->password
            ]
        ]);

        $data = json_decode($response->getBody()->getContents(), true);

        if (!$data['ok']) {
            return back()->with('error', $data['message']);
        }

        return redirect('/signin')->with('success', 'Đăng ký thành công!');
    }


    public function me(Request $request)
    {
        $token = $request->cookie('auth_token');

        if (!$token) {
            return response()->json(['ok' => false, 'message' => 'No token'], 401);
        }

        $response = $this->client->get('/me', [
            'headers' => [
                'Authorization' => 'Bearer ' . $token
            ]
        ]);


        return json_decode($response->getBody()->getContents(), true);
    }
}
