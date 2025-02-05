<?php

namespace App\Enums;

enum TasksStatusEnum :string
{
    case PENDING = 'pending';
    case COMPLETED = 'completed';
    case CANCELED = 'canceled';
}
