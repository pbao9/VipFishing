<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use App\Enums\User\{UserRoles, UserVip, UserGender};
use Illuminate\Support\Facades\DB;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = [];

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
        'roles' => UserRoles::class,
        'gender' => UserGender::class,
        'vip' => UserVip::class,
        'active' => 'boolean'
    ];


    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }

    public function balance()
    {
        return $this->hasOne(Balances::class, 'user_id');
    }

    public function userscores()
    {
        return $this->hasMany(UserScores::class, 'user_id');
    }

    public function bookings(): hasMany
    {
        return $this->hasMany(Bookings::class, 'user_id');
    }

    public function bank()
    {
        return $this->belongsTo(Banks::class, 'bank_id');
    }

    public function rank()
    {
        return $this->belongsTo(Ranks::class, 'rank_id');
    }

    public function deposits()
    {
        return $this->hasMany(Deposits::class, 'user_id');
    }

    public function withdraws()
    {
        return $this->hasMany(Withdraws::class, 'user_id');
    }

    public function commissionHistories()
    {
        return $this->hasMany(CommissionHistory::class, 'user_id');
    }

    public function compensations()
    {
        return $this->hasMany(Compensations::class, 'user_id');
    }

    public function transactionHistories()
    {
        return $this->hasMany(TransactionHistory::class, 'user_id');
    }

    public function referParent()
    {
        return $this->hasOne(User::class, 'code', 'RF');
    }

    public function referParent_1()
    {
        return $this->hasOne(User::class, 'code', 'RF1');
    }
    public function referParent_2()
    {
        return $this->hasOne(User::class, 'code', 'RF2');
    }
    public function referParent_3()
    {
        return $this->hasOne(User::class, 'code', 'RF3');
    }

    public function refer()
    {
        return $this->hasMany(User::class, 'RF', 'code');
    }

    public function refer_1()
    {
        return $this->hasMany(User::class, 'RF1', 'code');
    }
    public function refer_2()
    {
        return $this->hasMany(User::class, 'RF2', 'code');
    }
    public function refer_3()
    {
        return $this->hasMany(User::class, 'RF3', 'code');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims(): array
    {
        return [];
    }
}
