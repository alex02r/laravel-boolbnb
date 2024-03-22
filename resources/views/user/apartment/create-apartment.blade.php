@extends('layouts.layout')
@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-8">
                <form action="" method="post">
                    @csrf
                    {{-- inserimento del titolo --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Inserisci il titolo:</label>
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    
                    {{-- inserimento dell'indirizzo --}}
                    <div class="mb-3">
                        <label for="address" class="form-label">Inserisci il indirizzo:</label>
                        <input type="text" class="form-control" name="address" id="address">
                    </div>
                </form>
            </div>
        </div>
    </div>
    
@endsection