<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Custom extends Model
{
    use HasFactory;

    protected $table = 'customs';
    protected $fillable = [
        'fname' ,
        'lname' ,
        'email' ,
        'occassion' ,
        'event_date' ,
        'measurements' ,
        'order_description' ,
        'budget',
        'image'
    ];
}
