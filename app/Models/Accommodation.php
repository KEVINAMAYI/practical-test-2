<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'description',
        'country',
        'city',
        'address',
        'standard_rack_rate',
        'status_id'
    ];

    public function status()
    {
        return $this->belongsTo(Status::class);
    }

    public function booking(){
        return $this->hasOne(Accommodation_allocation::class);
    }
}
