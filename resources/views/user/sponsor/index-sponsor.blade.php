@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row row-gap-4">
            <div class="col-12">
                <h2>Sezione sponsor</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut harum, itaque exercitationem obcaecati cupiditate voluptatem doloribus dolorum recusandae mollitia dolorem nesciunt repellendus blanditiis necessitatibus sequi quis perspiciatis nobis est vitae!</p>
            </div>
            @foreach ($sponsors as $sponsor)
                <div class="col-12 col-md-6 col-lg-4">
                    <div class="card">
                        <h5 class="card-header text-center"> <i class="fas fa-crown"></i> {{ $sponsor->title }} <i class="fas fa-crown"></i></h5>
                        <div class="card-body text-center">
                            <h5 class="card-title"> Prezzo : {{ $sponsor->price }}€</h5>
                            <h5 class="card-title"> Durata : {{ $sponsor->duration }}h</h5>
                            <ul class="list-unstyled ">
                                @foreach ($apartments as $apartment)
                                <li>
                                    <a href="{{ route('user.createSponsor', ['apartment' => $apartment, 'sponsor' => $sponsor]) }}" class="">{{ $apartment->title }}</a>
                                </li>
                                @endforeach
                            </ul>
                        </div>
                    </div>
                </div>
                @endforeach
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Nome appartamneto</th>
                            <th>Sponsr</th>
                            <th>Data inizio</th>
                            <th>Data fine</th>
                            <th>stato</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            @foreach ($apartment->sponsors as $item)
                            <tr>
                                <th>{{ $apartment->title }}</th>
                                <th>{{ $item->title }}</th>
                                <th>{{ $item->pivot->start_date }}</th>
                                <th>{{ $item->pivot->end_date }}</th>
                                <th>{{ date("Y-m-d H:i:s") < $item->pivot->end_date ? 'in corso' : 'finita' }}</th>
                            </tr>
                            @endforeach
                        @endforeach
                    </tbody>
                </table>
        </div>
    </div>
@endsection