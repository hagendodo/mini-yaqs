<?php

namespace App\Http\Controllers;

use App\Models\VideoLike;
use Illuminate\Http\Request;

class VideoLikeController extends Controller
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
            'video_id' => 'required|integer',
        ]);

        $model = new VideoLike();
        $model->ip = $request->ip();
        $model->video_id = $validatedData['video_id'];
        $model->save();

        return redirect()->back();
    }

    /**
     * Display the specified resource.
     */
    public function show($ip)
    {
        return VideoLike::where('ip', $ip)->exists();
    }


    /**
     * Show the form for editing the specified resource.
     */
    public function edit(VideoLike $videoLike)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, VideoLike $videoLike)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $model = VideoLike::findOrFail($id);

        $model->delete();

        return redirect()->back();
    }
}
