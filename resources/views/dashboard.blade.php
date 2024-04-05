@extends('layouts.layout')

@section('content')
    <div class="container">
        <h2 class="fs-4 my-4">
            {{ __('La tua Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header bg-pink text-white fw-semibold">{{ __('Dashboard Utente') }}</div>

                    <div class="card-body">
                        <p class="pb-2">Ora sei dentro!<br>
                        Qui puoi visualizzare una sintesi di ciò che troverai nella tua area personale.</p>
                    
                        <div class="alert bg-body-secondary" role="alert">
                            <a href="{{ route('user.apartment.index') }}"
                                class="nav-link text-dark {{ Route::currentRouteName() == 'user.apartment.index' ? 'bg-secondary' : '' }}">
                                I tuoi Appartamenti
                            </a>
                        </div>
                        @if (count(Auth::user()->apartments) > 0)
                            <div class="alert bg-body-secondary" role="alert">
                                <a href="{{ route('user.sponsor.index') }}"
                                    class="nav-link text-dark {{ Route::currentRouteName() == 'user.sponsor.index' ? 'bg-secondary' : '' }}">
                                    Le Sponsorizzazioni
                                </a>
                            </div>
                            <div class="alert bg-body-secondary" role="alert">
                                <a href="{{ route('user.message.index') }}"
                                    class="nav-link text-dark {{ Route::currentRouteName() == 'user.message.index' ? 'bg-secondary' : '' }}">
                                    I tuoi Messaggi
                                </a>
                            </div>
                         @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
