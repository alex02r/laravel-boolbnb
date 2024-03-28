@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h2>Sezione sponsor</h2>
                <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Aut harum, itaque exercitationem obcaecati cupiditate voluptatem doloribus dolorum recusandae mollitia dolorem nesciunt repellendus blanditiis necessitatibus sequi quis perspiciatis nobis est vitae!</p>
            </div>
            @foreach ($sponsors as $sponsor)
                <div class="col-12">
                    <h2>Sponsorizzazione {{ $sponsor->title }}</h2>
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Nome appartamneto</th>
                                <th>Datta inizio</th>
                                <th>Data fine</th>
                                <th>stato</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apartments as $apartment)
                                @foreach ($apartment->sponsors as $item)

                                @if ($sponsor->id == $item->id)
                                    <tr>
                                        <th>{{ $apartment->title }}</th>
                                        <th>{{ $item->pivot->start_date }}</th>
                                        <th>{{ $item->pivot->ending_date }}</th>
                                        <th>finito</th>
                                    </tr>
                                @endif
                                @endforeach
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
@endsection