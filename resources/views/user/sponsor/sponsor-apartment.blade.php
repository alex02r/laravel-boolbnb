@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Sponsorizzaione :</h1>
                <h2>{{ $apartment->title }}</h2>
            </div>
            <div class="col-12 col-md-8">
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                
                
                <form action="{{ route('user.payment', ['apartment' => $apartment, 'sponsor' => $sponsor]) }}" method="post" class="my-5">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Seleziona la data di inizio</label>
                                <input type="date" class="form-control" min="{{ date("Y-m-d") }}" name="start_date" id="start_date" value="{{ old('start_date') }}" required>
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Inserisci l'orario di inizio</label>
                                <input type="time" class="form-control" name="start_time" id="start_time" value="{{ old('start_time') }}" required>
                            </div>
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-success">
                                Sponsorizza
                            </button>
                        </div>
                    </div>
                </form>
            </div>
            <div class="col-12 mt-3">
                <h2> Sponsorizzaioni già presenti:</h2>
                @if (count($apartment->sponsors) > 0)
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>Sponsor</th>
                                <th>Data inizio</th>
                                <th>Data fine</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($apartment->sponsors as $item)
                                @if ( date("Y-m-d H:i:s") < $item->pivot->end_date)
                                    <tr>
                                        <th>{{ $item->title }}</th>
                                        <th>{{ $item->pivot->start_date }}</th>
                                        <th>{{ $item->pivot->end_date }}</th>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                @else
                    <h4>Nessuna</h4>   
                @endif
            </div>
        </div>
    </div>
@endsection