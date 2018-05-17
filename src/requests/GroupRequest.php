<?php

namespace Akuriatadev\Wordit\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Akuriatadev\Wordit\Traits\WorditTrait;

class GroupRequest extends FormRequest
{
    use WorditTrait;
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
        $permissions = array_values($this->getAllPermissionsFillable());

        $validation = [
            'name' => 'required|min:3|max:64'
        ];

        foreach ($permissions as $perm) {
            $validation[$perm] = 'sometimes|nullable|boolean';
        }

        return $validation;
    }
}
