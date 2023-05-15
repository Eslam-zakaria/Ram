<?php

namespace Modules\Department\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Department\Models\Department;
use Illuminate\Http\Request;
use Modules\Department\Http\Requests\DepartmentStoreRequest;
use Modules\Department\Http\Requests\DepartmentUpdateRequest;

class DepartmentController extends Controller
{
    private $viewsPath = 'Department.Resources.views.';

    public function index()
    {
        return view($this->viewsPath.'index');
    }

    public function create()
    {
        return view($this->viewsPath.'create');
    }

    public function store(DepartmentStoreRequest $request) {

        $category = new Department();
        $category->fill($request->request->all());

        $category->save();
        return redirect()->route('admin.departments.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(Department $department)
    {
        return view($this->viewsPath.'edit',['form' => $department]);
    }

    public function update(Department $department, DepartmentUpdateRequest $request) {

        $department->fill($request->all());
        $department->save();

        return redirect()->route('admin.departments.index')->with(['success' => 'Updated Successfully']);
    }

    public function deleted(Department $department, Request $request) {


        $department->delete();

        return redirect()->route('admin.departments.index')->with(['success' => 'Deleted Successfully']);
    }
}

