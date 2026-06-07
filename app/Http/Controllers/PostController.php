<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\Post;
use Illuminate\Support\Str;

class PostController extends Controller
{
    /**
     * Display listing of posts (Admin).
     */
    public function index()
    {
        $posts = Post::latest()->paginate(10);
        return view('admin.posts.index', compact('posts'));
    }

    /**
     * Show form to create new post (Admin).
     */
    public function create()
    {
        return view('admin.posts.create');
    }

    /**
     * Store new post (Admin).
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:draft,published',
        ]);

        $validated['slug'] = Str::slug($validated['title']);

        // Handle unique slug
        $count = Post::where('slug', 'like', $validated['slug'] . '%')->count();
        if ($count > 0) {
            $validated['slug'] .= '-' . ($count + 1);
        }

        if ($request->hasFile('image')) {
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image_path'] = $imagePath;
        }

        Post::create($validated);

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil diterbitkan.');
    }

    /**
     * Show form to edit post (Admin).
     */
    public function edit(Post $post)
    {
        return view('admin.posts.edit', compact('post'));
    }

    /**
     * Update post (Admin).
     */
    public function update(Request $request, Post $post)
    {
        $validated = $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'status' => 'required|string|in:draft,published',
        ]);

        // Regenerate slug if title changed
        if ($validated['title'] !== $post->title) {
            $validated['slug'] = Str::slug($validated['title']);
            $count = Post::where('slug', 'like', $validated['slug'] . '%')->where('id', '!=', $post->id)->count();
            if ($count > 0) {
                $validated['slug'] .= '-' . ($count + 1);
            }
        }

        if ($request->hasFile('image')) {
            // Delete old image
            if ($post->image_path && \Storage::disk('public')->exists($post->image_path)) {
                \Storage::disk('public')->delete($post->image_path);
            }
            $imagePath = $request->file('image')->store('posts', 'public');
            $validated['image_path'] = $imagePath;
        }

        $post->update($validated);

        return redirect()->route('posts.index')->with('success', 'Artikel berhasil diperbarui.');
    }

    /**
     * Delete post (Admin).
     */
    public function destroy(Post $post)
    {
        if ($post->image_path && \Storage::disk('public')->exists($post->image_path)) {
            \Storage::disk('public')->delete($post->image_path);
        }
        $post->delete();
        return redirect()->route('posts.index')->with('success', 'Artikel berhasil dihapus.');
    }

    /**
     * Show single public blog post.
     */
    public function showPublic($slug)
    {
        $post = Post::where('slug', $slug)->where('status', 'published')->firstOrFail();
        return view('post_show', compact('post'));
    }
}
}
