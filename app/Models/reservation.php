<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class reservation extends Model
{
    use HasFactory;
    protected $table="reservations";
    protected $fillable = ['status',
    'bookingID',
    'bookingID2',
    'sender',
    'sender2', 
    'title', 
    'language', 
    'date', 
    'time', 
    'name', 
    'surname', 
    'adults', 
    'children', 
    'toddlers', 
    'email', 
    'phone', 
    'price', 
    'price2', 
    'added'];
    // turn off both 
public $timestamps = false;

// turn off only updated_at
//const UPDATED_AT = false;
}
