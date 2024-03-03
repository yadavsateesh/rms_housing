<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FurnishingStatus extends Model
{
    use HasFactory;
	
	protected $fillable = [
        'property_for',
        'status',
    ];
}
