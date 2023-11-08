<?php

namespace App\Http\Requests\Dashboard\User\Address;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class CityRequest extends FormRequest
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
            //
            'name_en' =>['required','string'],
            'name_ar' =>['required','string'],
            'status'=>['required','integer','between:0,1'],
            'shipping'=>['required','numeric'],
        ];
    }
}
