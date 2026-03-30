<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Controller;
use App\Jobs\Getters\AnggaranBelanjaSubDanaJob;
use App\Models\Getters\GetAnggaranBelanjaSubDana;
use Illuminate\Http\Request;

class AnggaranBelanjaSubDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSubDana::query()->where('status_getter', true)
            ->orderBy('id')->get();

        return response()->json(['status' => true, 'data' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['data' => ['required', 'array']]);

        dispatch(new AnggaranBelanjaSubDanaJob($validated['data']));

        return response()->json(['status' => true]);
    }
}
