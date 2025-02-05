<?php

namespace App\Models;

use App\Enums\TasksStatusEnum;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;
    protected $guarded = ['id'];
    function dependencies()
    {
        return $this->belongsToMany(self::class, 'task_dependencies', 'task_id', 'dependency_id');
    }

    function assignedTo()
    {
        return $this->belongsTo(User::class, 'assignee_id');
    }

    function scopePending($query)
    {
        return $query->where('status', TasksStatusEnum::PENDING->value);
    }
}
