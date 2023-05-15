<?php

namespace App\Http\Controllers\Admin;

use App\Constants\Roles;
use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Modules\Blog\Models\Blog;

class UserController extends Controller
{
    public function index()
    {
        return view('admin.users.index');
    }

    public function create()
    {
        return view('admin.users.create');
    }

    public function store(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'email' => 'required|email|unique:users',
        ];

        $request->validate($criteria);
        $user = new User();
        $user->fill($request->request->all());
        $user->setRole($request->get('role'));
        $user->setEmailVerifiedAt(now());
        $user->save();

        return redirect()->route('admin.users.index')->with(['success' => 'Updated Successfully']);
    }


    public function edit(User $user)
    {
        return view('admin.users.edit',['form' => $user]);
    }

    public function update(User $user, Request $request) {
        $criteria = [
            'name' => 'required',
            'email' => 'required|email|unique:users,email,'.$user->id,
        ];

        $request->validate($criteria);

        if(!$request->get('password')) {
            $request->request->remove('password');
        }

        $user->setRole($request->get('role'));
        $user->setActive($user->active);
        $user->fill($request->all());
        $user->save();

        return redirect()->route('admin.users.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(User $user, Request $request)
    {
        $user->setActive(Statuses::ACTIVE);
        $user->save();

        return redirect()->route('admin.users.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(User $user, Request $request)
    {
        $user->setActive(Statuses::DISABLED);
        $user->save();

        return redirect()->route('admin.users.index')->with(['success' => 'Updated Successfully']);
    }
}

