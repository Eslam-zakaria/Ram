<?php

namespace Modules\Country\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Country\Models\Country;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class CountryController extends Controller
{
    public function index(Request $request)
    {
        $users = Country::query()
            ->when($request->get('q'), function (Builder $query) {
                $word = request()->get('q');

                return $query->whereRaw("(countries.name like '%{$word}%' OR countries.key like '%{$word}%')");
            })
            ->orderBy(request()->get('sort', 'countries.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('countries.id', request()->get('direction', 'DESC'))
            ->paginate(10);

        return response()->json($users);
    }
}
