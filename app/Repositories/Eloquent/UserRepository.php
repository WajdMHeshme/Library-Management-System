<?php

namespace App\Repositories\Eloquent;
use App\Models\User;
use App\Repositories\Contracts\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all()
    {
        return User::all();
    }

    public function findById($id)
    {
        return User::findOrFail($id);
    }

    public function create(array $user)
    {
        return User::create($user);
    }

    public function update($id, array $data)
    {
        $user = $this->findById($id);

        $user->update($data);

        return $user;
    }

    public function delete($id)
    {
        $user = $this->findById($id);

        return $user->delete();
    }
}
