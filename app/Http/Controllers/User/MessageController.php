<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\User;
use App\Models\Apartment;
use App\Models\Message;
use Illuminate\Support\Facades\DB;
class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Apartment $apartment, User $user)
    {
        $user = Auth::user();

        $messages = DB::table('messages')
        ->join('apartments', 'apartments.id', '=', 'messages.apartment_id')
        ->join('users', 'users.id', '=', 'apartments.user_id')
        ->select('messages.*', 'apartments.title', 'apartments.slug')
        ->where('users.id', '=', $user->id)
        ->get();

        $apartments = Apartment::where('user_id', auth()->user()->id)->get();

        if(count($apartments) > 0){
            return view('user.message.index', compact('messages', 'apartments'));
        }
        else{
            return view('errors.not_authorized');
        } 
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Message $message, Apartment $apartment)
    {
        $viewed_message = Message::find($message->id);
        $viewed_message->viewed = true;
        $viewed_message->save();

        return view('user.message.show', compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Message $message)
    {
        $message->delete();

        return redirect()->route('user.message.index');
    }
}
