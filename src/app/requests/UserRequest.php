<?php

namespace Akuriatadev\Wordit\App\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UserRequest extends FormRequest
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
        if ($this->route('id') == null) {
            $id = '';
        } else {
            $id = ',' . $this->route('id');
        }

        return [
            'name' => 'required|min:3|max:64',
            'email' => 'required|min:5|max:120|unique:users,email' . $id,
            'group_id' => 'required|numeric|exists:groups,id'
        ];
    }
}
