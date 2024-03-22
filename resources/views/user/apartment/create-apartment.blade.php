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
                        <input type="text" class="form-control" name="title" id="title">
                    </div>
                    
                    {{-- inserimento dell'indirizzo --}}
                    <input type="text" class="d-none" name="address" id="address"> {{-- campo nascosto --}}
                    <div id="search">

                    </div>

                    <div class="mb-3">
                        <button type="submit" class="btn btn-success" id="btnAdd">Aggiungi</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection