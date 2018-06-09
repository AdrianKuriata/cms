<?php

namespace Akuriatadev\Wordit\App\Controllers;

use Illuminate\Http\Request;

use Akuriatadev\Wordit\App\Requests\ModelRequest;

use App\Http\Controllers\Controller;

class ModelController extends Controller
{
    private $model;

    public function __construct(Request $request)
    {
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

    public function getCreate()
    {
        $model = $this->model;

        return view('wordit::model.create', compact('model'));
    }

    public function postCreate(ModelRequest $request)
    {
        $model = $this->model;
        $model::create($request->all());

        return response()->json([
            'redirect' => route('wordit.admin.'. $model->getRouteName() .'.index')
        ]);
    }

    public function getUpdate($id)
    {
        $model = $this->model;
        $model_data = $model::findOrFail($id);

        return view('wordit::model.update', compact('model', 'model_data'));
    }

    public function postUpdate(ModelRequest $request, $id)
    {
        $model = $this->model;
        $model_data = $model::findOrFail($id);

        $model_data->update($request->all());

        return response()->json([
            'redirect' => route('wordit.admin.'. $model->getRouteName() .'.index')
        ]);
    }

    public function delete($id)
    {
        $model = $this->model;
        $data = $model::findOrFail($id);

        $data->delete();

        return response()->json([
            'redirect' => route('wordit.admin.'. $model->getRouteName() .'.index')
        ]);
    }
}
