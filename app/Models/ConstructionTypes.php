<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ConstructionTypes extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'construction_type', 'status', 'created_at', 'updated_at'
    ];
}
