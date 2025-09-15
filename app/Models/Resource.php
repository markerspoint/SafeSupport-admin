<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\User;

class Resource extends Model
{
    protected $fillable = [
        'title',
        'description',
        'type',
        'file_path',
        'url',
        'created_by',
    ];

    // Relationship: who created this resource
    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
