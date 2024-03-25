@extends('layouts.layout')

@section('content')
<div class="container">
    <div class="row justify-content-center my-3">
        <div class="col-8">
            <div class="card color_card py-3">
                
                <img class="card-img-top w-75 align-self-center" src="{{ $apartment->cover_img !== 'null' ? asset('/storage/' . $apartment->cover_img) : '/storage/img/imgnull.jpg' }}" alt="{{ $apartment->title }}">
                <div class="card-body">
                    <h2 class="card-title">{{ $apartment->title }}</h2>
                    <h5 class="text-secondary">{{ $apartment->address }}</h5>
                    <p class="card-text">
                        {{ $apartment->rooms }} {{ $apartment->rooms == 1 ? ' Camera' : ' Camere' }}
                        
                        - {{ $apartment->bathrooms }} {{ $apartment->rooms == 1 ? ' Bagno' : ' Bagni' }}
                        
                        - {{ $apartment->beds }} {{ $apartment->beds == 1 ? ' Letto' : ' Letti' }}
                        
                        - {{ $apartment->square_meters }} Mq
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
