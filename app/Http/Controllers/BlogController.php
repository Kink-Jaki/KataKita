<?php

namespace App\Http\Controllers;

use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Laravel\Facades\Image;

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
        'cover'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:10240', // fix bug 1
    ]);

    $coverPath = null;
    if ($request->hasFile('cover')) {
        $file     = $request->file('cover');
        $filename = time() . '_' . pathinfo($file->getClientOriginalName(), PATHINFO_FILENAME); // fix bug 2

        $folder = storage_path('app/public/covers/');
        if (!file_exists($folder)) {
            mkdir($folder, 0755, true);
        }

        Image::read($file)
            ->scale(width: 1200)
            ->toWebp(quality: 80)
            ->save($folder . $filename . '.webp');

        $coverPath = 'covers/' . $filename . '.webp';
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
        'cover'         => 'nullable|image|mimes:jpg,jpeg,png,webp|max:2048',
    ]);
    $coverPath = $blog->cover; // pakai gambar lama dulu
    if ($request->hasFile('cover')) {
        // Hapus gambar lama
        if ($blog->cover) {
            Storage::disk('public')->delete($blog->cover);
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
        $blog->delete();
        return redirect()->route('myblog');
    }
}
