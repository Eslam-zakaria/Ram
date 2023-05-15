<?php

namespace Modules\Job\Controllers\Web;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Http\Request;
use Modules\Job\Models\Job;
use Modules\Job\Models\JobRequest;
use Session;
use Validator;

class JobController extends Controller
{
    private $viewsPath = 'Job.Resources.views.';

    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    public function index()
    {
        $jobs = Job::where('status', Statuses::ACTIVE)->paginate(12);

        return view($this->viewsPath.'web.index', compact('jobs'));
    }

    public function details($id)
    {
        $job = Job::find($id);
        return view($this->viewsPath.'web.details', compact('job'));
    }

    public function apply($id)
    {
        $job = Job::find($id);

        return view($this->viewsPath.'web.apply', compact('job'));
    }

    public function store(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'email' => 'required',
            'phone' => 'required',
            'resume' => 'required',
            'nationality' => 'required',
            'birthdate' => 'required',
            'job_id' => 'required',
        ];

        $request->validate($criteria);

        $jobRequest = new JobRequest();
        $jobRequest->fill($request->request->all());
        if ($request->hasFile('resume')) {
            $jobRequest->resume = $this->uploaderService->upload($request->file("resume"), "resumes");
        }
        $jobRequest->save();

        return redirect('careers' . ( app()->getLocale() != 'ar' ? ( '/?lang=' . app()->getLocale() ) : ''))->with(['success' => 'Updated Successfully']);
    }
}
