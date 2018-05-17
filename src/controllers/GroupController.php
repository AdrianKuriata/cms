<?php

namespace Akuriatadev\Wordit\Controllers;

use Illuminate\Http\Request;

use App\Http\Controllers\Controller;
use Akuriatadev\Wordit\Models\Group;
use Akuriatadev\Wordit\Traits\WorditTrait;
use Akuriatadev\Wordit\Requests\GroupRequest;

class GroupController extends Controller
{
    use WorditTrait;

    public function index()
    {
        $groups = Group::withCount('users')->paginate(20);

        return view('wordit::groups.index', [
            'groups' => $groups
        ]);
    }

    public function getCreate()
    {
        $permissions = array_values($this->getAllPermissionsFillable());

        return view('wordit::groups.create', [
            'permissions' => $permissions
        ]);
    }

    public function postCreate(GroupRequest $request)
    {
        $groupData = [
            'name' => $request->input('name'),
        ];

        $group = Group::create($groupData);
        $group->permission()->create($request->except('name'));

        return response()->json([
            'redirect' => route('wordit.admin.groups.index')
        ]);
    }
}
