<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;
use Carbon\Carbon;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $request->validate([
            'name' => ['required', 'string', 'max:50', 'min:2'],
            'surname' => ['required', 'string', 'max:50', 'min:2'],
            'date_of_birth' => ['required', 'date_format:Y-m-d', 'before:' . Carbon::now()->subYears(18)->format('Y-m-d')],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:' . User::class],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ], $errors = [
            'name.required' => 'Il nome è obbligatorio.',
            'name.max' => 'Il nome deve contere al massimo 50 caratteri.',
            'name.min' => 'Il nome deve contere almeno 2 caratteri.',
            'surname.required' => 'Il cognome è obbligatorio.',
            'surname.max' => 'Il cognome deve contere al massimo 50 caratteri.',
            'surname.min' => 'Il cognome deve contere almeno 2 caratteri.',
            'date_of_birth.required' => 'La data di nascita è obbligatoria.',
            'date_of_birth.before' => 'Devi essere maggiorenne per poter accedere al servizio.',
            'email.required' => "L'indirizzo email è obbligatorio.",
            'email.max' => "L'indirizzo email deve contere al massimo 255 caratteri.",
            'email.unique' => "L'indirizzo email inserito è già presente nel database. Prova un indirizzo email diverso.",
            'password.required' => "La password è obbligatoria.",
            'password.min' => "La password deve essere lunga almeno 8 caratteri.",
            'password.confirmed' => "Le password inserite non coincidono. Riprova.",
        ]);

        $user = User::create([
            'name' => $request->name,
            'surname' => $request->surname,
            'date_of_birth' => $request->date_of_birth,
            'email' => $request->email,
            'password' => Hash::make($request->password),
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
