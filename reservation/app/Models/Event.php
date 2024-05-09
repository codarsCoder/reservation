<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    protected $table = 'events';
    protected $fillable = [
        'id',
        'user_id',
        'name',
        'description',
        'date',
        'time',
        'created_at',
        'updated_at'
    ];

}
