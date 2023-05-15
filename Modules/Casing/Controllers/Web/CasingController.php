<?php

namespace Modules\Casing\Controllers\Web;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Http\Request;
use Modules\Casing\Models\Casing;
use Modules\Casing\Models\CasingCategory;
use Modules\Comment\Constants\CommentStatus;
use Modules\Comment\Models\Comment;

class CasingController extends Controller
{
    private $viewsPath = 'Casing.Resources.views.';

    public function index(Request $request)
    {
        $cases = Casing::where('status', Statuses::ACTIVE);

        if ($request->has('category')) {
            $cases = $cases->where('category_id', $request->get('category'));
        }

        $cases = $cases->paginate(6);
        $categories = CasingCategory::get();


        return view($this->viewsPath.'web.index', compact('cases', 'categories'));
    }
}