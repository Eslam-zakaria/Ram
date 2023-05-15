<?php

namespace Modules\Lead\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Services\UploaderService;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Query\JoinClause;
use Modules\Lead\Models\Lead;
use Illuminate\Http\Request;
use Modules\Lead\Constants\LeadStatus;
use Modules\Specificity\Models\Specificity;
class LeadController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Lead.Resources.views.';

    public function index()
    {

        return view($this->viewsPath.'index');
    }

    public function edit(Lead $lead)
    {

        $speciality = Specificity::where('id',$lead->speciality)->first();

        $rates = unserialize($lead->rates);
        // dd($rates);
        
        return view($this->viewsPath.'edit',['form' => $lead ,'speciality' =>$speciality ,'rates' =>$rates]);
    }

    public function update(Lead $lead, Request $request) {
        $criteria = [
            'name' => 'required',
            'email' => 'required|email',
            'phone' => 'required',
        ];

        $request->validate($criteria);

        $lead->fill($request->request->all());

        $lead->save();

        return redirect()->route('admin.leads.index')->with(['success' => 'Updated Successfully']);
    }

    public function confirmed(Lead $lead, Request $request)
    {
        $lead->sent = LeadStatus::Confirmed;
        $lead->save();

        return redirect()->route('admin.leads.index')->with(['success' => 'Updated Successfully']);
    }

    public function unconfirmed(Lead $lead, Request $request)
    {
        $lead->sent = LeadStatus::NotConfirmed;
        $lead->save();

        return redirect()->route('admin.leads.index')->with(['success' => 'Updated Successfully']);
    }

    public function winner(Lead $lead, Request $request)
    {
        $lead->sent = LeadStatus::Winner;
        $lead->save();

        return redirect()->route('admin.leads.index')->with(['success' => 'Updated Successfully']);
    }

    public function exportCsv(Request $request)
    {
        // dd($request->all());
        $fileName = 'leads.csv';
        $leads = Lead::query()
            ->select('leads.*')
            ->with('branche', 'doctor')
            ->where(function ($query) use ($request) {
                $word = request()->get('q');
                $datefrom = request()->get('date_from');
                $dateto = request()->get('date_to');
                $status = (request()->get('status_filter'));
                $source = (request()->get('source_filter'));

                if(!empty($word)){
                   $query->where('leads.name', 'like', '%' . $word . '%')->orWhere('leads.phone',  'like', '%' . $word . '%');
                }
                if(!empty($datefrom)){

                   $query->whereDate('leads.created_at','>=', $datefrom)->whereDate('leads.created_at', '<=', $dateto);
                }
                if($status >= '0'){
                   $query->where('leads.sent' , $status);
                }

                if($source){
                    $query->where('leads.source' , $source);
                }

            })
            ->orderBy(request()->get('sort', 'leads.created_at'), request()->get('direction', 'DESC'))
            ->orderBy('leads.id', request()->get('direction', 'DESC'))
            ->get();

        $headers = array(
            "Content-type" => "text/csv",
            "Content-Disposition" => "attachment; filename=$fileName",
            "Pragma" => "no-cache",
            "Cache-Control" => "must-revalidate, post-check=0, pre-check=0",
            "Expires" => "0"
        );

        $columns = array('name', 'email', 'phone', 'status','source','branch', 'speciality', 'doctor', 'created_at');

        $callback = function () use ($leads, $columns) {
            $file = fopen('php://output', 'w');
            fputcsv($file, $columns);

            foreach ($leads as $lead) {
                // $speciality = Specificity::where('id',$lead->speciality)->first();
                $row['name'] = $lead->name;
                $row['email'] = $lead->email;
                $row['phone'] = $lead->phone;
                if($lead->sent >= 0) {
                $row['status'] = LeadStatus::getLabel($lead->sent);
                } else {
                $row['status'] = 'N/A' ;
                }
                $row['source'] = $lead->source;
                $row['branch'] = $lead->branche->name;
                $row['speciality'] = $lead->speciality->name;
                $row['doctor'] = $lead->doctor->name;
                $row['created_at'] = date('Y-m-d H:i A', strtotime($lead->created_at));

                fputcsv($file, array($row['name'], $row['email'], $row['phone'], $row['status'] , $row['source'] , $row['branch'], $row['speciality'], $row['doctor'], $row['created_at']));
            }

            fclose($file);
        };

        return response()->stream($callback, 200, $headers);
    }
}

