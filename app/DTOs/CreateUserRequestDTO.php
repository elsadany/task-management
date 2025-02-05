<?php
namespace App\DTOs;

use App\Enums\UsersRoleEnum;
use App\Models\Role;
use Spatie\LaravelData\Data;

class CreateUserRequestDTO extends Data
{
    public string $name;
    public string $email;
    public UsersRoleEnum $role_id;
    public string $password;

}