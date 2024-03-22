@extends('layouts.layout')

@section('content')
    <div class="card bg-warning-subtle border border-warning border border-5 rounded-4 my-4" style="width: 80vw;">


        <h1 class="card-title m-2">{{ $apartment['title'] }}</h5>
            <ul class="list-group list-group-flush">
                <li class="list-group-item bg-warning-subtle border border-2 border-warning">
                    <h3>INDIRIZZO: {{ $apartment['address'] }}</h3>
                </li>
                <li class="list-group-item bg-warning-subtle border border-2 border-warning">
                    <h3>NUMERO STANZE: {{ $apartment['rooms'] }}</h3>
                </li>
                <li class="list-group-item bg-warning-subtle border border-2 border-warning">
                    <h3>NUMERO BAGNI: {{ $apartment['bathrooms'] }}</h3>
                </li>
                <li class="list-group-item bg-warning-subtle border border-2 border-warning">
                    <h3>NUMERO LETTI: {{ $apartment['beds'] }}</h3>
                </li>
                <li class="list-group-item bg-warning-subtle border border-2 border-warning">
                    <h3>LATITUDINE: {{ $apartment['lat'] }}</h3>
                </li>
                <li class="list-group-item bg-warning-subtle border border-2 border-warning">
                    <h3>LONGITUDINE: {{ $apartment['lon'] }}</h3>
                </li>
                <li class="list-group-item bg-warning-subtle border border-2 border-warning">
                    <h3>IMMAGINE: {{ $apartment['cover_img'] }}</h3>
                </li>
            </ul>
    </div>
@endsection
