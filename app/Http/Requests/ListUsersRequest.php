<?php

namespace App\Http\Requests;

use App\Enums\UsersRoleEnum;
use Illuminate\Foundation\Http\FormRequest;

class ListUsersRequest extends FormRequest
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
            'role' => ['string', 'in:'. implode(',', array_column(UsersRoleEnum::cases(), 'value'))],
            'page' => ['integer', 'gt:1']
        ];
    }
}
