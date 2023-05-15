<?php

namespace Modules\Offer\Controllers\Admin;

use App\Constants\Statuses;
use App\Http\Controllers\Controller;
use Illuminate\Database\Query\JoinClause;
use App\Http\Services\UploaderService;
use Modules\Offer\Models\Offer;
use Modules\Offer\Models\OfferBranche;
use Modules\Branche\Models\Branche;
use Illuminate\Http\Request;
use Modules\Service\Models\Service;
use PhpParser\Comment\Doc;
use Modules\Offer\Http\Requests\OfferStoreRequest;
use Modules\Offer\Http\Requests\OfferUpdateRequest;

class OfferController extends Controller
{
    /**
     * @var UploaderService
     */
    private $uploaderService;

    public function __construct(UploaderService $uploaderService)
    {
        $this->uploaderService = $uploaderService;
    }

    private $viewsPath = 'Offer.Resources.views.';

    public function index()
    {
        return view($this->viewsPath.'index');
    }


    public function create()
    {
        $currentLocale = config('app.locale');
        $services = Service::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();

        $branches = OfferBranche::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();

        $GetALlPages = $this->GetPagesFromLp();

        $Listbranches = Branche::listsTranslations('name')->get();

        return view($this->viewsPath.'create', compact('services','branches','GetALlPages','Listbranches'));
    }

    public function store(OfferStoreRequest $request) {
 
        $IdPages  = $request->request->get('pages');
        $discount = settings()->get('discount.percentage.offers') ? settings()->get('discount.percentage.offers') : '';
        $price = $request->request->get('price');
        if($discount && $price > 0){
            $price = ((int)$price - ((int)$price * (int)$discount / 100));
        }
        $offer = new Offer();
        $offer->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $offer->image = $this->uploaderService->upload($request->file("image"), "offers");
        }

        if ($request->hasFile('slider_image') ) {
            $offer->slider_image = $this->uploaderService->upload($request->file("slider_image"), "offers");
        }
        if($discount && $price > 0){
            $offer->discount = (int)$discount;
            $offer->price_after_discount = $price;
        }

        $offer->save();

        if ($branches = $request->get('branche')) {
            $offer->branches()->attach($branches);
        }

        //============SaveInRamLp==============//
            $data = [
                "name"  => $offer->name,
                "price" => $offer->price,
                "image" => $offer->image,
                "pages" => $IdPages
            ];
            $curl = curl_init();

            curl_setopt_array($curl, array(
            CURLOPT_URL => 'https://ram.medical-clinics.net/api/save-offer-withpages',
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_ENCODING => '',
            CURLOPT_MAXREDIRS => 10,
            CURLOPT_TIMEOUT => 0,
            CURLOPT_FOLLOWLOCATION => true,
            CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
            CURLOPT_CUSTOMREQUEST => 'GET',
            CURLOPT_POSTFIELDS => json_encode($data),
            CURLOPT_HTTPHEADER => array(
                'Content-Type: application/json',
                'Cookie: XSRF-TOKEN=eyJpdiI6InZ2TjBoKzNXOEdrblRMV1hDcEpIQnc9PSIsInZhbHVlIjoiSEduclRjOTdwQjBZTWpuTkJMVG5XM1lpRTVxWmVxdHA4ckhsMmNQajFWWWpiajAxc1hCTUh6cC9scDJWOEw1NG9BZXhlZk5hbk16SDQxREVDZ1RVS3I3cHZxSGhieENabmUya0pyaUcxVkgzaHhxL0p0dmlDV09ZeUZGejl1NXEiLCJtYWMiOiI2ODUzNTg2ZjU3N2NlNjU0NTQwZmQ0OTY1ZTI3MjliZDJhNDNhNGZjODFjMDdkOWQxMzA5ZjQyZDhkN2Q4OTdiIn0%3D; laravel_session=eyJpdiI6IkxvTmFOSStSeGhhUGliUm85OFVmNnc9PSIsInZhbHVlIjoiQ1M3NHgzTFJMZEtWTHdHMldPb0crcFRpOTFJeHo3V3R4eEMvRzhPVmNESnF3b3hZblZCZ0VKeFBpNFFDWEJ6Y3ZyTDQrQXVobzZYdXQzQUI0WlpmZE1PdUhCbHNOZmRGeWVvT1VycXFpbGlEZXh6K04vRUdoRlNhaTd0RWpxL20iLCJtYWMiOiJmYTdiOTA2NjhhNTYxNjU5MDZkODgyZThlYjAxOTAzZDEzYjViMmRmZjE1NTY1MGQ0MGIyNmNjY2Q4ZGQ3MzZjIn0%3D'
            ),
            ));

