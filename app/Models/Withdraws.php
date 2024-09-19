<?php

namespace App\Models;

use App\Enums\TransactionHistory\TransactionHistoryType;
use App\Enums\Withdraws\WithdrawsStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Withdraws extends Model
{
    use HasFactory;

    protected $table = "withdraws";

    protected $guarded = [];

    protected $casts = [];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function admin()
    {
        return $this->belongsTo(Admin::class, 'admin_id');
    }

    public function bank()
    {
        return $this->belongsTo(Banks::class, 'bank_id');
    }

    public function scopeWithdrawPending($query)
    {
        return $query->where('status', 0);
    }
}
