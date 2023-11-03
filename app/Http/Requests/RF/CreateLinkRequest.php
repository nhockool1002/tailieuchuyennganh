<?php

namespace App\Http\Requests\RF;

use Illuminate\Foundation\Http\FormRequest;

class CreateLinkRequest extends FormRequest
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
            'name' => 'required|unique:link_creator|max:255',
            'url'   => 'required|url'
        ];
    }
}
