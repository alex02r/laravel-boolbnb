@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-12">
                <h1>Sponsorizzaione :</h1>
                <h2>{{ $apartment->title }}</h2>
            </div>
            <div class="col-12 col-md-8">
                <form action="" method="POST">
                    @csrf
                    <div class="row">
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Seleziona la data di inizio</label>
                                <input type="date" class="form-control" min="{{ date("Y-m-d") }}" name="" id="">
                            </div>
                        </div>
                        <div class="col-12 col-md-4">
                            <div class="mb-3">
                                <label for="exampleFormControlInput1" class="form-label">Inserisci l'orario di inizio</label>
                                <input type="time" class="form-control" name="" id="">
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
        </div>
    </div>
@endsection