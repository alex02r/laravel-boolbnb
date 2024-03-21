@extends('layouts.app')

@section('content')
    <div class="container">
        <h2 class="fs-4 text-secondary my-4">
            {{ __('Dashboard') }}
        </h2>
        <div class="row justify-content-center">
            <div class="col">
                <div class="card">
                    <div class="card-header">{{ __('User Dashboard') }}</div>

                    <div class="card-body">

                        <div class="alert bg-body-secondary" role="alert">
                            <a href="{{-- {{ route('admin.apartments.index') }} --}}" class="nav-link text-dark {{-- {{ Route::currentRouteName() == 'admin.apartments.index' ? 'bg-secondary' : '' }} --}}">
                                <i class="fa-solid fa-newspaper fa-lg fa-fw"></i>
                                APARTMENTS
                            </a>
                        </div>


                        {{ __('You are logged in!') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
