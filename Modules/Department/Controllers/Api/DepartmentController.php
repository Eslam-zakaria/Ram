<?php

namespace Modules\Department\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Department\Models\Department;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class DepartmentController extends Controller
{
    public function index(Request $request)
    {
        $departments = Department::query()
            ->distinct()
            ->select('departments.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('department_translations', function (JoinClause $join) {
                    $join->on('department_translations.department_id', '=', 'departments.id');
                });

                return $query->whereRaw("(department_translations.name like '%{$word}%') or departments.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'departments.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('departments.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($departments);
    }
}
