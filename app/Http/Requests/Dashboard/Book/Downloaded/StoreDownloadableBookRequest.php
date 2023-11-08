<?php

namespace App\Http\Requests\Dashboard\Book\Downloaded;

use Illuminate\Foundation\Http\FormRequest;

class StoreDownloadableBookRequest extends FormRequest
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
            'name_en'=>['required','string','max:256','min:2'],
            'name_ar'=>['required','string','max:256','min:2'],
            'desc_en'=>['required','string'],
            'desc_ar'=>['required','string'],
            'publisher_en'=>['required','string'],
            'publisher_ar'=>['required','string'],
            'released_date'=>['required','date'],
            'status'=>['required','integer','between:0,1'],
            'category_id'=>['required','integer','exists:categories,id'], //263231231132
            'author_id'=>['required','integer','exists:authors,id'],
            'file'=>['required','file'],
            'size'=>['required','string'],
            'no_pages'=>['required','integer'],
            'image'=>['required','image','max:1000','mimes:png,jpg,jpeg'],
        ];
    }
}
