<?php

namespace Akuriatadev\Wordit\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ModelRequest extends FormRequest
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
        $route_name = explode('.', $this->route()->getName())[2];
        $model = collect(config('wordit.models'))->where('route_name', $route_name)->all()[0];

        $validation = [];

        foreach ($model['form'] as $m) {
            $validation[$m['name']] = $m['validation'];
        }

        return $validation;
    }
}
