<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blog = Blog::where('user_id', auth()->id())->get();
        return view('myblog', compact('blog'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $blog = Blog::where('user_id', auth()->id())->get();
        return view('myblog-create', compact('blog'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'judul_artikel' => 'required|min:3',
            'content'       => 'required',
            'cover'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $coverPath = null;
        if ($request->hasFile('cover')) {
            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        Blog::create([
            'user_id'       => auth()->id(),
            'judul_artikel' => $request->judul_artikel,
            'content'       => $request->content,
            'cover'         => $coverPath,
            'penulis'       => auth()->user()->name,
        ]);

        return redirect()->route('myblog');
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        $blog = Blog::where('id_blog', $id)->firstOrFail();
        return view('detail-blog', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::where('id_blog', $id)->where('user_id', auth()->id())->firstOrFail();
        return view('myblog-edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $blog = Blog::where('id_blog', $id)->where('user_id', auth()->id())->firstOrFail();

        $request->validate([
            'judul_artikel' => 'required|min:3',
            'content'       => 'required',
            'cover'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240',
        ]);

        $coverPath = $blog->cover;

        if ($request->hasFile('cover')) {
            // Hapus cover lama jika ada
            if ($blog->cover) {
                \Storage::disk('public')->delete($blog->cover);
            }

            $coverPath = $request->file('cover')->store('covers', 'public');
        }

        $blog->update([
            'judul_artikel' => $request->judul_artikel,
            'content'       => $request->content,
            'cover'         => $coverPath,
        ]);

        return redirect()->route('myblog');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $blog = Blog::where('id_blog', $id)->where('user_id', auth()->id())->firstOrFail();

        if ($blog->cover) {
            \Storage::disk('public')->delete($blog->cover);
        }

        $blog->delete();
        return redirect()->route('myblog');
    }
}