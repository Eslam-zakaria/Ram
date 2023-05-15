<?php

namespace Modules\Ticket\Controllers\Admin;

use App\Constants\BookingStatuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Modules\Booking\Models\Booking;
use Modules\Ticket\Constants\TicketPurpose;
use Modules\Ticket\Models\Ticket;

class TicketController extends Controller
{
    private $viewsPath = 'Ticket.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }

    public function edit(Ticket $ticket)
    {

        
        return view($this->viewsPath.'edit',['form' => $ticket]);
    }

    public function update(Ticket $ticket, Request $request) {
        $criteria = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ];

        $request->validate($criteria);

        $ticket->fill($request->request->all());

        $ticket->save();

        return redirect()->route('admin.tickets.index')->with(['success' => 'Updated Successfully']);
    }

    public function exportCsv(Request $request)
    {
        $fileName = 'tickets.csv';

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
            ->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('name', 'email', 'phone', 'topic' , 'content', 'purpose');

        $callback = function () use ($tickets, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($tickets as $ticket) {
                $row['name'] = $ticket->name;
                $row['email'] = $ticket->email;
                $row['phone'] = $ticket->phone;
                $row['topic'] = $ticket->topic;
                $row['content'] = $ticket->content;
                $row['purpose'] = TicketPurpose::getLabel($ticket->purpose);

                fputcsv($file, array($row['name'], $row['email'], $row['phone'], $row['topic'] ,$row['content'], $row['purpose']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }

}

