<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'photo', 'information', 'rating', 'latitude', 'longitude'];

    function scopeRadiusSearch($query, $lat, $lng)
    {
        // Radius Search 6.2 Miles = 10km
        return $query->havingRaw('( 3959 * acos ( cos ( radians('.$lat.') ) * cos( radians( latitude ) ) * cos( radians( longitude ) - radians('.$lng.') ) + sin ( radians('.$lat.') ) * sin( radians( latitude ) ) ) ) <= 6.2');
    }
}
