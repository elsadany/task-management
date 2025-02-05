<?php

namespace App\Http\Requests;

use App\DTOs\DependencyRequestDTO;
use App\DTOs\TaskRequestDTO;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;
use Spatie\LaravelData\WithData;

class DependencyRequest extends FormRequest
{
    use WithData;

    protected string $dataClass = DependencyRequestDTO::class;
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
      
            'dependency_id' => 'required|exists:tasks,id',

        ];
    }
}
