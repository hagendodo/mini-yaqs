<?php

namespace App\Http\Controllers;

use App\Models\Quote;
use App\Models\QuoteCategory;
use App\Models\QuoteLike;
use App\Models\User;
use App\Models\Video;
use App\Models\VideoCategory;
use Illuminate\Http\Request;
use Illuminate\View\View;

class HomeController extends Controller
{
    public function index()
    {
        return view('clients.index');
    }

    public function home(): View
    {
        $videos = Video::select('videos.*', 'video_categories.name')
            ->selectRaw('COUNT(video_likes.ip) AS likes')
            ->join('video_categories', 'videos.video_category_id', '=', 'video_categories.id')
            ->leftJoin('video_likes', 'videos.id', '=', 'video_likes.video_id')
            ->groupBy('videos.id')
            ->groupBy('videos.title')
            ->groupBy('videos.url')
            ->groupBy('videos.video_category_id')
            ->groupBy('videos.created_at')
            ->groupBy('videos.updated_at')
            ->groupBy('video_categories.name')
            ->latest()
            ->limit(6)
            ->get();

        return view('clients.home', compact(['videos']));
    }

    public function quotes(Request $request)
    {
        $quotes = Quote::select('quotes.*', 'quote_categories.name')
            ->selectRaw('COUNT(quote_likes.ip) AS likes')
            ->join('quote_categories', 'quotes.quote_category_id', '=', 'quote_categories.id')
            ->leftJoin('quote_likes', 'quotes.id', '=', 'quote_likes.quote_id')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('quotes.content', 'LIKE', '%' . $request->search . '%')
                        ->orWhere('quotes.author', 'LIKE', '%' . $request->search . '%');
                });
            })
            ->when($request->category, function ($query) use ($request) {
                $query->where('quote_categories.id', $request->category);
            })
            ->groupBy('quotes.id')
            ->groupBy('quotes.author')
            ->groupBy('quotes.content')
            ->groupBy('quotes.quote_category_id')
            ->groupBy('quotes.created_at')
            ->groupBy('quotes.updated_at')
            ->groupBy('quote_categories.name')
            ->paginate(12);

        $latestQuotes = Quote::latest()->limit(3)->get();

        $categories = QuoteCategory::all();

        return view('clients.quotes', compact(['quotes', 'categories', 'latestQuotes']));
    }

    public function videos(Request $request)
    {
        $videos = Video::select('videos.*', 'video_categories.name')
            ->selectRaw('COUNT(video_likes.ip) AS likes')
            ->join('video_categories', 'videos.video_category_id', '=', 'video_categories.id')
            ->leftJoin('video_likes', 'videos.id', '=', 'video_likes.video_id')
            ->when($request->search, function ($query) use ($request) {
                $query->where(function ($query) use ($request) {
                    $query->where('videos.title', 'LIKE', '%' . $request->search . '%');
                });
            })
            ->groupBy('videos.id')
            ->groupBy('videos.title')
            ->groupBy('videos.url')
            ->groupBy('videos.video_category_id')
            ->groupBy('videos.created_at')
            ->groupBy('videos.updated_at')
            ->groupBy('video_categories.name')
            ->paginate(12);

        $latestVideo = Video::latest()->first();

        $categories = VideoCategory::all();

        return view('clients.videos', compact(['videos', 'categories', 'latestVideo']));
    }

    public function about(): View
    {
        return view('clients.about');
    }

    public function dashboard(): View
    {
        return view('clients.admin.dashboard');
    }
}
