<?php

namespace App\Http\Controllers;

use App\Models\QuoteLike;
use Illuminate\Http\Request;

class QuoteLikeController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'quote_id' => 'required|integer',
        ]);

        $model = new QuoteLike();
        $model->ip = $request->ip();
        $model->quote_id = $validatedData['quote_id'];
        $model->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($ip)
    {
        return QuoteLike::where('ip', $ip)->exists();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(QuoteLike $quoteLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, QuoteLike $quoteLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = QuoteLike::findOrFail($id);

        $model->delete();

        return redirect()->back();
    }
}
