@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-8">
                <div class="card color_card py-3">
                    <div class="card-body">
                        <h2 class="card-title mb-3">Messaggio da {{ $message->user_mail }}</h2>
                         <h5>Per appartamento: <a href="{{ route('user.apartment.show', ['apartment' => $apartment]) }}"> {{ $apartment->title }}</a> </h5>
                        <p> <strong>Contenuto del messaggio:</strong> <span class="text-secondary">{{ $message->message }}</span></p>
                        <p> <strong>Messaggio inviato il:</strong> <span class="text-secondary">{{ $message->created_at }}</span></p>
                        {{-- MODALE DELETE --}}
                        <button class="btn_delete btn btn-sm btn-danger" data-bs-toggle="modal"
                            data-bs-target="#modal_message_delete-{{ $message->id }}">
                            <i class="fa-solid fa-trash"></i> Cancella messaggio
                        </button>
                    </div>
                </div>
                <div class="col-10 text-center mt-5">
                    <a href="/user/message" > <button class="btn btn-secondary">Torna indietro</button></a>
                </div>
            </div>
        </div>
    </div>
    {{-- POP-UP MODALE --}}
    @include('user.message.modal_delete')
@endsection