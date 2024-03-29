@extends('layouts.layout')

@section('content')
    <div class="container">
        <div class="row justify-content-center my-3">
            <div class="col-8">
                <div class="card color_card py-3">
                    <div class="card-body">
                        @foreach($apartments as $apartment)
                            @foreach ($apartment->messages as $message)
                                <img class="card-img-top w-75 align-self-center"
                                src="{{ $apartment->cover_img != null ? asset('/storage/' . $apartment->cover_img) : asset('/img/image.png') }}"
                                alt="{{ $apartment->title }}">
                                <h2 class="card-title">Messaggio da {{ $message->user_mail }}</h2>
                                <h5 class="text-secondary">{{ $message->message }}</h5>
                                    {{-- <button class="btn_delete btn btn-sm btn-danger text-white fw-bold" data-bs-toggle="modal"
                                        data-bs-target="#modal_apartment_delete-{{ $apartment->id }}">
                                        ELIMINA
                                    </button> --}}
                                </div>
                            @endforeach
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
    {{-- @include('user.apartment.modal_delete') --}}
@endsection