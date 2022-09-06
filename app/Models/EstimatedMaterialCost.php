<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstimatedMaterialCost extends Model
{
    use HasFactory;
    protected $fillable = [
        'construction_id', 'unit', 'unitcost', 'description', 'amount', 'id', 'quantity', 'alphabethical',
    ];
}
