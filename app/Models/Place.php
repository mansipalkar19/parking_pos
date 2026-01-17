<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Place extends Model
{
    use HasFactory;
    protected $table = 'places';
    protected $fillable = [
        'place_name',
        'city',
        'state',
        'country',
        'status',
        'no_of_slots',
        'operator_id',
        'vehicle_type'
    ];
    protected $casts = [
        'vehicle_type' => 'array',
    ];
}
