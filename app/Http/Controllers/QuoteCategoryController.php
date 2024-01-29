<?php

namespace App\Http\Controllers;

use App\Models\QuoteCategory;
use Illuminate\Http\Request;

class QuoteCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $quoteCategories = QuoteCategory::paginate(10);

        return view('quote-categories.index', compact('quoteCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('quote-categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $quoteCategory = QuoteCategory::create($validatedData);

        return redirect()->route('quote-categories.index')
            ->with('success', 'Quote Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(QuoteCategory $quoteCategory)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $quoteCategory = QuoteCategory::where('id', $id)->first();
        return view('quote-categories.form', compact(['quoteCategory']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $quoteCategory = QuoteCategory::where('id', $id);
        $quoteCategory->update($validatedData);

        return redirect()->route('quote-categories.index')
            ->with('success', 'Quote Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        QuoteCategory::destroy($id);

        return redirect()->route('quote-categories.index')
            ->with('success', 'Quote Category deleted successfully');
    }
}
