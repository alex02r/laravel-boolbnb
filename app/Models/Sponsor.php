<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;

class Sponsor extends Model
{
    use HasFactory;
    protected $fillable = ['title', 'duration', 'price'];

    public function apartments(){
        return $this->belongsToMany(Apartment::class);
    }
}
