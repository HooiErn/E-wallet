<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Bavix\Wallet\Traits\HasWallets;
use Bavix\Wallet\Traits\CanPay;
use Bavix\Wallet\Interfaces\Customer;
use Bavix\Wallet\Traits\HasWallet;
use Bavix\Wallet\Interfaces\Wallet;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, HasWallet, HasWallets;

    const DEFAULT = 4;
    const AGENT = 3;
    const BRANCH = 2;
    //const SUBADMIN = 2;
    const ADMIN = 1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
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
        'address',
        'remark',
        'status',
        'password',
        'credit_limit',
        'join_date',
        'created_by',
        'deleted_by',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
    
    public function accLevel()
    {
        return (int) $this->account_level;
    }

    public function isAdmin(): bool
    {
        return $this->accLevel() === self::ADMIN;
    }

    public function isAgent(): bool
    {
        return $this->accLevel() === self::AGENT;
    }

    public function isMember(): bool
    {
        return $this->accLevel() === self::DEFAULT;
    }

    // public function isSubadmin(): bool
    // {
    //     return $this->accLevel() === self::SUBADMIN;
    // }

    public function isBranch(): bool
    {
        return $this->accLevel() === self::BRANCH;
    }

}