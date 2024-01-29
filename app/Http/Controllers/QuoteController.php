<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\QuoteCategory;
use Illuminate\Http\Request;

class QuoteController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quotes = Quote::join('quote_categories', 'quotes.quote_category_id', 'quote_categories.id')
            ->selectRaw('quotes.*, quote_categories.name AS category')
            ->paginate(10);

        return view('quotes.index', compact(['quotes']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = QuoteCategory::all();

        return view('quotes.form', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'author' => 'required|max:255',
            'content' => 'required|max:2048',
            'quote_category_id' => 'required',
        ]);

        Quote::create($validatedData);

        return redirect()->route('quotes.index')
            ->with('success', 'Quote created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Quote $quote)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Quote $quote)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Quote $quote)
    {
        //
    }
}
