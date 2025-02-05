<?php
namespace App\Repositories;

use App\Models\Task;
use App\Models\User;
use App\Repositories\Interfaces\UserRepositoryInterface;

class UserRepository implements UserRepositoryInterface
{
    public function all(array $filters = [])
    {
        return User::query()
            ->when($filters['role'] ?? null, function ($query, $role) {
                $query->where('role', $role);
            })->latest()->paginate(20);
    }
    public function create(array $data)
    {
        return User::create($data);
    }
    public function update(User $user, array $data)
    {
        $user->update($data);
        return $user;
    }
    public function findByEmail($email){
        return User::where('email', $email)->first();
    }

}
