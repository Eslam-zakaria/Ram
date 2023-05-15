<?php

namespace Modules\Testimonial\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Modules\Testimonial\Models\Testimonial;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Specificity\Models\Specificity;

class TestimonialController extends Controller
{
    public function index(Request $request)
    {
        $testimonials = Testimonial::query()
            ->distinct()
            ->select('testimonials.*')
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');
                $query->join('testimonial_translations', function (JoinClause $join) {
                    $join->on('testimonial_translations.testimonial_id', '=', 'testimonials.id');
                });

                return $query->whereRaw("(testimonial_translations.name like '%{$word}%') or testimonials.id = '%{$word}%'");
            })
            ->orderBy(request()->get('sort', 'testimonials.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('testimonials.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($testimonials);
    }


    public function listSpecialtiesbyBrnache($locale, $testimonial)
    {
        $testimonial = Testimonial::find($testimonial);
        return response()->json($testimonial->specificities);
    }
}
