@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-lg-8">
                <div class="card color_card">
                    {{-- IMMAGINE APPARTAMENTO --}}
                    <img class="card-img-top align-self-center"
                        src="{{ $apartment->cover_img != null ? asset('/storage/' . $apartment->cover_img) : asset('/img/image.png') }}"
                        alt="{{ $apartment->title }}">
                    <div class="card-body">
                        {{-- INFO APPARTMANETO  --}}
                        <h2 class="card-title">{{ $apartment->title }}</h2>
                        <h5 class="text-secondary">{{ $apartment->address }}</h5>
                        <p class="card-text pt-2">
                            <i class="fa-solid fa-house title-pink"></i> {{ $apartment->rooms }} {{ $apartment->rooms == 1 ? ' Camera' : ' Camere' }}
                            - <i class="fa-solid fa-bath title-pink"></i> {{ $apartment->bathrooms }} {{ $apartment->bathrooms == 1 ? ' Bagno' : ' Bagni' }}

                            - <i class="fa-solid fa-bed title-pink"></i> {{ $apartment->beds }} {{ $apartment->beds == 1 ? ' Letto' : ' Letti' }}

                            - <i class="fa-solid fa-house-circle-check title-pink"></i> {{ $apartment->square_meters }} Mq
                        </p>
                        {{-- SERVIZI --}}
                        <div>
                            <p class="fw-bold m-0">Servizi disponibili</p>
                            @forelse ($apartment->services as $service)
                                <span class="badge bg-pink my-2 service-texts">{{ $service->name }} </span>
                            @empty
                                <p>Nessun servizio</p>
                            @endforelse
                        </div>
                        {{-- SPONSORIZZAZIONI --}}
                        <div>
                            <p class="fw-bold m-0">Storico sponsorizzazioni</p>
                            @forelse ($apartment->sponsors as $sponsor)
                                <ul class="list-unstyled">
                                    <li>Nome: {{ $sponsor->title }}</li>
                                    <li>Inizio: {{ \Carbon\Carbon::parse($sponsor->pivot->start_date)->locale('it')->isoFormat('dddd D MMMM Y') }} alle {{ \Carbon\Carbon::parse($sponsor->pivot->start_date)->format('H:i') }}</li>
                                    <li>Fine: {{ \Carbon\Carbon::parse($sponsor->pivot->end_date)->locale('it')->isoFormat('dddd D MMMM Y') }} alle {{ \Carbon\Carbon::parse($sponsor->pivot->end_date)->format('H:i') }}</li>
                                    <li>Stato: 
                                        @if (\Carbon\Carbon::now()->setTimezone('Europe/Rome') >= $sponsor->pivot->start_date && \Carbon\Carbon::now()->setTimezone('Europe/Rome') <= $sponsor->pivot->end_date)
                                        <span class="text-success fw-bold">In corso</span>
                                        @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') > $sponsor->pivot->end_date)
                                            <span class="text-danger fw-bold">Finita</span>
                                        @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') < $sponsor->pivot->start_date)
                                            <span class="text-warning fw-bold">Da iniziare</span>
                                        @endif
                                    </li>
                                </ul>
                            @empty
                                <p>Nessuna sponsorizzazione</p>
                            @endforelse
                        </div>
                        {{-- GRAFICO --}}
                        <div class="card">
                            <div class="card-body">
                                <h5 class="mb-3">Statistiche numero di visualizzazioni e messaggi ricevuti</h5>
                                {{-- SCRIVO LA CONDIZIONE IN UN CICLO FOREACH PER MOSTRARE IL GRAFICO SOLO SE CI SONO PRESENTI DEI DATI --}}
                                @php
                                    $hasData = false;
                                    foreach ($monthlyCounts as $monthlyCount) {
                                        if ($monthlyCount['views'] > 0 || $monthlyCount['messages'] > 0) {
                                            $hasData = true;
                                            break;
                                        }
                                    }
                                @endphp
                                {{-- CONDIZIONE PER MOSTRARE IL GRAFICO --}}
                                @if ($hasData)
                                    <canvas id="myViews"></canvas>
                                    <hr>
                                    <canvas id="myMessages"></canvas>
                                @else
                                    <p>Nessun dato disponibile per poter visualizzare il grafico.</p>
                                @endif
                            </div>
                        </div>
                        {{-- STRUMENTI PER MODIFICA O CANCELLARE L'APPARTAMENTO --}}
                        <div class="mt-5">
                            <a href="{{ route('user.apartment.edit', ['apartment' => $apartment->id]) }}"
                                class="btn btn-sm btn-warning text-white fw-bold m-1"><i class="fa-solid fa-edit"></i> MODIFICA</a>
                            <a href="{{ route('user.createSponsor', ['apartment' => $apartment]) }}" class="btn btn-sm btn-primary fw-bold"><i class="fas fa-hand-holding-dollar"></i> SPONSORIZZA</a>   
                            <button class="btn_delete btn btn-sm btn-danger text-white fw-bold m-1" data-bs-toggle="modal"
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
        const view = document.getElementById('myViews');
        new Chart(view, {
            type: 'line',
            data: {
                labels: [
                    @foreach($monthlyCounts as $monthlyCount)
                        '{{ $monthlyCount['month'] }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'N. Visualizzazioni',
                    data: [
                        @foreach($monthlyCounts as $monthlyCount)
                            {{ $monthlyCount['views'] }},
                        @endforeach
                    ],
                    borderColor: 'rgb(241, 91, 93)',
                    backgroundColor: 'rgb(241, 91, 93)',
                }],
            },
            options: {
                scales: {
                    y: {
                        beginAtZero: true
                    }
                }
            }
        });

        const mess = document.getElementById('myMessages');
        new Chart(mess, {
            type: 'line',
            data: {
                labels: [
                    @foreach($monthlyCounts as $monthlyCount)
                        '{{ $monthlyCount['month'] }}',
                    @endforeach
                ],
                datasets: [{
                    label: 'N. Messaggi',
                    data: [
                        @foreach($monthlyCounts as $monthlyCount)
                            {{ $monthlyCount['messages'] }},
                        @endforeach
                    ],
                    borderColor: 'rgb(54, 162, 235)',
                    backgroundColor: 'rgb(54, 162, 235)',
                }],
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
