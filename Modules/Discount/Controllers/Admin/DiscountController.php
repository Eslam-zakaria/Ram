<?php

namespace Modules\Discount\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Query\JoinClause;
use Modules\Discount\Models\Card;
use Modules\Discount\Models\DiscountCategory;
use Modules\Discount\Models\Discount;
use Illuminate\Http\Request;
use Modules\Discount\Http\Requests\DiscountStoreRequest;
use Modules\Discount\Http\Requests\DiscountUpdateRequest;

class DiscountController extends Controller
{
    private $viewsPath = 'Discount.Resources.views.';

    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    public function index()
    {

        return view($this->viewsPath.'index');
    }

    public function create()
    {
        $cards = Card::listsTranslations('name')->get();
        $currentLocale = config('app.locale');
        $categories = DiscountCategory::listsTranslations('name')->get();


        return view($this->viewsPath.'create', compact('cards', 'categories'));
    }

    public function store(DiscountStoreRequest $request) {

        $discount = new Discount();
        $discount->fill($request->request->all());

        $discount->save();
        return redirect()->route('admin.discounts.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(Discount $Discount)
    {
        $currentLocale = config('app.locale');
        $categories = DiscountCategory::listsTranslations('name')->get();

        $cards = Card::listsTranslations('name')->get();

        return view($this->viewsPath.'edit',['form' => $Discount,
            'categories' => $categories,
            'cards' => $cards,
            ]);
    }

    public function update(Discount $discount, DiscountUpdateRequest $request) {

        $discount->fill($request->all());

        $discount->save();

        return redirect()->route('admin.discounts.index')->with(['success' => 'Updated Successfully']);
    }


    public function enable(Discount $Discount, Request $request)
    {
        $Discount->status = Statuses::ACTIVE;
        $Discount->save();

        return redirect()->route('admin.discounts.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Discount $Discount, Request $request)
    {
        $Discount->status = Statuses::DISABLED;
        $Discount->save();

        return redirect()->route('admin.discounts.index')->with(['success' => 'Updated Successfully']);
    }
}

