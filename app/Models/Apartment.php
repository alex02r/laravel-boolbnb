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
        'city', 
        'zip_code', 
        'address',
        'lat',
        'lon',
        'cover_img',
        'show',
    ];

    public function user(){
        return  $this->belongsTo(User::class);
    }
}
