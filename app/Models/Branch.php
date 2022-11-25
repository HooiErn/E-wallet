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
        'account_level',
        'account_name',
        'name',
        'username',
        'email',
        'handphone_number',
        'ic',
        'base_currency',
        'credit_available',
        'address',
        'remark',
        'status',
        'password',
        'credit_limit',
        'join_date',
        'created_by',
        'deleted_by',
    ];
}
