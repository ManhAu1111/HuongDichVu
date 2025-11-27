<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class PaymentController extends Controller
{
    // redirect to link momo payment
    // public function momoPayment()
    // {
    //     $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

    //     $partnerCode = env('MOMO_PARTNER_CODE');
    //     $accessKey   = env('MOMO_ACCESS_KEY');
    //     $secretKey   = env('MOMO_SECRET_KEY');

    //     $orderId     = time();   // Mã đơn hàng
    //     $orderInfo   = "Thanh toán đơn hàng #$orderId";
    //     $amount      = "10000"; // Test 100.000 VND
    //     $redirectUrl = env('MOMO_REDIRECT_URL');
    //     $ipnUrl      = env('MOMO_IPN_URL');
    //     $requestId   = time();

    //     $requestType = "captureWallet";

    //     $rawHash = "accessKey=$accessKey&amount=$amount&extraData=&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";

    //     $signature = hash_hmac("sha256", $rawHash, $secretKey);

    //     $data = [
    //         'partnerCode' => $partnerCode,
    //         'partnerName' => "MoMo Payment",
    //         'storeId'     => "MomoTestStore",
    //         'requestId'   => $requestId,
    //         'amount'      => $amount,
    //         'orderId'     => $orderId,
    //         'orderInfo'   => $orderInfo,
    //         'redirectUrl' => $redirectUrl,
    //         'ipnUrl'      => $ipnUrl,
    //         'lang'        => 'vi',
    //         'extraData'   => "",
    //         'requestType' => $requestType,
    //         'signature'   => $signature
    //     ];

    //     $result = $this->execPostRequest($endpoint, json_encode($data));

    //     $jsonResult = json_decode($result, true);

    //     return redirect($jsonResult['payUrl']);
    // }

    // JSON request
    public function momoPayment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey   = env('MOMO_ACCESS_KEY');
        $secretKey   = env('MOMO_SECRET_KEY');

        $orderId     = time();
        $orderInfo   = "Thanh toán đơn hàng #$orderId";
        $amount      = "1000"; // Test 1.000.000 VND
        $redirectUrl = env('MOMO_REDIRECT_URL');
        $ipnUrl      = env('MOMO_IPN_URL');
        $requestId   = time();
        $requestType = "captureWallet";

        $rawHash = "accessKey=$accessKey&amount=$amount&extraData=&ipnUrl=$ipnUrl&orderId=$orderId&orderInfo=$orderInfo&partnerCode=$partnerCode&redirectUrl=$redirectUrl&requestId=$requestId&requestType=$requestType";

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "MoMo Payment",
            'storeId'     => "MomoTestStore",
            'requestId'   => $requestId,
            'amount'      => $amount,
            'orderId'     => $orderId,
            'orderInfo'   => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl'      => $ipnUrl,
            'lang'        => 'vi',
            'extraData'   => "",
            'requestType' => $requestType,
            'signature'   => $signature
        ];

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $json = json_decode($result, true);

        // ⚠️ Quan trọng: trả JSON, không redirect
        return response()->json($json);
    }


    private function execPostRequest($url, $data)
    {
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_HTTPHEADER, [
            'Content-Type: application/json',
            'Content-Length: ' . strlen($data)
        ]);
        $result = curl_exec($ch);
        curl_close($ch);

        return $result;
    }

    public function momoCallback(Request $request)
    {
        if ($request->resultCode == 0) {
            return redirect('http://127.0.0.1:8000/checkout');
        }
        return redirect('http://127.0.0.1:8000/checkout?status=failed');
    }
}
