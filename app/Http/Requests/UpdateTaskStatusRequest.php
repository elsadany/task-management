<?php

namespace App\Http\Requests;

use App\DTOs\UpdateTaskStatusRequestDTO;
use App\Enums\TasksStatusEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class UpdateTaskStatusRequest extends FormRequest
{
    use WithData;

    protected string $dataClass = UpdateTaskStatusRequestDTO::class;
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
            'status' => ['required', 'in:' . implode(',', array_column(TasksStatusEnum::cases(), 'value'))],
        ];
    }
}
