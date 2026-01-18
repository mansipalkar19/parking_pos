<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vendor extends Model
{
    use HasFactory;

    protected $table = 'users';

    protected $fillable = [
        'name',
        'mobile',
        'email',
        'status',
        'accept_request',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }
}
