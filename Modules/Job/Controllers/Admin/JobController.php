<?php

namespace Modules\Job\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Modules\Branche\Models\Branche;
use Modules\Department\Models\Department;
use Modules\Job\Models\Job;
use Illuminate\Http\Request;
use Modules\Job\Http\Requests\JobStoreRequest;
use Modules\Job\Http\Requests\JobUpdateRequest;

class JobController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Job.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }


    public function create()
    {
        $branches = Branche::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();
        $departments = Department::listsTranslations('name')->get();

        return view($this->viewsPath.'create', compact("branches", "departments"));
    }

    public function store(JobStoreRequest $request) {

        $job = new Job();
        $job->fill($request->request->all());

        $job->save();

        return redirect()->route('admin.jobs.index')->with(['success' => 'Updated Successfully']);
    }


    public function edit(Job $job)
    {
        $branches = Branche::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();
        $departments = Department::listsTranslations('name')->get();

        return view($this->viewsPath.'edit',['form' => $job, 'departments' => $departments, 'branches' => $branches]);
    }


    public function update(Job $job, JobUpdateRequest $request) {

        $job->fill($request->request->all());

        $job->save();

        return redirect()->route('admin.jobs.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(Job $job, Request $request) {
        $job->status = Statuses::ACTIVE;
        $job->save();

        return redirect()->route('admin.jobs.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Job $job, Request $request) {
        $job->status = Statuses::DISABLED;
        $job->save();

        return redirect()->route('admin.jobs.index')->with(['success' => 'Updated Successfully']);
    }
}

