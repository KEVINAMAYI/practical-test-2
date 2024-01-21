<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accommodation_allocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_id',
        'accommodation_id',
        'start_date',
        'end_date',
        'added_by',
        'updated_by',
        'status_changed_by',
        'status_id'
    ];


    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    public function accommodation()
    {
        return $this->belongsTo(Accommodation::class);
    }

    public function addedBy()
    {
        $this->belongsTo(User::class, 'added_by');
    }

    public function updatedBy()
    {
        $this->belongsTo(User::class, 'updated_by');
    }

    public function statusChangedBy()
    {
        $this->belongsTo(User::class, 'status_changed_by');
    }

    public function status()
    {
        return $this->belongsTo(Status::class);
    }
}
