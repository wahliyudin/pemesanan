<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
     * @return array
     */
    public function rules()
    {
        return [
            'nama' => 'nullable',
            'keterangan' => 'nullable',
            'harga' => 'nullable',
            'photo' => 'nullable|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'category_id' => 'nullable'
        ];
    }
}
