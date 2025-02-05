<?php

namespace App\Http\Requests;

use App\DTOs\ListTasksRequestDTO;
use App\Enums\TasksStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class ListTasksRequest extends FormRequest
{
  
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'status' => ['in:' . implode(',', array_column(TasksStatusEnum::cases(), 'value'))],
            'date_from' => ['nullable', 'date'],
            'date_to' => ['nullable', 'date'],
            'assignee_id' => ['nullable', 'exists:users,id'],
            'page' => ['nullable', 'integer', 'gt:1']
        ];
    }
}
