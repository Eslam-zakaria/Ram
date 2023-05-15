<?php

namespace Modules\Job\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Modules\Lead\Models\Lead;
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

    private $viewsPath = 'Job.Resources.views.JobRequest.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }

    public function edit(Lead $lead)
    {
        return view($this->viewsPath.'edit',['form' => $lead]);
    }

    public function update(Lead $lead, Request $request) {
        $criteria = [
            'name' => 'required',
            'branche_id' => 'required',
            'offer_id' => 'required',
            'phone' => 'required',
        ];

        $request->validate($criteria);

        $lead->fill($request->request->all());

        $lead->save();

        return redirect()->route('admin.leads.index')->with(['success' => 'Updated Successfully']);
    }
}

