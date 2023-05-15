<?php

namespace Modules\Specificity\Controllers\Web;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Modules\Specificity\Models\Category;
use Modules\Specificity\Models\Specificity;

class SpecificityController extends Controller
{
    private $viewsPath = 'Specificity.Resources.views.';

    public function index(Request $request)
    {
        $specialityId = $request->get('id');
        $selectedSpeciality = $specialityId ? Specificity::find($specialityId): null;

        $categories = Category::query()->where('status', Statuses::ACTIVE)->get();

        return view($this->viewsPath.'web.index', compact('categories', 'selectedSpeciality'));
    }
}
