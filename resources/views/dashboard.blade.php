@extends('layouts.layout')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('La tua Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('Dashboard Utente') }}</div>

                    <div class="card-body">
                        <p class="pb-2">Ora sei dentro!<br>
                        Qui puoi visualizzare una sintesi di ciò che troverai nella tua area personale.</p>
                    
                        <div class="alert bg-body-secondary" role="alert">
                            <a href="{{ route('user.apartment.index') }}"
                                class="nav-link text-dark {{ Route::currentRouteName() == 'user.apartment.index' ? 'bg-secondary' : '' }}">
                                APPARTAMENTI
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
