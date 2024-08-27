<?php

namespace App\Repositories\Blog;

use App\Events\BlogUpdated;
use App\Models\Blog;
use Illuminate\Support\Facades\Auth;

class BlogRepository implements BlogRepositoryInterface
{
    protected $model;

    public function __construct(Blog $model)
    {
        $this->model = $model;
    }

    public function paginate(int $perPage = 25)
    {
        return $this->model->orderBy('created_at', 'desc')->paginate($perPage);
    }

    public function all()
    {
        return Blog::all();
    }

    public function find($id)
    {
        return Blog::findOrFail($id);
    }

    public function create(array $data)
    {
        return Blog::create($data);
    }

    public function update($id, array $data)
    {
        $blog = $this->find($id);

        // Always store the updated_user_id
        $data['updated_user_id'] = Auth::id();

        // Update the blog
        $updated = $blog->update($data);

        // If another user (not the creator) updates, trigger the BlogUpdated event
        if (Auth::id() !== $blog->user_id) {
            event(new BlogUpdated($blog, Auth::user()));
        }
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        return $blog->delete();
    }
}
