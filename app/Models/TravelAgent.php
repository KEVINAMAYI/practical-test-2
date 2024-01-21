<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TravelAgent extends Model
{
    use HasFactory;

    protected $fillable = ['user_id','experience','about_me','profile_photo','status_id'];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function contracts(){
        return $this->hasMany(Contract::class);
    }

    public function accommodations(){
        return $this->hasManyThrough(Accommodation_allocation::class,Contract::class);
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
