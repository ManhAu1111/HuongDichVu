<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;


class PaymentController extends Controller
{
    // JSON request
    public function momoPayment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey   = env('MOMO_ACCESS_KEY');
        $secretKey   = env('MOMO_SECRET_KEY');

        // Lấy data từ frontend
        //$orderId     = $request->order_id;
        $orderId = "OD" . time();
        $amount      = $request->amount;
        $orderInfo   = "Thanh toán đơn hàng $orderId";

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
        $orderId = $request->orderId;
        $status  = $request->resultCode == 0 ? 'paid' : 'failed';

        // Gọi sang order-service để update đơn hàng
        try {
            \Illuminate\Support\Facades\Http::post("http://127.0.0.1:8002/api/update-payment-status", [
                'order_id' => $orderId,
                'status'   => $status
            ]);
        } catch (\Exception $e) {
            Log::error("Không gọi được order-service: " . $e->getMessage());
        }

        // Redirect về UI
        if ($status === 'paid') {
            return redirect('http://127.0.0.1:8000/checkout?paid=true');
        }

        return redirect('http://127.0.0.1:8000/checkout?failed=true');
    }
}
