<?php

namespace App\Http\Requests;

use App\DTOs\TaskRequestDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class TaskRequest extends FormRequest
{
    use WithData;

    protected string $dataClass = TaskRequestDTO::class;
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
        $id = $this->route('task')?$this->route('task')->id:'';
        return [
            'title' => 'required|string',
            'description' => 'required|string',
            'due_date' => 'required|date|after:tomorrow',
            'assignee_id' => 'required|exists:users,id',
            'dependencies' => 'required|array',
            'dependencies.*' => [
                'required',
                Rule::exists('tasks', 'id')->where(function ($query) use ($id) {
                    $query->where('id', '!=', $id); // Exclude the current task
                }),
            ],

        ];
    }
}
