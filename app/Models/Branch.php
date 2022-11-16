<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Branch extends Model
{
    use HasFactory;

    protected $fillable =[
        'id',
        'account_id',
        'name',
        'username',
        'email',
        'handphone_number',
        'ic',
        'base_currency',
        'balance',
        'address',
        'password',
        'credit_limit',
        'join_date',
        'created_by',
    ];
}
