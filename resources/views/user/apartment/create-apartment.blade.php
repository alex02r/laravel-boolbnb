@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                @if ($errors->any())
                        <div class="alert alert-danger">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                <form action="{{ route('user.apartment.store') }}" method="post">
                    @csrf
                    {{-- inserimento del titolo --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Inserisci il titolo:</label>
                        <input type="text" class="form-control" name="title" id="title" required>
                    </div>
                    
                    {{-- inserimento dell'indirizzo --}}
                    <input type="text" class="d-none" name="address" id="address" required> {{-- campo nascosto --}}
                    <input type="text" class="d-none" name="lat" id="lat"> {{-- campo nascosto --}}
                    <input type="text" class="d-none" name="lon" id="lon"> {{-- campo nascosto --}}

                    <label for="search">Inserisci l'indirizzo:</label>
                    <div id="search">

                    </div>
                    {{-- inserimento square_meters,rooms, bathrooms, beds --}}
                    <div class="d-flex gap-3 my-3">
                        {{-- square meters --}}
                        <div class="">
                            <label for="square_meters" class="form-label">Metri quadrati</label>
                            <input type="number" min="10" class="form-control form-control-sm" name="square_meters" id="square_meters" required>                            
                        </div>
                        {{-- rooms --}}
                        <div class="">
                            <label for="rooms" class="form-label">Stanze</label>
                            <input type="number" min="0" max="255" class="form-control form-control-sm" name="rooms" id="rooms" required>                            
                        </div>
                        {{-- bathrooms --}}
                        <div class="">
                            <label for="bathrooms" class="form-label">Bagni</label>
                            <input type="number" min="0" max="255" class="form-control form-control-sm" name="bathrooms" id="bathrooms" required>                            
                        </div>
                        {{-- beds --}}
                        <div class="">
                            <label for="beds" class="form-label">Letti</label>
                            <input type="number" min="0" max="255" class="form-control form-control-sm" name="beds" id="beds" required>                            
                        </div>
                    </div>
                    {{-- seleziona visibilità --}}
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" value="" id="checkVisibility" name="checkVisibility">
                        <label class="form-check-label" for="checkVisibility">
                          Visibile
                        </label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-success" id="btnAdd">Aggiungi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection