<?php

namespace App\DTOs;

use App\Models\Role;
use App\Models\User;
use Spatie\LaravelData\Data;

class DependencyRequestDTO extends Data
{
 
    public int $dependency_id;
}
