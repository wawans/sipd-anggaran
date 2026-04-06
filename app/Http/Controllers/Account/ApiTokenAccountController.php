<?php

namespace App\Http\Controllers\Account;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

class ApiTokenAccountController extends Controller
{
    public function index(Request $request)
    {
        return response()->json(['status' => true, 'data' => $request->user()->tokens]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['name' => ['required', 'string', 'max:30']]);

        $token = $request->user()->createToken($validated['name']);

        return response()->json(['status' => true, 'data' => ['token' => $token->plainTextToken]]);
    }
}
