<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    protected $fillable = [
        'user_id',
        'shipping_fname',
        'shipping_lname' ,
        'shipping_email',
        'shipping_address'  ,
        'shipping_city' ,
        'shipping_state' ,
        'shipping_country',
        'shipping_phone' ,
        'shipping_zipcode',
    ];
    use HasFactory;
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
