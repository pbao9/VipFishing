<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivitySchedule extends Model
{

    protected $table = 'activity_schedule_lake_child';

    protected $fillable = [
        'lake_child_id',
        'activity_date',
    ];

    public $timestamps = true;


    use HasFactory;

    public function lakechild(): BelongsTo
    {
        return $this->belongsTo(Lakechilds::class, 'lake_child_id', 'id');
    }


    // Phương thức để kiểm tra ngày hoạt động có bị tạm ngưng không
    public function checkIfLakeClosed()
    {
        $closeLake = CloseLakes::where('lakechild_id', $this->lake_child_id)
            ->where('close_date', '<=', $this->activity_date)
            ->where('open_date', '>=', $this->activity_date)
            ->first();

        if ($closeLake) {
            return [
                'status' => false,
                'message' => "Hồ này đang tạm ngưng từ ngày {$closeLake->close_date} đến ngày {$closeLake->open_date}.",
            ];
        }

        return [
            'status' => true,
            'message' => 'Có thể đặt hồ trong ngày này.',
        ];
    }
}
