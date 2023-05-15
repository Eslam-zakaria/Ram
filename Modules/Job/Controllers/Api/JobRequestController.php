<?php

namespace Modules\Job\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Modules\Job\Models\JobRequest;
use Modules\Lead\Models\Lead;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class JobRequestController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    public function index(Request $request)
    {
            $users = JobRequest::query()
                ->select('job_requests.*')
                ->with('job')
                ->when($request->get('q'), function (Builder $query) {
                    $word = request()->get('q');

                    return $query->whereRaw("(job_requests.name like '%{$word}%' OR job_requests.phone like '%{$word}%' )");
                })
                ->orderBy(request()->get('sort', 'job_requests.created_at'), request()->get('direction', 'DESC'))
                ->orderBy('job_requests.id', request()->get('direction', 'DESC'))
                ->paginate(10);

        return response()->json($users);
    }

    public function store(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'notes' => '',
            'job_id' => 'required',
            'source' => '',
        ];

        $request->validate($criteria);

        $jobRequest = new JobRequest();
        $jobRequest->fill($request->request->all());
        if ($request->hasFile('resume')) {
            $jobRequest->resume = $this->uploaderService->upload($request->file("resume"), "job-requests");
        }

        $jobRequest->save();

        return response()->json($jobRequest);
    }
}
