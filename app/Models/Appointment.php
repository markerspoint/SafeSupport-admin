<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Appointment extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'counselor_id',
        'appointment_time',
        'reason',
        'status',
        'notes',
    ];

    protected $casts = [
        'appointment_time' => 'datetime',
    ];


    public function student()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function counselor()
    {
        return $this->belongsTo(User::class, 'counselor_id');
    }

    public function statusBadgeClass()
    {
        return match ($this->status) {
            'pending' => 'badge-warning',
            'rejected' => 'badge-danger',
            'cancelled' => 'badge-secondary',
            default => 'badge-primary',
        };
    }

}
