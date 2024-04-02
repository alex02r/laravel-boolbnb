<?php

namespace App\Http\Controllers\User;

use App\Http\Requests\StoreSponsorApartmentRequest;
use App\Models\Sponsor;
use App\Http\Requests\StoreSponsorRequest;
use App\Http\Requests\UpdateSponsorRequest;
use App\Http\Controllers\Controller;
use App\Models\Apartment;

class SponsorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sponsors = Sponsor::all();
        $apartments = Apartment::where('user_id', auth()->user()->id)->get();
        if (count($apartments) > 0) {
            
            return view('user.sponsor.index-sponsor', compact('sponsors','apartments'));
        }else {
            return view('errors.not_authorized');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\StoreSponsorRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreSponsorRequest $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function show(Sponsor $sponsor)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function edit(Sponsor $sponsor)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateSponsorRequest  $request
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateSponsorRequest $request, Sponsor $sponsor)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Sponsor  $sponsor
     * @return \Illuminate\Http\Response
     */
    public function destroy(Sponsor $sponsor)
    {
        //
    }

    // FUNZIONE PER CREARE UNO SPONSOR
    public function createSponsor(Apartment $apartment, Sponsor $sponsor){

        if ($apartment->user_id == auth()->user()->id) {
            return view('user.sponsor.sponsor-apartment', compact('apartment', 'sponsor'));
        }else {
            return view('errors.not_authorized');
        }
    }

    // FUNZIONE PER IL PAGAMENTO
    public function payment(StoreSponsorApartmentRequest $request, Apartment $apartment, Sponsor $sponsor){

        $form_data = $request->all();
    
        if ($apartment->user_id == auth()->user()->id) {

            //controlliamo se esistono sponsorizzazioni
            if (!empty($apartment->sponsors)) {
                //cicliamo tutte le sponsorizzazioni
                foreach ($apartment->sponsors as $item) {
                    //controlliamo se la sponsor esistente è uguale a quella che stiamo creando
                    // e che la data di fine ancora deve terminare
                    $start_date = $form_data['start_date'].' '.$form_data['start_time'].':00';
                    if ( $start_date < $item->pivot->end_date ) {
                        $error_message = 'É già presente una sponsorizzazione che finisce in data: '.$item->pivot->end_date.' per l\'appartamento '.$apartment->title;
                        return redirect()->route('user.createSponsor', compact('apartment', 'sponsor'))->with('error_message', $error_message);
                        
                    }
                }
            }
            //se siamo qui la sponsorizzazione pruò essere creata

            //recuperiamo la data di inizio
            $start_date = $form_data['start_date'].' '.$form_data['start_time'].':00';
            //recuperiamo le ore dello sponsor
            $hours = '+'.$sponsor->duration.'hours';
            //imopostiamo la data di fine con le ore dello sponsor
            $end_date = date('Y-m-d H:i:s',strtotime($hours,strtotime($start_date)));
            //creiamo la relazione 
            $apartment->sponsors()->attach($sponsor, ['start_date' => $start_date, 'end_date' => $end_date]);
        }else {
            return view('errors.not_authorized');
        }
 
        return redirect()->route('user.sponsor.index');
    }
}
