<?php

namespace Akuriatadev\Wordit\Controllers;

use Illuminate\Http\Request;
use Akuriatadev\Wordit\Models\User;
use Akuriatadev\Wordit\Models\Group;
use Akuriatadev\Wordit\Requests\UserRequest;
use App\Http\Controllers\Controller;

class UserController extends Controller
{
    public function index ()
    {
        $users = User::withoutRoots()->paginate(10);
        return view('wordit::users.index', compact('users'));
    }

    public function getCreate()
    {
        $groups = Group::withoutRoots()->pluck('name', 'id');

        return view('wordit::users.create', [
            'groups' => $groups
        ]);
    }

    public function postCreate(UserRequest $request)
    {
        $user = User::create([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        $user->group()->associate($request->input('group_id'));
        $user->save();

        return response()->json([
            'redirect' => route('wordit.admin.users.index')
        ]);
    }

    public function getUpdate($id)
    {
        $user = User::withoutRoots()->findOrFail($id);
        $groups = Group::withoutRoots()->pluck('name', 'id');

        return view('wordit::users.update', [
            'groups' => $groups,
            'user' => $user
        ]);
    }

    public function postUpdate(UserRequest $request, $id)
    {
        $user = User::withoutRoots()->findOrFail($id);

        $user->update([
            'name' => $request->input('name'),
            'email' => $request->input('email')
        ]);
        $user->group()->associate($request->input('group_id'));
        $user->save();

        return response()->json([
            'redirect' => route('wordit.admin.users.index')
        ]);
    }

    public function delete($id)
    {
        $user = User::withoutRoots()->findOrFail($id);
        $user->delete();

        return response()->json([
            'redirect' => route('wordit.admin.users.index')
        ]);
    }

    public function destroy()
    {
        // Create a deleting multiple users
    }
}
