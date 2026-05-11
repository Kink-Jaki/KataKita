<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index(Request $request)
    {
        $blog = Blog::when($request->search, function ($query) use ($request) {
                $query->where('judul_artikel', 'like', '%' . $request->search . '%');
            })
            ->latest()
            ->paginate(6)
            ->withQueryString();

        return view('home', compact('blog'));
    }
}