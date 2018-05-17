<?php

namespace Akuriatadev\Wordit\Controllers;

use Illuminate\Http\Request;

use Akuriatadev\Wordit\Requests\ModelRequest;

use App\Http\Controllers\Controller;

class ModelController extends Controller
{
    private $model;
    public function __construct(Request $request) {
        $this->model = null;

        foreach (config('wordit.models') as $model) {
            $getModelInstance = new $model;
            if ($request->segment(2) == $getModelInstance->getRouteName()) {
                $this->model = $getModelInstance;
            }
        }
    }

    public function index()
    {
        $collection = $this->model::all();
        $model = $this->model;

        return view('wordit::model.index', compact('collection', 'model'));
    }

    public function getCreate() {
        $model = $this->model[0];

        return view('wordit::model.create', compact('model'));
    }

    public function postCreate(ModelRequest $request) {

    }
}
