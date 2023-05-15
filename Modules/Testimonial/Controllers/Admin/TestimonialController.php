<?php

namespace Modules\Testimonial\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Query\JoinClause;
use Modules\Testimonial\Models\Testimonial;
use Illuminate\Http\Request;
use Modules\Specificity\Models\Specificity;
use PhpParser\Comment\Doc;
use Modules\Testimonial\Http\Requests\TestimonialStoreRequest;
use Modules\Testimonial\Http\Requests\TestimonialUpdateRequest;

class TestimonialController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Testimonial.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }


    public function create()
    {
        return view($this->viewsPath.'create');
    }

    public function store(TestimonialStoreRequest $request) {

        $testimonial = new Testimonial();
        $testimonial->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $testimonial->image = $this->uploaderService->upload($request->file("image"), "testimonials");
        }

        $testimonial->save();


        return redirect()->route('admin.testimonials.index')->with(['success' => 'Updated Successfully']);
    }


    public function edit(Testimonial $testimonial)
    {

        return view($this->viewsPath.'edit',['form' => $testimonial,
        ]);
    }


    public function update(Testimonial $testimonial, TestimonialUpdateRequest $request) {

        $testimonial->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $testimonial->image = $this->uploaderService->upload($request->file("image"), "testimonials");
        }

        $testimonial->save();



        return redirect()->route('admin.testimonials.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(Testimonial $testimonial, Request $request) {
        $testimonial->status = Statuses::ACTIVE;
        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Testimonial $testimonial, Request $request) {
        $testimonial->status = Statuses::DISABLED;
        $testimonial->save();

        return redirect()->route('admin.testimonials.index')->with(['success' => 'Updated Successfully']);
    }
}

