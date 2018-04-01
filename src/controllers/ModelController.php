<?php

namespace Akuriatadev\Wordit\Controllers;

use Illuminate\Http\Request;

use Akuriatadev\Wordit\Requests\ModelRequest;

use App\Http\Controllers\Controller;

class ModelController extends Controller
{
    private $model;

    public function __construct(Request $request) {
        $this->modelName = collect(config('wordit.models'))->where('route_name', $request->segment(2))->first()['model'];
        $this->model = new $this->modelName;
    }

    public function index()
    {
        $collection = $this->model::all();
        $model = $this->model;

        return view('wordit::model.index', compact('collection', 'model'));
    }

    public function create() {
        $model = $this->model[0];

        return view('wordit::model.create', compact('model'));
    }

    public function createStore(ModelRequest $request) {

    }
}
