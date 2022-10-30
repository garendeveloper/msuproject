<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class AccomplishmentReport extends Model
{
    use HasFactory;
    protected $fillable = [
        'id', 'gaa', 'amount_utilized', 'remarks', 'jobrequest_id'
    ];
}
