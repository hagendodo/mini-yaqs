<?php

namespace App\Http\Controllers;

use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;

class VideoController extends Controller
{
    private function formatYouTubeUrl($url) {
        preg_match('/(?:youtube\.com\/(?:[^\/]+\/[^\/]+\/|(?:v|e(?:mbed)?)\/|[^#]*[?&]v=)|youtu\.be\/)([^"&?\/\s]{11})/', $url, $matches);
        $videoId = isset($matches[1]) ? $matches[1] : null;

        if ($videoId) {
            return "https://www.youtube.com/embed/$videoId";
        } else {
            return $url;
        }
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $videos = Video::join('video_categories', 'videos.video_category_id', 'video_categories.id')
            ->selectRaw('videos.*, video_categories.name AS category')
            ->paginate(10);

        return view('videos.index', compact(['videos']));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $categories = VideoCategory::all();

        return view('videos.form', compact(['categories']));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:2048',
            'video_category_id' => 'required',
        ]);

        $validatedData['url'] = $this->formatYouTubeUrl($validatedData['url']);
        Video::create($validatedData);

        return redirect()->route('videos.index')
            ->with('success', 'Video created successfully');
    }

    /**
     * Display the specified resource.
     */
    public function show(Video $video)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Video $video)
    {
        $categories = VideoCategory::all();

        return view('videos.form', compact(['categories', 'video']));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request,  $id)
    {
        $validatedData = $request->validate([
            'title' => 'required|max:255',
            'url' => 'required|max:2048',
            'video_category_id' => 'required',
        ]);

        $vide = Video::where('id', $id);
        $validatedData['url'] = $this->formatYouTubeUrl($validatedData['url']);
        $vide->update($validatedData);

        return redirect()->route('videos.index')
            ->with('success', 'Video Updated successfully');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        Video::destroy($id);

        return redirect()->route('videos.index')
            ->with('success', 'Video Deleted successfully');
    }
}
