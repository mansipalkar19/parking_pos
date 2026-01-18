<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendorMapping extends Model
{
    use HasFactory;
    protected $table = 'vendor_mapping';
    protected $fillable = [
        'fk_vendor_id',
        'fk_place_id',
        'operator_id',
        'status',
        'created_by',
        'updated_by',
    ];

    public function place()
    {
        return $this->belongsTo(Place::class, 'place_id');
    }
}
