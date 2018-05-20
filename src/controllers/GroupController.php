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
        $groups = Group::withoutRoots()->paginate(20);

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
        $group = Group::create([
            'name' => $request->input('name')
        ]);
        $group->permission()->create($request->except('name'));

        return response()->json([
            'redirect' => route('wordit.admin.groups.index')
        ]);
    }

    public function getUpdate($id)
    {
        $group = Group::withoutRoots()->findOrFail($id);
        $permissions = array_values($this->getAllPermissionsFillable());

        return view('wordit::groups.update', [
            'permissions' => $permissions,
            'group' => $group
        ]);
    }

    public function postUpdate(GroupRequest $request, $id)
    {
        $group = Group::withoutRoots()->findOrFail($id);

        $group->update([
            'name' => $request->input('name')
        ]);
        $group->permission()->update($this->getPermissionData($request));

        return response()->json([
            'redirect' => route('wordit.admin.groups.index')
        ]);
    }

    public function delete($id)
    {
        $group = Group::withoutRoots()->findOrFail($id);

        $group->permission()->delete();
        $group->users()->update([
            'group_id' => 2
        ]);
        $group->delete();

        return response()->json([
            'redirect' => route('wordit.admin.groups.index')
        ]);
    }

    public function destroy()
    {
        // Create a deleting multiple groups
    }

    private function getPermissionData($request)
    {
        $data = [];
        foreach (array_values($this->getAllPermissionsFillable()) as $perm) {
            if (in_array($perm, array_keys($request->except(['name', '_token'])))) {
                $data[$perm] = true;
            } else {
                $data[$perm] = false;
            }
        }

        return $data;
    }
}
