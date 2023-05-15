<?php

namespace Modules\Discount\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Modules\Discount\Models\Card;
use Illuminate\Http\Request;
use Modules\Discount\Http\Requests\CardStoreRequest;
use Modules\Discount\Http\Requests\CardUpdateRequest;

class CardController extends Controller
{
    private $viewsPath = 'Discount.Resources.views.Card.';

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
        return view($this->viewsPath.'create');
    }

    public function store(CardStoreRequest $request) {

        $card = new Card();
        $card->fill($request->request->all());

        if ($request->hasFile('image')) {
            $card->image = $this->uploaderService->upload($request->file("image"), "cards");
        }
        $card->status = 2;
        $card->save();
        return redirect()->route('admin.cards.index')->with(['success' => 'Updated Successfully']);
    }

    public function edit(Card $Card)
    {
        $cards = Card::listsTranslations('name')->pluck('name', 'id');

        return view($this->viewsPath.'edit',['form' => $Card,
            'cards' => $cards,
        ]);
    }

    public function update(Card $card, CardUpdateRequest $request) {


        $card->fill($request->all());

        if ($request->hasFile('image')) {
            $card->image = $this->uploaderService->upload($request->file("image"), "cards");
        }

        $card->save();

        return redirect()->route('admin.cards.index')->with(['success' => 'Updated Successfully']);
    }


    public function enable(Card $Card, Request $request)
    {
        $Card->status = Statuses::ACTIVE;
        $Card->save();

        return redirect()->route('admin.cards.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Card $Card, Request $request)
    {
        $Card->status = Statuses::DISABLED;
        $Card->save();

        return redirect()->route('admin.cards.index')->with(['success' => 'Updated Successfully']);
    }
}

