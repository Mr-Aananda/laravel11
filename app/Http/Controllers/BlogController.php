<?php

namespace App\Http\Controllers;

use App\Events\BlogUpdated;
use App\Http\Requests\BlogRequest;
use App\Models\Blog;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = Blog::all();
        return view('blog.index', compact('blogs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('blog.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(BlogRequest $request)
    {
        $data = $request->validated();

        try {
            DB::transaction(function () use ($request, $data) {
                $data['slug'] = Str::slug($request->title);
                $data['user_id'] = Auth::id();
                Blog::create($data);
            });

            return redirect()->back()->with('success', 'Blog created successfully!');
        } catch (\Exception $e) {

            Log::error('Error creating blog:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('An error occurred while creating the blog.');
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = Blog::findOrFail($id);
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        $blog = Blog::findOrFail($id);
        $data = $request->validated();

        try {
            DB::transaction(function () use ($blog, $data) {
                $data['slug'] = Str::slug($data['title']);
                // $data['user_id'] = Auth::id();
                $blog->update($data);

                // Fire the BlogUpdated event
                event(new BlogUpdated($blog, Auth::user()));
            });

            return redirect()->route('blog.index')->with('success', 'Blog updated successfully!');
        } catch (\Exception $e) {
            Log::error('Error updating blog:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('An error occurred while updating the blog.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        try {
            $blog = Blog::findOrFail($id);
            $blog->delete();

            return redirect()->route('blog.index')->with('success', 'Blog deleted successfully!');
        } catch (\Exception $e) {

            return redirect()->back()->withErrors('An error occurred while deleting the blog.');
        }
    }
}
