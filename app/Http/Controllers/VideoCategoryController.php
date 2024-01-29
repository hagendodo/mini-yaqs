<?php

namespace App\Http\Controllers;

use App\Models\VideoCategory;
use Illuminate\Http\Request;

class VideoCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videoCategories = VideoCategory::paginate(10);

        return view('video-categories.index', compact('videoCategories'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('video-categories.form');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);

        $videoCategory = VideoCategory::create($validatedData);

        return redirect()->route('video-categories.index')
            ->with('success', 'Video Category created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(VideoCategory $videoCategory)
    {

    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $videoCategory = VideoCategory::where('id', $id)->first();
        return view('video-categories.form', compact(['videoCategory']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'name' => 'required|max:255',
        ]);
        $videoCategory = VideoCategory::where('id', $id);
        $videoCategory->update($validatedData);

        return redirect()->route('video-categories.index')
            ->with('success', 'Video Category updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        VideoCategory::destroy($id);

        return redirect()->route('video-categories.index')
            ->with('success', 'Video Category deleted successfully');
    }
}
