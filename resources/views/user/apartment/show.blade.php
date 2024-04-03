@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-8">
                <div class="card color_card py-3">

                    <img class="card-img-top w-75 align-self-center"
                        src="{{ $apartment->cover_img != null ? asset('/storage/' . $apartment->cover_img) : asset('/img/image.png') }}"
                        alt="{{ $apartment->title }}">
                    <div class="card-body">
                        <h2 class="card-title">{{ $apartment->title }}</h2>
                        <h5 class="text-secondary">{{ $apartment->address }}</h5>
                        <p class="card-text">
                            {{ $apartment->rooms }} {{ $apartment->rooms == 1 ? ' Camera' : ' Camere' }}

                            - {{ $apartment->bathrooms }} {{ $apartment->bathrooms == 1 ? ' Bagno' : ' Bagni' }}

                            - {{ $apartment->beds }} {{ $apartment->beds == 1 ? ' Letto' : ' Letti' }}

                            - {{ $apartment->square_meters }} Mq
                        </p>
                        <div>
                            <p class="fw-bold m-0">SERVIZI DISPONIBILI</p>
                            @forelse ($apartment->services as $service)
                                <span class="badge text-bg-secondary my-2">{{ $service->name }} </span>
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
                                <h3 class="mb-3">Statistiche visite giornaliere</h3>
                                <canvas id="myChart"></canvas>
                            </div>
                        </div>

                        <div class="mt-5">
                            <a href="{{ route('user.apartment.edit', ['apartment' => $apartment->id]) }}"
                                class="btn btn-sm btn-warning text-white fw-bold">MODIFICA</a>
                            <button class="btn_delete btn btn-sm btn-danger text-white fw-bold" data-bs-toggle="modal"
                                data-bs-target="#modal_apartment_delete-{{ $apartment->id }}">
                                ELIMINA
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    @include('user.apartment.modal_delete')

    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <script>
        let visits = @json($visits);
        let dates = Object.keys(visits);
        let visitCounts = Object.values(visits);

        const ctx = document.getElementById('myChart');

        new Chart(ctx, {
            type: 'line',
            data: {
            labels: [ dates ],
            datasets: [{
                label: 'Visualizzazioni giornaliere per questo appartamento',
                data: [{{ count($visitCount) }}],
                borderWidth: 1,
                fill: false,
                borderColor: 'rgb(241, 91, 93)',
                tension: 0.2,
                backgroundColor: 'rgb(241, 91, 93)',
            }]
            },
            options: {
            scales: {
                y: {
                beginAtZero: true
                }
            }
            }
        });
    </script>

@endsection
