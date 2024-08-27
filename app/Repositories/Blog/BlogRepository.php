<?php

namespace App\Repositories\Blog;

use App\Models\Blog;

class BlogRepository implements BlogRepositoryInterface
{
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
        $blog = Blog::findOrFail($id);
        return $blog->update($data);
    }

    public function delete($id)
    {
        $blog = Blog::findOrFail($id);
        return $blog->delete();
    }
}
