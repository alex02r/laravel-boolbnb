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
                                <th>status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apartments as $apartment)    
                            <tr>
                                <th>Prova 1 {{ $apartment }}</th>
                                <th>21/01/2023 23:10:26</th>
                                <th>22/01/2023 23:10:26</th>
                                <th>finito</th>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            @endforeach
        </div>
    </div>
@endsection