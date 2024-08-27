<?php

namespace App\Http\Controllers;

use App\Http\Requests\BlogRequest;
use App\Repositories\Blog\BlogRepositoryInterface;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class BlogController extends Controller
{
    protected $blogRepository;

    public function __construct(BlogRepositoryInterface $blogRepository)
    {
        $this->blogRepository = $blogRepository;
    }

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $blogs = $this->blogRepository->paginate(25);
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
        $data['slug'] = Str::slug($data['title']);
        $data['user_id'] = Auth::id();

        try {
            DB::transaction(function () use ($data) {
                $this->blogRepository->create($data);
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
        $blog = $this->blogRepository->find($id);
        return view('blog.show', compact('blog'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $blog = $this->blogRepository->find($id);
        return view('blog.edit', compact('blog'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(BlogRequest $request, string $id)
    {
        $data = $request->validated();
        $data['slug'] = Str::slug($data['title']);

        try {
            DB::transaction(function () use ($id, $data) {
                $this->blogRepository->update($id, $data);
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
            DB::transaction(function () use ($id) {
                $this->blogRepository->delete($id);
            });

            return redirect()->route('blog.index')->with('success', 'Blog deleted successfully!');
        } catch (\Exception $e) {
            Log::error('Error deleting blog:', ['error' => $e->getMessage()]);
            return redirect()->back()->withErrors('An error occurred while deleting the blog.');
        }
    }
}
