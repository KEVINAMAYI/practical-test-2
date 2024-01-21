<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contract extends Model
{
    use HasFactory;

    protected $fillable = [
        'contract_number',
        'status_id',
        'travel_agent_id',
        'exclusive',
        'start_date',
        'end_date',
        'added_by',
        'updated_by',
        'status_changed_by',
        'description',
        'standard_rate',
    ];

    public function travelAgent()
    {
        return $this->belongsTo(TravelAgent::class);
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
