<?php

namespace App\Http\Controllers;


use DB;
use Illuminate\Http\Request;

class MpesaCallbackController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function stk_push(Request $request)
    {
        // Set the response type to JSON
        header("Content-Type: application/json");
    
        // M-Pesa API credentials
        $consumerKey = 'EjoJP5yBeUG68Gwgyx4sbQwPFJ5AzoNA';  // Replace with your actual consumer key
        $consumerSecret = 'HZ6VdOfTXUJGaAok';               // Replace with your actual consumer secret
        $shortcode = '174379';                             // Business Short Code
        $passkey = 'bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919'; // Replace with your actual passkey
        $callbackUrl = 'https://peter.pandakivuli.co.ke/callback/'; // Replace with your actual callback URL
    
        // Function to generate the access token
        $accessToken = $this->generateAccessToken($consumerKey, $consumerSecret);
        
        // Main logic for handling POST request
        $input = $request->json()->all();
        
        if (isset($input['phone']) && isset($input['amount'])) {
            $phone = $input['phone'];
            $amount = $input['amount'];
            $orderId = $input['orderId'];









    
            // Initiate STK Push
            $response = $this->initiateSTKPush($phone, $amount, $shortcode, $passkey, $accessToken, $callbackUrl);
            return response()->json($response);
        } else {
            return response()->json(["errorMessage" => "Invalid input. Phone number and amount are required."], 400);
        }
    }
    
    private function generateAccessToken($consumerKey, $consumerSecret)
    {
        $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
        $curl = curl_init();
        curl_setopt($curl, CURLOPT_URL, $url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, ['Content-Type:application/json']);
        curl_setopt($curl, CURLOPT_HEADER, false);
        curl_setopt($curl, CURLOPT_USERPWD, $consumerKey . ':' . $consumerSecret);
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
        $result = curl_exec($curl);
        
        // Error handling for cURL
        if (curl_errno($curl)) {
            http_response_code(500);
            return ["error" => "cURL error: " . curl_error($curl)];
        }
        
        curl_close($curl);
        $result = json_decode($result);
    
        if (isset($result->access_token)) {
            return $result->access_token;
        } else {
            http_response_code(500);
            return ["error" => "Failed to generate access token"];
        }
    }
    
    private function initiateSTKPush($phone, $amount, $shortcode, $passkey, $accessToken, $callbackUrl,  $orderId)
    {
        $timestamp = date('YmdHis');
        $password = base64_encode($shortcode . $passkey . $timestamp);
    
        // Hard-coded Order ID
        // $orderId = "7777545";
    
        // Create dynamic callback URL with hard-coded order ID
        $callbackUrlWithOrderId = $callbackUrl . '?orderId=' . urlencode($orderId);
    
        $url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';
        $curl = curl_init($url);
        curl_setopt($curl, CURLOPT_HTTPHEADER, [
            "Authorization: Bearer $accessToken",
            'Content-Type: application/json'
        ]);
        curl_setopt($curl, CURLOPT_POST, 1);
        curl_setopt($curl, CURLOPT_POSTFIELDS, json_encode([
            "BusinessShortCode" => $shortcode,
            "Password" => $password,
            "Timestamp" => $timestamp,
            "TransactionType" => "CustomerPayBillOnline",
            "Amount" => $amount,
            "PartyA" => $phone,          
            "PartyB" => $shortcode,
            "PhoneNumber" => $phone,
            "CallBackURL" => $callbackUrlWithOrderId,
            "AccountReference" => "Artcaffe",  
            "TransactionDesc" => "Payment for Order ID: $orderId"
        ]));
        curl_setopt($curl, CURLOPT_RETURNTRANSFER, 1);
    
        $response = curl_exec($curl);
    
        // Error handling for cURL
        if (curl_errno($curl)) {
            http_response_code(500);
            return ["error" => "cURL error: " . curl_error($curl)];
        }
    
        curl_close($curl);
        $responseArray = json_decode($response, true);
    
        // Check if response contains error message
        if (isset($responseArray['errorCode'])) {
            http_response_code(400);
            return $responseArray; // Return error response from M-Pesa
        }
    
        return $responseArray;
    }
    

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function show(order $order)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function edit(Request $request)
{    $tran_id = $request->query('orderId');

    // Retrieve the raw body of the request
    $data = $request->getContent();

    // Check if data is received
    if ($data) {
        // Decode the JSON data
        $decodedData = json_decode($data, true);

        // Ensure the data has the "Body" key to prevent warnings
        if (isset($decodedData['Body']['stkCallback'])) {
            $callbackData = $decodedData['Body']['stkCallback'];
            $resultCode = $callbackData['ResultCode'];
            $resultDesc = $callbackData['ResultDesc'];

            if ($resultCode === 0) {
                // Payment was successful, extract amount and receipt number
                $amount = null;
                $receiptNumber = null;

                // Check if CallbackMetadata exists to avoid undefined index errors
                if (isset($callbackData['CallbackMetadata']['Item'])) {
                    foreach ($callbackData['CallbackMetadata']['Item'] as $item) {
                        if ($item['Name'] === 'Amount') {
                            $amount = $item['Value'];
                        } elseif ($item['Name'] === 'MpesaReceiptNumber') {
                            $receiptNumber = $item['Value'];
                        }
                    }

                    // Retrieve the transaction ID from the query parameters
                    $tran_id = $request->query('orderId');

                    // Update the status of the order with the captured transaction ID
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['status' => 'Processing']);

                    return response()->json(['message' => 'Order status updated successfully.'], 200);
                }
            } else {
                // Handle other ResultCodes (e.g., 1032, 1037) with custom messages
                if ($resultCode === 1037) {
                    $errorMessage = "Order ID: $tran_id - Timeout: $resultDesc\n";
                } elseif ($resultCode === 1032) {
                    $errorMessage = "Order ID: $tran_id - Cancelled by User: $resultDesc\n";
                } else {
                    $errorMessage = "Order ID: $tran_id - Error $resultCode: $resultDesc\n";
                }

                // Log the error message to data.json
                $jsonFile = 'data.json';
                file_put_contents($jsonFile, json_encode(["message" => $errorMessage], JSON_PRETTY_PRINT), FILE_APPEND | LOCK_EX);
            }
        } else {
            // Log an error message if the expected structure is not present
            $logFile = 'error.log'; // Make sure to define where to log errors
            file_put_contents($logFile, "Error: 'Body' key or 'stkCallback' key is missing in the callback data\n", FILE_APPEND);
        }

        // Respond with a success message
        return response()->json([
            "status" => "success",
            "message" => "Data received",
            "data" => $decodedData
        ]);
    } else {
        // Respond with an error message if no data was received
        return response()->json([
            "status" => "error",
            "message" => "No data received"
        ]);
    }
}

    

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, order $order)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\order  $order
     * @return \Illuminate\Http\Response
     */
    public function destroy(order $order)
    {
        //
    }
}
