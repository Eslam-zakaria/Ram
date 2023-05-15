<?php

namespace Modules\Slider\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Slider\Models\Slider;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class SliderController extends Controller
{
    public function index(Request $request)
    {
            $sliders = Slider::query()
                ->select('sliders.*')
                ->orderBy(request()->get('sort', 'sliders.created_at'), request()->get('direction', 'DESC'))
                ->orderBy('sliders.id', request()->get('direction', 'DESC'))
                ->paginate(10);

        return response()->json($sliders);
    }
}
