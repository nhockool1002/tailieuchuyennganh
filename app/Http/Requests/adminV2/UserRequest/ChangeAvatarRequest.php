<?php

namespace App\Http\Requests\adminV2\UserRequest;

use Illuminate\Foundation\Http\FormRequest;

class ChangeAvatarRequest extends FormRequest
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
            'file' => 'required|image|mimes:png,jpg,jpeg,gif|max:1024', // 1MB in kilobytes
        ];
    }

    /**
     * Response message for update avatar for users
     *
     * @return array
     */
    public function messages()
    {
        return [
            'file.required' => 'Please choose a file to upload.',
            'file.image' => 'Invalid file type. Please select an image (png, jpg, jpeg, gif).',
            'file.mimes' => 'Invalid file type. Please select an image (png, jpg, jpeg, gif).',
            'file.max' => 'File size exceeds the maximum limit of 1MB.',
        ];
    }
}
