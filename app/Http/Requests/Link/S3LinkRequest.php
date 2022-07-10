<?php

namespace App\Http\Requests\Link;

use Illuminate\Foundation\Http\FormRequest;

class S3LinkRequest extends FormRequest
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
            'itemS3' => ['required'],
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
            'itemS3' => "File",
        ];
    }
}
