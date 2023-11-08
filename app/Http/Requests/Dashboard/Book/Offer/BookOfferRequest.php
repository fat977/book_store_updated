<?php

namespace App\Http\Requests\Dashboard\Book\Offer;

use Illuminate\Foundation\Http\FormRequest;

class BookOfferRequest extends FormRequest
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
            'purchased_book_id'=>['required','integer','exists:purchased_books,id'], //263231231132
            'offer_id'=>['required','integer','exists:offers,id'],
            'price'=>['required'],
        ];
    }
}
