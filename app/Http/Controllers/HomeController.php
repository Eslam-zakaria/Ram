<?php

namespace App\Http\Controllers;

use App\Constants\Statuses;
use App\Http\Requests\Search\GlobalSearchRequest;
use Illuminate\Http\Request;
use Modules\Blog\Models\Blog;
use Modules\Doctor\Models\Doctor;
use Modules\Partner\Models\Partner;
use Modules\Service\Models\Service;
use Modules\Branche\Models\Branche;
use Modules\Specificity\Models\Specificity;
use Modules\Slider\Models\Slider;
use Modules\Specificity\Models\Category;
use Modules\Testimonial\Models\Testimonial;
use Modules\Country\Models\Country;
use Modules\Ticket\Constants\TicketPurpose;
use Modules\Ticket\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Illuminate\Support\Collection;
use Session;
class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::query()->with('translations')->where('status', Statuses::ACTIVE)->get();

        $sliders = Slider::query()->with('translations')->get();

        $doctors = Doctor::query()->with('translations', 'branches.translations', 'service.translations')->where('status', Statuses::ACTIVE)->inRandomOrder()->limit(30)->get();

        $testimonials = Testimonial::query()->with('translations')->where('status', Statuses::ACTIVE)->get();

        $partners = Partner::get();

        $articles = Blog::query()->with('translations', 'category.translations')->where('status', Statuses::ACTIVE)->limit(6)->orderBy('created_at', 'DESC')->get();

        $services = Service::query()->with('translations')->where('status', Statuses::ACTIVE)->whereIn('type_of_place',[1,3])->get();

        $countries = Country::query()->with('translations', 'branche.translations')->has('branche')->get();

        return view('web.home.index', compact('categories', 'doctors', 'partners', 'articles', 'sliders', 'testimonials', 'services','countries'));
    }

    public function subscribe(Request $request)
    {
        $criteria = [
            'phone' => 'required',
        ];

        $request->validate($criteria);

        try {
            $lead = new Ticket();
            $lead->purpose = TicketPurpose::SUBSCRIBTON;
            $lead->name = "N/A";
            $lead->email = "N/A";
            $lead->topic = "SUBSCRIPTION";
            $lead->content = "SUBSCRIPTION";

            $lead->fill($request->request->all());
            $lead->save();
        } catch (\Exception $exception) {
        }

        return redirect()->route('web.pages.thanks', ['lang' => Session::get('locale')])->with(['success' => 'Updated Successfully']);
    }

    /**
     * Get to the specification page to display search results.
     *
     * @param GlobalSearchRequest $request
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function search(GlobalSearchRequest $request)
    {
        return view('web.home.search');
    }
}
