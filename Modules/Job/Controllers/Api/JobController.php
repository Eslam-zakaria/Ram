<?php

namespace Modules\Job\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Job\Models\Job;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class JobController extends Controller
{
    public function index(Request $request)
    {
        $jobs = Job::query()
            ->distinct()
            ->select('jobs.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('job_translations', function (JoinClause $join) {
                    $join->on('job_translations.job_id', '=', 'jobs.id');
                });

                return $query->whereRaw("(job_translations.name like '%{$word}%') or jobs.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'jobs.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('jobs.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($jobs);
    }
}
