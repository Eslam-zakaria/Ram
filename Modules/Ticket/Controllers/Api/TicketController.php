<?php

namespace Modules\Ticket\Controllers\Api;

use App\Http\Controllers\Controller;
use Modules\Ticket\Models\Ticket;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;

class TicketController extends Controller
{
    public function index(Request $request)
    {
            $tickets = Ticket::query()
                ->select('tickets.*')
                ->when($request->get('q'), function (Builder $query) {
                    $word = request()->get('q');

                    return $query->whereRaw("(tickets.name like '%{$word}%' OR tickets.phone like '%{$word}%' )");
                })->when($request->get('reason'), function (Builder $query) {
                    $reason = request()->get('reason');

                    return $query->where('tickets.purpose', $reason);
                })
                ->orderBy(request()->get('sort', 'tickets.created_at'), request()->get('direction', 'DESC'))
                ->orderBy('tickets.id', request()->get('direction', 'DESC'))
                ->paginate(10);

        return response()->json($tickets);
    }

    public function store(Request $request)
    {
        $criteria = [
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'purpose' => 'required',
            'content' => 'required',
            'topic' => 'required'
        ];

        $request->validate($criteria);

        $ticket = new Ticket();
        $ticket->fill($request->request->all());
        $ticket->save();

        return response()->json($ticket);
    }
}
