<?php

namespace App\Http\Requests\User;

use App\Models\User;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\JsonResponse;
use Illuminate\Validation\Rule;
use Illuminate\Validation\ValidationException;

class UpdateUserRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules()
    {
        $user = User::find(request()->id);

        return [
            'name' => [
                'required'
            ],
            'image' => [
                'image',
                'mimes:png,jpg,jpeg'
            ],
            'nip' => [
                'required',
                Rule::unique('users')->ignore($user)
            ]
        ];
    }

    /**
     * Fill the model with an array of attributes.
     *
     * @param  \Illuminate\Contracts\Validation\Validator  $validator
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    protected function failedValidation(Validator $validator)
    {
        $response = new JsonResponse([
            'meta' => [
                'messages' => $validator->errors(),
                'status_code' => 400,
            ],
        ], 400);

        throw new ValidationException($validator, $response);
    }
}
