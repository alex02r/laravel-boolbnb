@extends('layouts.layout')

@section('content')
    <div class="card color_card my-3" style="width: 75vw;">

        <div>
            <img class="w-100"
                src="{{ $apartment->cover_img !== 'null' ? asset('/storage/' . $apartment->cover_img) : '/storage/img/imgnull.jpg' }}"
                alt="">
        </div>
        <h1 class="card-title m-2">{{ $apartment['title'] }}</h5>
            <h2 class="p-2">{{ $apartment['address'] }}</h2>
            <h4 class="p-2">
                {{ $apartment['rooms'] }} {{ $apartment['rooms'] == 1 ? ' Camera' : ' Camere' }}
                &nbsp;
                {{ $apartment['bathrooms'] }} {{ $apartment['rooms'] == 1 ? ' Bagno' : ' Bagni' }}
                &nbsp;
                {{ $apartment['beds'] }} {{ $apartment['beds'] == 1 ? ' Letto' : ' Letti' }}
                &nbsp;
                {{ $apartment['square_meters'] }} Mq
            </h4>
    </div>
@endsection
