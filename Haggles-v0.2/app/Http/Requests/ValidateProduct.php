<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ValidateProduct extends FormRequest
{

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
        $rules = [
            'product_name' => 'required',
            'product_regular_price' => 'required',
            'product_weight' => 'required',
            'product_length' => 'required',
            'product_width' => 'required',
            'product_height' => 'required',
        ];

        $photos = count($this->input('photos'));

        foreach (range(0, $photos) as $index) {
           
            $rules['photos/'. $index] = 'image|mimes:jpeg,bmp,png|max:2000';
        }

        return $rules;
    }
}
