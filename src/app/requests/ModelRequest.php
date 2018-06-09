<?php

namespace Akuriatadev\Wordit\App\Requests;

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
        $model = null;
        foreach (config('wordit.models') as $model) {
            $getModelInstance = new $model;
            if ($this->segment(2) == $getModelInstance->getRouteName()) {
                $model = $getModelInstance;
            }
        }

        return $model->getValidationRules();
    }
}
