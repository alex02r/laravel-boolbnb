@extends('layouts.app')
@section('content')

<div class="jumbotron p-3 bg-light rounded-3">
    <div class="container py-5">
        <div class="logo_laravel text-danger fs-1 fw-bold">
            BoolBnB
        </div>
        <h1 class="display-5 mb-5">
            Benvenuto/a nella tua personale Dashboard di BoolBnB
        </h1>
        <div class="row justify-content-center">
            <div class="col-md-6">
                <div class="card">
                    <h5 class="card-header bg-dark text-center text-white"> <i class="fas fa-user"></i> Sei un utente registrato?</h5>
                    <div class="card-body text-center">
                        <p class="card-text">Effettua il login.</p>
                        <button class="btn btn-primary"><a class="text-decoration-none text-white" href="http://127.0.0.1:8000/login">Accedi</a></button>
                    </div>
                    <div class="card-footer fst-italic text-center">
                        OPPURE
                    </div>
                    <div class="card-body text-center">
                        <p class="card-text">Puoi registrarti ed entrare a far parte della nostra piattaforma!</p>
                        <button class="btn btn-primary"><a class="text-decoration-none text-white" href="http://127.0.0.1:8000/register">Registrati</a></button>
                    </div>
                </div>
            </div>
            <div class="col-12 text-center display-7 mt-5">
                <p>Vuoi tornare alla Homepage del nostro sito? <a class="link-info" href="http://localhost:5174">Clicca qui.</a></p>
            </div>
        </div>
    </div>
</div>
@endsection