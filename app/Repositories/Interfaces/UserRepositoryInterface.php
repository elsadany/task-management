<?php

namespace App\Repositories\Interfaces;

use App\Models\Role;
use App\Models\Task;
use App\Models\User;

interface UserRepositoryInterface
{
    public function all(array $data);
    public function findByEmail($email);
    public function create(array $data);
    public function update(User $user, array $data);
}
