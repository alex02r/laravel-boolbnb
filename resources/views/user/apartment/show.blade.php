@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-md-8">
                <div class="card color_card">
                    <img class="card-img-top align-self-center"
                        src="{{ $apartment->cover_img != null ? asset('/storage/' . $apartment->cover_img) : asset('/img/image.png') }}"
                        alt="{{ $apartment->title }}">
                    <div class="card-body">
                        <h2 class="card-title">{{ $apartment->title }}</h2>
                        <h5 class="text-secondary">{{ $apartment->address }}</h5>
                        <p class="card-text pt-2">
                            <i class="fa-solid fa-house title-pink"></i> {{ $apartment->rooms }} {{ $apartment->rooms == 1 ? ' Camera' : ' Camere' }}
                            - <i class="fa-solid fa-toilet title-pink"></i> {{ $apartment->bathrooms }} {{ $apartment->bathrooms == 1 ? ' Bagno' : ' Bagni' }}

                            - <i class="fa-solid fa-bed title-pink"></i> {{ $apartment->beds }} {{ $apartment->beds == 1 ? ' Letto' : ' Letti' }}

                            - <i class="fa-solid fa-house-circle-check title-pink"></i> {{ $apartment->square_meters }} Mq
                        </p>
                        <div>
                            <p class="fw-bold m-0">Servizi disponibili</p>
                            @forelse ($apartment->services as $service)
                                <span class="badge bg-pink my-2 service-texts">{{ $service->name }} </span>
                            @empty
                                <p>Nessun servizio</p>
                            @endforelse
                        </div>

                        <div>
                            <p class="fw-bold m-0">Sponsorizzazioni attive</p>
                            @forelse ($apartment->sponsors as $sponsor)
                                <ul class="list-unstyled">
                                    <li>Nome: {{ $sponsor->title }}</li>
                                    <li>Inizio: {{ $sponsor->pivot->start_date }}</li>
                                    <li>Fine: {{ $sponsor->pivot->end_date }}</li>
                                </ul>
                                <span> </span>
                            @empty
                                <p>Nessuna sponsorizzazione</p>
                            @endforelse
                        </div>

                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Statistiche numero di visualizzazioni e messaggi ricevuti</h5>
                                @if ($visitCount > 0 || $messCount > 0)
                                    <canvas id="myChart"></canvas>    
                                @else
                                    <p>Nessun dato disponibile per poter visualizzare il grafico.</p>
                                @endif
                            </div>
                        </div>

                        <div class="mt-5">
                            <a href="{{ route('user.apartment.edit', ['apartment' => $apartment->id]) }}"
                                class="btn btn-sm btn-warning text-white fw-bold"><i class="fa-solid fa-edit"></i> MODIFICA</a>
                            <button class="btn_delete btn btn-sm btn-danger text-white fw-bold" data-bs-toggle="modal"
                                data-bs-target="#modal_apartment_delete-{{ $apartment->id }}"><i class="fa-solid fa-trash"></i> 
                                ELIMINA
                            </button>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-10 text-center my-5">
                    <a href="/user/apartment" > <button class="btn btn-secondary">Torna indietro</button></a>
            </div>
        </div>
    </div>
    @include('user.apartment.modal_delete')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'doughnut',
            data: {
            labels: [ 'Visualizzazioni', 'Messaggi' ],
            datasets: [{
                label: ' Numero totale',
                data: [{{ $visitCount }}, {{ $messCount }}],
                borderColor: ['rgb(241, 91, 93)', 'rgb(54, 162, 235)'],
                backgroundColor: ['rgb(241, 91, 93)', 'rgb(54, 162, 235)'],
                hoverOffset: 4
            }]
            },
        });
    </script>

@endsection
