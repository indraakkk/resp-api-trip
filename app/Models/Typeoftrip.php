<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Typeoftrip extends Model
{
    use HasFactory;

    protected $table = 'type_of_trip';

    protected $fillable = [
        'slug',
        'type',
        'category'
    ];
}
