<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Email;
use Illuminate\Support\Facades\Validator;

class EmailController extends Controller
{
    public function store(Request $request)
    {
        // Validate incoming request data
        $validator = Validator::make($request->all(), [
            'email' => 'required|email|unique:emails,email',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => $validator->errors()->first(),
            ], 400);
        }

        // Create a new email entry in the database
        Email::create(['email' => $request->email]);

        return response()->json([
            'success' => true,
            'message' => 'Email stored successfully',
        ]);
    }
}
