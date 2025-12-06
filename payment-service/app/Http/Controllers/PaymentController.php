<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Http;

class PaymentController extends Controller
{
    public function momoPayment(Request $request)
    {
        $endpoint = "https://test-payment.momo.vn/v2/gateway/api/create";

        $partnerCode = env('MOMO_PARTNER_CODE');
        $accessKey   = env('MOMO_ACCESS_KEY');
        $secretKey   = env('MOMO_SECRET_KEY');

        // Validate minimal
        $request->validate([
            'user_id' => 'required',
            'amount'  => 'required|numeric',
            'items'   => 'required|array|min:1',
        ]);

        // MoMo transaction id (unique)
        $momoOrderId = 'MOMO_' . time() . '_' . rand(1000, 9999);
        $amount = (string) $request->amount;
        $orderInfo = "Thanh toán cho đơn tạm $momoOrderId";

        $redirectUrl = env('MOMO_REDIRECT_URL'); // return_url (UI)
        $ipnUrl      = env('MOMO_IPN_URL');      // notify_url (MoMo -> payment-service)

        $requestId   = (string) time();
        $requestType = "captureWallet";

        // Build extraData: include original order payload and momoOrderId so callback can recreate order
        $payloadForExtra = [
            'momo_order_id'  => $momoOrderId,
            'user_id'        => $request->user_id,
            'receiver_name'  => $request->receiver_name,
            'receiver_phone' => $request->receiver_phone,
            'receiver_email' => $request->receiver_email,
            'street_address' => $request->street_address,
            'district_name'  => $request->district_name,
            'province_code'  => $request->province_code,
            'items'          => $request->items,
            'amount'         => $amount,
            'shipping_fee'   => $request->shipping_fee ?? 0,
        ];

        $extraData = base64_encode(json_encode($payloadForExtra));

        // raw string for signature (follow MoMo doc)
        $rawHash = "accessKey={$accessKey}&amount={$amount}&extraData={$extraData}&ipnUrl={$ipnUrl}&orderId={$momoOrderId}&orderInfo={$orderInfo}&partnerCode={$partnerCode}&redirectUrl={$redirectUrl}&requestId={$requestId}&requestType={$requestType}";

        $signature = hash_hmac("sha256", $rawHash, $secretKey);

        $data = [
            'partnerCode' => $partnerCode,
            'partnerName' => "MoMo Payment",
            'storeId'     => "MomoTestStore",
            'requestId'   => $requestId,
            'amount'      => $amount,
            'orderId'     => $momoOrderId,
            'orderInfo'   => $orderInfo,
            'redirectUrl' => $redirectUrl,
            'ipnUrl'      => $ipnUrl,
            'lang'        => 'vi',
            'extraData'   => $extraData,
            'requestType' => $requestType,
            'signature'   => $signature
        ];

        $result = $this->execPostRequest($endpoint, json_encode($data));
        $json = json_decode($result, true);

        Log::info('Momo create response', ['request' => $data, 'response' => $json]);

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
        $err = curl_error($ch);
        curl_close($ch);
        if ($err) {
            Log::error("CURL error: $err");
        }
        return $result;
    }

    // MoMo server -> payment-service IPN (notify_url)
    public function momoCallback(Request $request)
    {
        Log::info("MoMo callback raw", $request->all());

        // Basic check
        $resultCode = $request->input('resultCode');

        // extraData may be available
        $extraData = $request->input('extraData', '');
        $orderData = [];
        if (!empty($extraData)) {
            try {
                $orderData = json_decode(base64_decode($extraData), true) ?: [];
            } catch (\Throwable $e) {
                Log::error('Invalid extraData: ' . $e->getMessage());
            }
        }

        if ($resultCode == 0) {
            // Payment success -> call order-service to CREATE order as PAID
            try {
                $payload = [
                    'user_id'        => $orderData['user_id'] ?? null,
                    'receiver_name'  => $orderData['receiver_name'] ?? null,
                    'receiver_phone' => $orderData['receiver_phone'] ?? null,
                    'receiver_email' => $orderData['receiver_email'] ?? null,
                    'street_address' => $orderData['street_address'] ?? null,
                    'district_name'  => $orderData['district_name'] ?? null,
                    'province_code'  => $orderData['province_code'] ?? null,
                    'payment_method' => 'momo',
                    'items'          => $orderData['items'] ?? [],
                    'amount'         => $orderData['amount'] ?? null,
                    'shipping_fee'   => $orderData['shipping_fee'] ?? 0,
                    'external_payment_id' => $orderData['momo_order_id'] ?? $request->input('orderId'),
                ];

                $res = Http::post("http://127.0.0.1:8002/api/orders/create-paid", $payload);

                Log::info('Call OrderService create-paid response', ['status' => $res->status(), 'body' => $res->body()]);
            } catch (\Throwable $e) {
                Log::error('Call to order-service failed: ' . $e->getMessage());
                // Optionally: retry logic, queue, etc.
            }

            // Redirect user to UI
            return redirect('http://127.0.0.1:8000/checkout?paid=true');
        }

        // Payment failed / cancelled -> do nothing (no order created)
        return redirect('http://127.0.0.1:8000/checkout?failed=true');
    }
}
