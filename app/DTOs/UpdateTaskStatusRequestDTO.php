<?php

namespace App\DTOs;

use App\Enums\TasksStatusEnum;
use Spatie\LaravelData\Data;

class UpdateTaskStatusRequestDTO extends Data
{
    public TasksStatusEnum $status;
}
