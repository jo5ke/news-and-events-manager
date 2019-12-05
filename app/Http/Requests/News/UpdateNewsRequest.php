<?php

namespace App\Http\Requests;

use App\Http\Requests\Request;

class UpdateNewsRequest extends Request
{
    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        $rules = [
            'title' => 'required',
            'image' => 'required|image',
            'description' => 'required',
            'post_type' => 'required',
            'post_type' => 'required',
            //'poster_image' => 'mimes:jpeg,png'
        ];

        return $rules;
    }
}
