<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehicule extends Model
{
    use HasFactory;
    protected $table = 'vehicles';

    protected $fillable = [
        'id',
        'mark',
        'model',
        'fuelType',
        'registration',
        'photo',
        'user_id'
    ];
}
