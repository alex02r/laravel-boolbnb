@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row row-gap-4 justify-content-center">
            <div class="col-12">
                <h2>Sezione sponsor</h2>
                <p>Qui puoi visualizzare le sponsorizzazioni del/dei tuo/tuoi appartamento/i. La sponsorizzazione ti permetterà di comparire direttamente nella home page di <a class="link-body-emphasis fw-bold text-decoration-none" href="http://localhost:5174/">BoolnBnB</a> e di essere sempre tra i primi risultati nella ricerca di un appartamento situato nella tua zona!</p>
            </div>
            @foreach ($sponsors as $sponsor)
                <div class="col-12 col-md-6 col-lg-3">
                    <div class="card">
                        <h5 class="card-header bg-pink text-center text-white"> <i class="fas fa-crown"></i> {{ $sponsor->title }} <i class="fas fa-crown"></i></h5>
                        <div class="card-body text-center">
                            <h5 class="card-title"> Prezzo : <span class="text-warning fw-bold">{{ $sponsor->price }}€</span></h5>
                            <h5 class="card-title"> Durata : {{ $sponsor->duration }}h</h5>
                            {{-- <ul class="list-unstyled ">
                                @foreach ($apartments as $apartment)
                                <li>
                                    <a href="{{ route('user.createSponsor', ['apartment' => $apartment, 'sponsor' => $sponsor]) }}" class="link-dark link-underline-opacity-0 link-underline-opacity-100-hover">{{ $apartment->title }}</a>
                                </li>
                                @endforeach
                            </ul> --}}
                        </div>
                    </div>
                </div>
            @endforeach
            <div class="col-12">
                <h4>Seleziona un <a href="{{ route('user.apartment.index') }}" class="link-dark link-underline-opacity-50 link-underline-opacity-100-hover">appartmento</a> da sponsorizzare</h4>
            </div>
            @if (session('message'))
                <div class="alert alert-success">
                    {{ session('message') }}
                </div>
            @endif
            <table class="table table-striped mt-4">
                <thead class="table-dark">
                    <tr>
                        <th>Nome appartamento</th>
                        <th>Sponsor</th>
                        <th class="d-none d-lg-table-cell">Data inizio</th>
                        <th class="d-none d-lg-table-cell">Data fine</th>
                        <th>Stato</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($apartments as $apartment)
                        @foreach ($apartment->sponsors as $item)
                        <tr>
                            <td>{{ $apartment->title }}</td>
                            <td class="fw-bold">{{ $item->title }}</td>
                            <td class="d-none d-lg-table-cell">{{ \Carbon\Carbon::parse($item->pivot->start_date)->format('d/m/Y H:i') }}</td>
                            <td class="d-none d-lg-table-cell">{{ \Carbon\Carbon::parse($item->pivot->end_date)->format('d/m/Y H:i') }}</td>
                            <td>
                                @if (\Carbon\Carbon::now()->setTimezone('Europe/Rome') >= $item->pivot->start_date && \Carbon\Carbon::now()->setTimezone('Europe/Rome') <= $item->pivot->end_date)
                                    <span class="text-success fw-bold">In corso</span>
                                @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') > $item->pivot->end_date)
                                    <span class="text-danger fw-bold">Finita</span>
                                @elseif (\Carbon\Carbon::now()->setTimezone('Europe/Rome') < $item->pivot->start_date)
                                    <span class="text-warning fw-bold">Da iniziare</span>
                                @endif
                            </td>
                        </tr>
                        @endforeach
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection