<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreReviewRequest extends FormRequest
{
    public function authorize()
    {
        return true; // مهم جدًا عشان الطلب يشتغل
    }

    public function rules()
    {
        return [
            'name' => ['required', 'max:50'],
            'phone' => ['required'],
            'email' => ['required', 'email'],
            'subject' => ['required'],
            'message' => ['required'],
        ];
    }
}

