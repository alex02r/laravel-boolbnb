@extends('layouts.layout')

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-12 d-flex flex-column m-2">
                <h3 class="fw-bold">
                    Messaggi ricevuti
                </h3>
            </div>
            <div class="col-12 mt-3">
                <table class="table table-striped">
                    <thead class="table-dark">
                        <tr>
                            <th>Data di arrivo</th>
                            <th>Email</th>
                            <th class="d-none d-md-table-cell">Per appartamento</th>
                            <th class="d-none d-lg-table-cell">Messaggio</th>
                            <th class="text-center">Visualizzato</th>
                            <th>Strumenti</th>
                        </tr>
                    </thead>
                    <tbody>
                            @forelse ($messages as $message)
                                <tr>
                                    <td>{{ $message->created_at }}</td>
                                    <td>{{ $message->user_mail }}</td>
                                    <td class="d-none d-md-table-cell"><a href="{{ route('user.apartment.show', ['apartment' => $message->apartment_id]) }}">{{ $message->title }}</a></td>
                                    <td class="d-none d-lg-table-cell">{{ Str::limit($message->message, 15, '...') }}</td>
                                    <td class="text-center">
                                        <i class="{{ $message->viewed ? 'fas fa-check text-success' : 'fas fa-x text-danger' }}"></i>
                                    </td>
                                    <td>
                                        <div class="d-flex flex-column d-md-flex flex-md-row gap-2">
                                            <a href="{{ route('user.message.show', ['message' => $message->id]) }}"
                                                class="btn btn-sm btn-primary"><i class="fas fa-eye"></i></a>
                                            {{-- MODALE DELETE --}}
                                            <button class="btn_delete btn btn-sm btn-danger" data-bs-toggle="modal"
                                                data-bs-target="#modal_message_delete-{{ $message->id }}">
                                                <i class="fa-solid fa-trash"></i>
                                            </button>
                                        </div>
                                    </td>
                                </tr>
                                {{-- POP-UP MODALE --}}
                                @include('user.message.modal_delete')
                            @empty
                                <tr>
                                    <td colspan="5" scope="row">Nessun messaggio trovato</td>
                                </tr>
                            @endforelse
                        
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
