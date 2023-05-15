<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class UserController extends Controller
{
    public function index(Request $request)
    {
        $users = User::query()
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');

                return $query->whereRaw("(users.name like '%{$word}%' OR users.email like '%{$word}%' OR users.id = '{$word}')");
            })->when(($request->get('status')), function (Builder $query) {

                return $query->where("users.active", (integer) request()->get('status'));
            })->when(($request->get('role')), function (Builder $query) {

                return $query->where("users.role", (integer) request()->get('role'));
            })
            ->orderBy(request()->get('sort', 'created_at'), request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($users);
    }
}
