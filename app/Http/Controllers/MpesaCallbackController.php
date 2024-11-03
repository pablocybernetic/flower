<?php

namespace App\Http\Controllers;

use Auth;
use Session;


use QrCode;
use PDF;
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
            // Session::put('invoice',$orderId);


            Session::put('orderId',$orderId);

            $orderId = Session::get('orderId');


            $post_data = array();
            $post_data['total_amount'] = $amount; # You cant not pay less than 10
            $post_data['currency'] = "KES";
            $post_data['tran_id'] = $orderId; // tran_id must be unique
    
        //   $name=Auth::user()->name;
        //   $email=Auth::user()->email;
    
            # CUSTOMER INFORMATION
            $post_data['cus_name'] = '';
            $post_data['cus_email'] = $email=Auth::user()->email;
            $post_data['cus_add1'] = $request->address;
            $post_data['cus_add2'] = "";
            $post_data['cus_city'] = "";
            $post_data['cus_state'] = "";
            $post_data['cus_postcode'] = "";
            $post_data['cus_country'] = "";
            $post_data['cus_phone'] = $phone;
            $post_data['cus_fax'] = "";
    
            # SHIPMENT INFORMATION
            $post_data['ship_name'] = "Store Test";
            $post_data['ship_add1'] = "Dhaka";
            $post_data['ship_add2'] = "Dhaka";
            $post_data['ship_city'] = "Dhaka";
            $post_data['ship_state'] = "Dhaka";
            $post_data['ship_postcode'] = "";
            $post_data['ship_phone'] = "";
            $post_data['ship_country'] = "";
    
            $post_data['shipping_method'] = "NO";
            $post_data['product_name'] = "Computer";
            $post_data['product_category'] = "Goods";
            $post_data['product_profile'] = "physical-goods";
    
            # OPTIONAL PARAMETERS
            $post_data['value_a'] = "ref001";
            $post_data['value_b'] = "ref002";
            $post_data['value_c'] = "ref003";
            $post_data['value_d'] = "ref004";
    
            Session::put('address',$post_data['cus_add1']);
               #Before  going to initiate the payment order status need to update as Pending.
        $update_product = DB::table('orders')
        ->where('transaction_id', $post_data['tran_id'])
        ->updateOrInsert([
            'name' => $post_data['cus_name'],
            'email' => $post_data['cus_email'],
            'phone' => $post_data['cus_phone'],
            'amount' => $post_data['total_amount'],
            'status' => 'Pending',
            'MpesaReceiptNumber'=>'',
            'AmountPaid'=>0,
            'ResultDesc'=>null,
            'address' => $post_data['cus_add1'],
            'transaction_id' => $orderId,
            'currency' => $post_data['currency']
        ]);






    
            // Initiate STK Push
            $response = $this->initiateSTKPush($phone, $amount, $shortcode, $passkey, $accessToken, $callbackUrl, $orderId);
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
    public function get_order_status($tran_id)
    {
        // Retrieve the updated record with only the fields we want
        $updatedProduct = DB::table('orders')
            ->where('transaction_id', $tran_id)
            ->select('ResultDesc', 'MpesaReceiptNumber', 'AmountPaid', 'ResultCode') // Select only the required fields
            ->first();
    
        // Check if the product was found and access fields
        if ($updatedProduct) {
            // Access the fields you need
            $resultDesc = $updatedProduct->ResultDesc; // Default to 'Not Sent' if undefined
            $mpesaReceiptNumber = $updatedProduct->MpesaReceiptNumber ?? 'undefined'; // Default to 'undefined' if undefined
            $amountPaid = $updatedProduct->AmountPaid ?? 'undefined'; // Default to 'undefined' if undefined
            $resultCode = $updatedProduct->ResultCode ?? 404; // Use lowercase variable name
    
            // Return the fields in the response
            return response()->json([
                'ResultCode' => $resultCode, // Corrected variable name
                'Description' => $resultDesc,
                'AmountPaid' => $amountPaid,
                'MpesaReceiptNumber' => $mpesaReceiptNumber
            ]);
        }
    
        // Return a response indicating no record found
        return response()->json([
            'ResultCode' => 'undefined',
            'Description' => 'Not Sent',
            'AmountPaid' => 'undefined',
            'MpesaReceiptNumber' => 'undefined'
        ]);
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
           
                // Check if CallbackMetadata exists to avoid undefined index errors
                if (isset($callbackData['CallbackMetadata']['Item'])) {
                   
                    $amount = null;
                    $receiptNumber = null;
                
                     foreach ($callbackData['CallbackMetadata']['Item'] as $item) {
                        
                        if ($item['Name'] === 'Amount') {
                            $amount = $item['Value'];
                        } elseif ($item['Name'] === 'MpesaReceiptNumber') {
                            $receiptNumber = $item['Value'];
                        }
                    }
                
                    // Retrieve the transaction ID from the query parameters
                    $tran_id = $request->query('orderId');
                
                    // Update the status of the order with the captured values
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update([
                            'status' => 'Processing',
                            'MpesaReceiptNumber' => $receiptNumber,
                            'AmountPaid' => $amount,
                            'ResultCode' => 0,

                            'ResultDesc' => 'Payment Successful, order '.$tran_id.'. amount paid Ksh'.$amount.' Mpesa receipt: '.$receiptNumber
                        ]);
                
                    return response()->json(['message' => 'Order status updated successfully.'], 200);
                }
                
            } else {
                // Handle other ResultCodes (e.g., 1032, 1037) with custom messages
                if ($resultCode === 1037) {
                    $tran_id = $request->query('orderId');

                    // Update the status of the order with the captured transaction ID
                    $update_product = DB::table('orders')
                        ->where('transaction_id', $tran_id)
                        ->update(['ResultDesc' => 'Payment Timeout',
                        'ResultCode' => 1037,

                    ]);

                    // return response()->json(['message' => 'Payment Timeout.'], 200

                    $errorMessage = "Order ID: $tran_id - Timeout: $resultDesc\n";
                } elseif ($resultCode === 1032) {
                    $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['ResultDesc' => 'Cancelled by User',
                    'ResultCode' => 1032,

                ]);

                return response()->json(['message' => 'Cancelled by User.'], 200);
                    // $errorMessage = "Order ID: $tran_id - Cancelled by User: $resultDesc\n";
                }
                elseif ($resultCode === 1001) {
                    $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['ResultDesc' => 'A transaction is already in process for the current subscriber, try again between 2-3 minutes',
                    'ResultCode' => 1001,

                ]);

                return response()->json(['message' => 'A transaction is already in process for the current subscriber, try again between 2-3 minutes'], 200);
                    // $errorMessage = "Order ID: $tran_id - Cancelled by User: $resultDesc\n";
                }
                elseif ($resultCode === 1) {
                    $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['ResultDesc' => 'The balance is insufficient for the transaction.',
                    'ResultCode' => 1,

                ]);

                return response()->json(['message' => 'The balance is insufficient for the transaction.'], 200);
                    // $errorMessage = "Order ID: $tran_id - Cancelled by User: $resultDesc\n";
                }
                elseif ($resultCode === 1037) {
                    $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['ResultDesc' => 'DS timeout phone cannot be reached',
                    'ResultCode' => 1037,

                ]);

                return response()->json(['message' => 'DS timeout phone cannot be reached.'], 200);
                    // $errorMessage = "Order ID: $tran_id - Cancelled by User: $resultDesc\n";
                }
                
                else {
                    $update_product = DB::table('orders')
                    ->where('transaction_id', $tran_id)
                    ->update(['ResultDesc' => 'Error '.$resultDesc]);
                    return response()->json(['message' => 'An error occured try again later',
                    'ResultCode' => 404,

                ], 200);

                    // $errorMessage = "Order ID: $t.ran_id - Error $resultCode: $resultDesc\n";
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
