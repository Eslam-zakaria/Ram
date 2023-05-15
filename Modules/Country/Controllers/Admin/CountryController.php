<?php

namespace Modules\Country\Controllers\Admin;

use App\Http\Controllers\Controller;
use Modules\Country\Models\Country;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    private $viewsPath = 'Country.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }

    public function edit(Country $country)
    {
        return view($this->viewsPath.'edit',['form' => $country]);
    }

    public function update(Country $country, Request $request) {
        $criteria = [
            'en' => 'array',
            'ar' => 'array',
            'en.name' => 'required',
            'ar.name' => 'required',
            'key' => 'required',
        ];

        $request->validate($criteria);

        $country->fill($request->all());
        $country->save();

        return redirect()->route('admin.countries.index')->with(['success' => 'Updated Successfully']);
    }
}

