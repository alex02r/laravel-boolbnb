@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row p-2">
                <h2 class="mb-3">Sponsorizzaione: {{ $apartment->title }}</h2>
            <div class="card color_card px-3">
                <div class="col-12 col-md-8">
                    @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                    
                    <form action="{{ route('user.payment', ['apartment' => $apartment]) }}" method="post" id="payment-form" class="my-3">
                        @csrf
                        <div class="row">
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label for="start_date" class="form-label">Seleziona la data d'inizio</label>
                                    <input type="date" class="form-control" min="{{ date("Y-m-d") }}" name="start_date" id="start_date" value="{{ old('start_date') ?? date("Y-m-d") }}" required>
                                </div>
                            </div>
                            <div class="col-12 col-md-4">
                                <div class="mb-3">
                                    <label for="end_date" class="form-label">Inserisci l'orario d'inizio</label>
                                    <input type="time" class="form-control" name="start_time" id="start_time" value="{{ old('start_time')}}" required>
                                </div>
                            </div>
                            <div class="col-12">
                                <h5>Sponsorizzazione : </h5>
                                <select name="sponsor" id="sponsor" onchange="updateSponsorInfo()" class="form-select w-50">Sponsorizzazione: 
                                    @foreach ($sponsors as $sponsor)
                                        <option value="{{ $sponsor }}"> {{ $sponsor->title}} </option>
                                    @endforeach
                                </select>
                                <h5 id="sponsor-duration"></h5>
                                <h5 id="sponsor-price"></h5>
                            </div>
                            <div class="col-12 col-md-8">

                                <div id="dropin-container"></div>
                                <input id="nonce" name="payment_method_nonce" type="hidden" />
                                <input type="hidden" name="token" id="token" value="{{ $token }}" />
                                <input type="submit" class="btn btn-success" value="Paga"/>
                            {{--  <button type="submit" class="btn btn-success">
                                    Sponsorizza
                                </button> --}}
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 mt-4">
                <h2 class="mb-3"> Sponsorizzaioni già presenti:</h2>
                @if (count($apartment->sponsors) > 0)
                    <table class="table table-striped">
                        <thead class="table-dark">
                            <tr>
                                <th>Sponsor</th>
                                <th>Data inizio</th>
                                <th>Data fine</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apartment->sponsors as $item)
                                @if ( date("Y-m-d H:i:s") < $item->pivot->end_date)
                                    <tr>
                                        <th>{{ $item->title }}</th>
                                        <th>{{ $item->pivot->start_date }}</th>
                                        <th>{{ $item->pivot->end_date }}</th>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>Nessuna</h4>   
                @endif
            </div>
        </div>
    </div>
    {{-- PayPal Braintree --}}
    <script src="https://js.braintreegateway.com/web/dropin/1.42.0/js/dropin.min.js"></script>
    <script>
        //sript che mi visualizza le info della sponsorizzazione selezionata
        function updateSponsorInfo(){
            let selectSponsor = document.getElementById('sponsor');
            let duration = document.getElementById('sponsor-duration');
            let price = document.getElementById('sponsor-price');
    
            let sponsor = JSON.parse(selectSponsor.value);
            duration.innerHTML = 'Durata: '+sponsor.duration+'h'; 
            price.innerHTML = 'Prezzo: '+sponsor.price+'€'; 
        }
        updateSponsorInfo();
        //braintree 
        const form = document.getElementById('payment-form');
        const client_token = document.getElementById('token').value;

        braintree.dropin.create({
            authorization: client_token,
            container: '#dropin-container'
        }, (error, dropinInstance) => {
            if (error) console.error(error);

            form.addEventListener('submit', event => {
                event.preventDefault();

                dropinInstance.requestPaymentMethod((error, payload) => {
                if (error) console.error(error);

                // Step four: when the user is ready to complete their
                //   transaction, use the dropinInstance to get a payment
                //   method nonce for the user's selected payment method, then add
                //   it a the hidden field before submitting the complete form to
                //   a server-side integration
                document.querySelector('#nonce').value = payload.nonce;
                form.submit();
                });
            });
        });
    </script>
@endsection