<?php

namespace App\Http\Requests\Auth;

use App\DTOs\CreateUserRequestDTO;
use App\Enums\UsersRoleEnum;
use Illuminate\Foundation\Http\FormRequest;
use Spatie\LaravelData\WithData;

class CreateUserRequest extends FormRequest
{
    use WithData;

    protected string $dataClass = CreateUserRequestDTO::class;
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
            'email' => 'required|email|unique:users,email',
            'name' => 'required|string',
            'role' => 'required|in'. implode(',', array_column(UsersRoleEnum::cases(), 'value')),
            'password' => 'required|string|min:8|confirmed',

        ];
    }
}
