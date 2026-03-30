<?php

namespace App\Http\Controllers\Getters;

use App\Http\Controllers\Controller;
use App\Jobs\Getters\AnggaranBelanjaSubJob;
use App\Models\Getters\GetAnggaranBelanjaSub;
use Illuminate\Http\Request;

class AnggaranBelanjaSubController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $result = GetAnggaranBelanjaSub::query()->where('status_getter', true)
            ->orderBy('id')->get();

        return response()->json(['status' => true, 'data' => $result]);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate(['data' => ['required', 'array']]);

        dispatch(new AnggaranBelanjaSubJob($validated['data']));

        return response()->json(['status' => true]);
    }
}
