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
        'address',
        'status',
        'created_by',
        'updated_by',
        'no_of_slots',
        'operator_id',
        'vehicle_type'
    ];
    protected $casts = [
        'vehicle_type' => 'array',
    ];
    public function setVehicleTypeAttribute($value)
    {
        $this->attributes['vehicle_type'] = json_encode(
            array_map('intval', $value)
        );
    }
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function updater()
    {
        return $this->belongsTo(User::class, 'updated_by');
    }
}
