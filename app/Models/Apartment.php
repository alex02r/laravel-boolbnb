<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Apartment extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'title', 
        'rooms', 
        'bathrooms', 
        'beds', 
        'square_meters',
        'address',
        'lat',
        'lon',
        'cover_img',
        'show',
    ];

    // RELAZIIONE CON TABELLA USER
    public function user(){
        return  $this->belongsTo(User::class);
    }

    // RELAZIONE CON TABELLA MESSAGES
    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    // RELAZIONE CON TABELLA SERVICES
    public function services(){
        return $this->belongsToMany(Service::class);

    }

    // RELAZIONE CON TABELLA VIEWS
    public function views()
    {
        return $this->hasMany(View::class);
    }

    // RELAZIONE CON TABELLA SPONSORS
    public function sponsors(){
        return $this->belongsToMany(Sponsor::class)->withPivot('start_date', 'end_date');;
    }
}
