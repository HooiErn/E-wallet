<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wallet extends Model
{
    use HasFactory;

    protected $fillable =[
        'user_id',
        'total_amount',
        'remaining_amount',
        'used_amount',
    ];
}
