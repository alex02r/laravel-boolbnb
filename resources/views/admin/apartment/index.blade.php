@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-column m-2">
                <h2 class="fs-4 text-secondary text-uppercase">
                    LISTA APPARTAMENTI
                </h2>
                <div class="d-flex">
                    <h2 class="fs-4 text-secondary text-uppercase">Aggiungi appartamento</h2>
                    <a href="{{ route('user.apartment.create') }}" class="btn btn-sm btn-secondary mx-2"><i
                            class="fa-solid fa-pencil"></i></a>
                </div>
            </div>
            <div class="col-12 ">
                <table class="table table-striped">
                    <thead>
                        <tr>
                            <th>Titolo</th>
                            <th>Stanze</th>
                            <th>Bagni</th>
                            <th>Letti</th>
                            <th>Mq</th>
                            <th>Latitudine</th>
                            <th>Longitudine</th>
                            <th>Img</th>
                            <th>Tools</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            <tr>
                                <td>{{ $apartment->title }}</td>
                                <td>{{ $apartment->rooms }}</td>
                                <td>{{ $apartment->bathrooms }}</td>
                                <td>{{ $apartment->beds }}</td>
                                <td>{{ $apartment->square_meters }}</td>
                                <td>{{ $apartment->lat }}</td>
                                <td>{{ $apartment->lon }}</td>
                                <td>{{ $apartment->cover_img }}</td>
                                <td>
                                    <div class="d-flex">
                                        <a href="{{ route('user.apartment.show', ['apartment' => $apartment->id]) }}"
                                            class="btn btn-sm btn-primary me-1"><i
                                                class="fa-solid fa-magnifying-glass"></i></a>

                                        <a href="{{ route('user.apartment.edit', ['apartment' => $apartment->id]) }}"
                                            class="btn btn-sm btn-warning me-1"><i class="fa-solid fa-pencil"></i></a>

                                        <button type="button" class="btn_delete btn btn-sm btn-danger">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
