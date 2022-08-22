<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Currency extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'symbol',
        'exchange_rate',
        'code',
        'status',
        'icon',
    ];

    // public function order(){
    //     return $this->hasOne(Order::class, 'code');
    // }
}
