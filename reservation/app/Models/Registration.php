<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Registration extends Model
{
    use HasFactory;

    protected $table = 'registrations';
    protected $fillable = [
        'user_id',
        'event_id',
        'created_at',
        'updated_at'
    ];

    public function event() {
       return $this->belongsTo(Event::class, 'event_id', 'id');
    }
}
