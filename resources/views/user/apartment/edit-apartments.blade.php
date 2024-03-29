@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-12 d-flex justify-content-center align-items-center">
                <h1 class="fw-bold color-title">Modifica appartamento: {{ $apartment->title }}</h1>
            </div>
            <div class="col-10 mt-5">
                {{-- Condizione per ciclare gli errori da mostrare --}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                {{-- FORM --}}
                <form action="{{ route('user.apartment.update', $apartment->id) }}" method="POST"
                    enctype="multipart/form-data">
                    @csrf
                    @method('PUT')

                    {{-- inserimento del titolo --}}
                    <div class="mb-3">
                        <label for="title" class="form-label">Inserisci il titolo:</label>
                        <input type="text" class="form-control" name="title" id="title"
                            value="{{ old('title') ?? $apartment->title }}" required>
                        @error('title')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- inserimento dell'immagine --}}
                    <div class="mb-3">
                        <label for="cover_img" class="form-label">Inserisci un immagine:</label>
                        <input class="form-control" type="file" accept=".png, .jpg, .jpeg, .gif, .svg" id="cover_img"
                            name="cover_img" value="{{ old('cover_img') ?? $apartment->cover_img }}">
                        @error('cover_img')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    {{-- inserimento dell'indirizzo --}}
                    <div class="d-none">
                        <input type="text" name="address" id="address" required> {{-- campo nascosto --}}
                    </div>

                    <label for="search">Inserisci l'indirizzo:</label>
                    <div id="search" old-value="{{ old('address') ?? $apartment->address }}">
                        @error('address')
                            <div class="text-danger">{{ $message }}</div>
                        @enderror
                        @if (session('error_address'))
                            <div class="alert alert-danger">
                                {{ session('error_address') }}
                            </div>
                        @endif
                    </div>
                    {{-- inserimento square_meters,rooms, bathrooms, beds --}}
                    <div class="d-flex gap-3 my-3">
                        {{-- square meters --}}
                        <div class="">
                            <label for="square_meters" class="form-label">Metri quadrati</label>
                            <input type="number" min="10" class="form-control form-control-sm" name="square_meters"
                                id="square_meters" value="{{ old('square_meters') ?? $apartment->square_meters }}"
                                required>
                            @error('square_meters')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- rooms --}}
                        <div class="">
                            <label for="rooms" class="form-label">Stanze</label>
                            <input type="number" min="0" max="255" class="form-control form-control-sm"
                                name="rooms" id="rooms" value="{{ old('rooms') ?? $apartment->rooms }}" required>
                            @error('rooms')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- bathrooms --}}
                        <div class="">
                            <label for="bathrooms" class="form-label">Bagni</label>
                            <input type="number" min="0" max="255" class="form-control form-control-sm"
                                name="bathrooms" id="bathrooms" value="{{ old('bathrooms') ?? $apartment->bathrooms }}"
                                required>
                            @error('bathrooms')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        {{-- beds --}}
                        <div class="">
                            <label for="beds" class="Clabel">Letti</label>
                            <input type="number" min="0" max="255" class="form-control form-control-sm"
                                name="beds" id="beds" value="{{ old('beds') ?? $apartment->beds }}" required>
                            @error('beds')
                                <div class="text-danger">{{ $message }}</div>
                            @enderror
                        </div>
                    </div>

                    <div>
                        <label class="form-label">Selziona servizi</label>
                        <div>
                            @foreach ($services as $service)
                                <div class="form-check-inline">
                                    <input type="checkbox" name="services[]" id="service-{{ $service->id }}"
                                        class="form-check-input" value="{{ $service->id }}" @checked(is_array(old('services')) && in_array($service->id, old('services')))>
                                    <label for="" class="form-check-label">{{ $service->name }}</label>
                                </div>
                            @endforeach
                        </div>
                    </div>
                    {{-- seleziona visibilità --}}
                    <div class="form-check my-3">
                        <input class="form-check-input" type="checkbox" @checked(old('show') ?? $apartment->show)
                            value="{{ $apartment->show }}" id="show" name="show">
                        <label class="form-check-label" for="show">
                            Visibile
                        </label>
                    </div>
                    <div class="mb-3">
                        <button type="submit" class="btn btn-warning" id="btnAdd">Modifica</button>
                    </div>
                </form>
            </div>
            <div class="col-10 text-center mt-5">
                <a href="/user/apartment"> <button class="btn btn-secondary">Torna indietro</button></a>
            </div>
        </div>
    </div>
@endsection
