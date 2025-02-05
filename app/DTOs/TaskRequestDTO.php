<?php

namespace App\DTOs;

use App\Models\Role;
use App\Models\User;
use Spatie\LaravelData\Data;

class TaskRequestDTO extends Data
{
    public string $title;
    public string $description;
    public string $due_date;
    public int $assignee_id;
}
