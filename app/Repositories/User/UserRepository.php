<?php

namespace App\Repositories\User;

use App\Models\User;
use Illuminate\Support\Facades\Hash;


class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::select('id','name','email')
        ->orderBy('name', 'asc')
        ->get();
    }

    public function find($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $data)
    {
        $data['password'] = Hash::make($data['password']);
        return User::create($data);

    }

    public function update($id, array $data)
    {
        $user = User::findOrFail($id);
        if (isset($data['password']) && !empty($data['password'])) {
            $data['password'] = Hash::make($data['password']);
        } else {
            unset($data['password']);
        }
        return $user->update($data);
    }

    public function delete($id)
    {
        $user = User::findOrFail($id);
        return $user->delete();

    }
}