            $response = curl_exec($curl);

            curl_close($curl);

            return redirect()->route('admin.offers.index')->with(['success' => 'Created Successfully']);
    }


    public function edit(Offer $offer)
    {

        $offerBranchesIds = [];
        if (count($offer->branches) > 0 ) {
            foreach($offer->branches as $branch) {
                $offerBranchesIds[] = $branch->id;
            }
        }

        $currentLocale = config('app.locale');
        $services = Service::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();

        $branches = OfferBranche::where('status', Statuses::ACTIVE)->listsTranslations('name')->get();

        $Listbranches = Branche::join('branche_translations', function (JoinClause $join) {
            $join->on('branche_translations.branche_id', '=', 'branches.id');
        })->where('branche_translations.locale', 'ar')->pluck('branche_translations.name', 'branches.id');

        return view($this->viewsPath.'edit', ['form' => $offer, 'services' => $services ,'branches' => $branches,'Listbranches' =>$Listbranches , 'offerBranchesIds' =>$offerBranchesIds]);
    }


    public function update(Offer $offer, OfferUpdateRequest $request) {

        $offer->fill($request->request->all());

        if ($request->hasFile('image') ) {
            $offer->image = $this->uploaderService->upload($request->file("image"), "offers");
        }

        if ($request->hasFile('slider_image') ) {
            $offer->slider_image = $this->uploaderService->upload($request->file("slider_image"), "offers");
        }

        $offer->branches()->sync($request->get('branche'));
        

        $offer->save();

        return redirect()->route('admin.offers.index')->with(['success' => 'Updated Successfully']);
    }

    public function enable(Offer $offer, Request $request) {
        $offer->status = Statuses::ACTIVE;
        $offer->save();

        return redirect()->route('admin.offers.index')->with(['success' => 'Updated Successfully']);
    }

    public function disable(Offer $offer, Request $request) {
        $offer->status = Statuses::DISABLED;
        $offer->save();

        return redirect()->route('admin.offers.index')->with(['success' => 'Updated Successfully']);
    }

    public function GetPagesFromLp()
    {
        $curl = curl_init();
        curl_setopt_array($curl, array(
        CURLOPT_URL => 'https://ram.medical-clinics.net/api/send-all-pages',
        CURLOPT_RETURNTRANSFER => true,
        CURLOPT_ENCODING => '',
        CURLOPT_MAXREDIRS => 10,
        CURLOPT_TIMEOUT => 0,
        CURLOPT_FOLLOWLOCATION => true,
        CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
        CURLOPT_CUSTOMREQUEST => 'GET',
        CURLOPT_HTTPHEADER => array(
            'Cookie: XSRF-TOKEN=eyJpdiI6Ik1JQWpOSFE0NnZJbllkUmY3dmMrNEE9PSIsInZhbHVlIjoiQ3RkMDRMeXMzZWo1OGdES1BrZGgvQzlGWkhQenlIVHV1bmg0MUc4SG1QbkptQ1hGRlhzWDZibmJDMWNLMjdYMzBicXBmTERzd0lIa3Y3dXZ6aE9NNUxWazhMSGJmR0R2ellzZ0JIL3BJUkN6Q1Vha1FNRkhFMlExSGt2eGV1a2ciLCJtYWMiOiI2ZTRiZDU4YzFkZjEzMGQ0NWJjOGZkM2JmOWU4YmMyNGJiMGIxNmFlYzQ2ZjRiYTFkMDdkZjU1YzU2MjUwNTU0In0%3D; laravel_session=eyJpdiI6ImJrN3Mva21sT1FiRkZxaUhLQUdhaHc9PSIsInZhbHVlIjoiNENIMFBBL29WUkQ3TWkzOEF1V0hORW9LWE9VVTlsSXYwSFJvdE1BbVFHbVllV25VWE9uQmUwdDdwd21nNGw5ZFRvdVZaK3IwWDVlcFN1ZVE0RjlDN3hsQTFVdnJ1MHU5dUh2QkhpY0JKZ1d1NHR0c05LRzB2TFhJbU5zWDl3cGwiLCJtYWMiOiI4YWQ5ZDE3OWY1MGE3YmZjNDFjNzdkZTJjZWY3NjE0NDI5YzAxMTdmOGFkZDEzYWQwMDdjZTJmMTdkYmZiNjJiIn0%3D'
        ),
        ));

        $response = curl_exec($curl);
        $result = json_decode($response,true);
        curl_close($curl);
        
        return $result;
    }
}

