<?php

namespace Modules\Doctor\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Query\JoinClause;
use Modules\Branche\Models\Branche;
use Modules\Doctor\Models\Doctor;
use Modules\Country\Models\Country;
use Modules\Service\Models\Service;
use Illuminate\Http\Request;
use Modules\Specificity\Models\Specificity;
use PhpParser\Comment\Doc;
use Validator;
use Modules\Doctor\Http\Requests\DoctorStoreRequest;
use Modules\Doctor\Http\Requests\DoctorUpdateRequest;
class DoctorController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Doctor.Resources.views.';

    public function index()
    {

        return view($this->viewsPath . 'index');
    }


    public function create()
    {
        $currentLocale = config('app.locale');
        $specificities = Specificity::join('specificity_translations', function (JoinClause $join) {
            $join->on('specificity_translations.specificity_id', '=', 'specificities.id');
        })->where('specificity_translations.locale', 'ar')->pluck('specificity_translations.name', 'specificities.id');
        $branches = Branche::join('branche_translations', function (JoinClause $join) {
            $join->on('branche_translations.branche_id', '=', 'branches.id');
        })->where('branche_translations.locale', 'ar')->pluck('branche_translations.name', 'branches.id');

        $countries = Country::listsTranslations('name')->get();

        $services = Service::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();

        return view($this->viewsPath . 'create', [
            'specificities' => $specificities,
            'branches'  => $branches ,'countries' => $countries ,'services' => $services
        ]);
    }

    public function store(DoctorStoreRequest $request)
    {

        try {
            $doctor = new Doctor();
            $doctor->fill($request->request->all());

            if ($request->hasFile('image')) {
                $doctor->image = $this->uploaderService->upload($request->file("image"), "doctors");
            }

            $doctor->save();

            if ($branches = $request->get('branche')) {
                $doctor->branches()->attach($branches);
            }
            if ($specificities = $request->get('specificity')) {
                $doctor->specificities()->attach($specificities);
            }
            return redirect()->route('admin.doctors.index')->with(['success' => 'Updated Successfully']);
        }catch (\Exception $ex) {

            return redirect()->back()->withInput($request->all());
        }

    }


    public function edit(Doctor $doctor)
    {

        $doctorBranchesIds = [];
        if (count($doctor->branches) > 0 ) {
            foreach($doctor->branches as $branch) {
                $doctorBranchesIds[] = $branch->id;
            }
        }

        $doctorSpecificitiesIds = [];
        if (count($doctor->specificities) > 0 ) {
            foreach($doctor->specificities as $specificity) {
                $doctorSpecificitiesIds[] = $specificity->id;
            }
        }
        $currentLocale = config('app.locale');
        $specificities = Specificity::join('specificity_translations', function (JoinClause $join) {
            $join->on('specificity_translations.specificity_id', '=', 'specificities.id');
        })->where('specificity_translations.locale', 'ar')->where('specificities.service_id', $doctor->specialty_id)->pluck('specificity_translations.name', 'specificities.id');
        $branches = Branche::join('branche_translations', function (JoinClause $join) {
            $join->on('branche_translations.branche_id', '=', 'branches.id');
        })->where('branche_translations.locale', 'ar')->where('branches.country_id', $doctor->country_id)->pluck('branche_translations.name', 'branches.id');

        $countries = Country::listsTranslations('name')->get();

        $services = Service::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();
        // dd($doctor);

        return view($this->viewsPath . 'edit', ['form' => $doctor,
            'specificities' => $specificities,
            'branches' => $branches,
            'doctorBranchesIds' => $doctorBranchesIds,
            'doctorSpecificitiesIds' => $doctorSpecificitiesIds,'countries' => $countries ,'services' => $services
        ]);
    }


    public function update(Doctor $doctor, DoctorUpdateRequest $request)
    {
        try {
            $doctor->fill($request->request->all());

            if ($request->hasFile('image')) {
                $doctor->image = $this->uploaderService->upload($request->file("image"), "doctors");
            }

            if ($branches = $request->get('branche')) {
                $doctor->branches()->sync($branches);
            }

            if ($specificities = $request->get('specificity')) {
                $doctor->specificities()->sync($specificities);
            }
            $doctor->save();

            return redirect()->route('admin.doctors.index')->with(['success' => 'Updated Successfully']);

        }catch (\Exception $ex) {

            return redirect()->back()->withInput($request->all());
        }

    }

    public function enable(Doctor $doctor, Request $request)
    {
        $doctor->status = Statuses::ACTIVE;
        $doctor->save();

        return redirect()->route('admin.doctors.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Doctor $doctor, Request $request)
    {
        $doctor->status = Statuses::DISABLED;
        $doctor->save();

        return redirect()->route('admin.doctors.index')->with(['success' => 'Updated Successfully']);
    }

    public function BranchAjax(Request $request)
    {
        $branches = Branche::listsTranslations('name')->where('country_id', $request->country_id)->where('status', Statuses::ACTIVE)->get();
        if (!count($branches) > 0) {
            return response()->json(['status' => 401, 'data' => []], 200);
        }
        return response()->json(['status' => 200, 'data' => $branches], 200);
    }

    public function SpecificityAjax(Request $request)
    {
        $specialties = Specificity::listsTranslations('name')->where('service_id', $request->specialty_id)->where('status', Statuses::ACTIVE)->get();
        if (!count($specialties) > 0) {
            return response()->json(['status' => 401, 'data' => []], 200);
        }
        return response()->json(['status' => 200, 'data' => $specialties], 200);
    }
}

