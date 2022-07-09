<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class CreateLink extends FormRequest
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
            'title' => ['required'],
            'link' => ['required']
        ];
    }

    /**
     * Get marker attributes for validator errors.
     *
     * @return array
     */
    public function attributes()
    {
        return [
            'title' => "Link Title",
            'link' => "URL"
        ];
    }
}
