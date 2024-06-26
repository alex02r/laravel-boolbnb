@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                <h3 class="text-uppercase">
                    LISTA APPARTAMENTI
                </h3>
                <div class="d-flex pb-4">
                    <h5 class="title-pink fw-bold">Aggiungi appartamento</h5>
                    <a href="{{ route('user.apartment.create') }}" class="btn btn-sm btn-form-message mx-2"><i
                            class="fas fa-plus"></i></a>
                </div>
            </div>
            <div class="col-12 ">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Titolo</th>
                            <th class="d-none d-lg-table-cell">Indirizzo</th>
                            <th class="d-none d-lg-table-cell">Stanze</th>
                            <th class="d-none d-lg-table-cell">Bagni</th>
                            <th class="d-none d-lg-table-cell">Letti</th>
                            <th class="d-none d-lg-table-cell">Mq</th>
                            <th class="text-center d-none d-md-table-cell">Visibilità</th>
                            <th>Sponsor</th>
                            <th>Strumenti</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($apartments as $apartment)
                            <tr>
                                <td>{{ $apartment->title }}</td>
                                <td class="d-none d-lg-table-cell">{{ $apartment->address }}</td>
                                <td class="d-none d-lg-table-cell">{{ $apartment->rooms }}</td>
                                <td class="d-none d-lg-table-cell">{{ $apartment->bathrooms }}</td>
                                <td class="d-none d-lg-table-cell">{{ $apartment->beds }}</td>
                                <td class="d-none d-lg-table-cell">{{ $apartment->square_meters }}</td>
                                <td class="text-center d-none d-md-table-cell">
                                    <i
                                        class="{{ $apartment->show ? 'fas fa-check text-success' : 'fas fa-x text-danger' }}"></i>
                                </td>
                                <td>
                                    {{-- se l'apartment non ha sponsor visualizziamo il link per la sponsorizzazione --}}
                                    <a href="{{ route('user.createSponsor', ['apartment' => $apartment]) }}">Sponsorizza</a>
                                </td>
                                <td>
                                    <div class="d-flex flex-column d-md-flex flex-md-row gap-2">
                                        <a href="{{ route('user.apartment.show', ['apartment' => $apartment->id]) }}"
                                            class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>

                                        <a href="{{ route('user.apartment.edit', ['apartment' => $apartment->id]) }}"
                                            class="btn btn-sm btn-warning"><i class="fa-solid fa-pencil"></i></a>
                                        {{-- MODALE DELETE --}}
                                        <button class="btn_delete btn btn-sm btn-danger" data-bs-toggle="modal"
                                            data-bs-target="#modal_apartment_delete-{{ $apartment->id }}">
                                            <i class="fa-solid fa-trash"></i>
                                        </button>
                                    </div>
                                </td>
                            </tr>
                            {{-- POP-UP MODALE --}}
                            @include('user.apartment.modal_delete')
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
