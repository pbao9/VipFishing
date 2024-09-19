<?php

namespace App\Observers;

use App\Models\Events;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;
use SimpleSoftwareIO\QrCode\Facades\QrCode;

class EventObserver
{
    /**
     * Handle the Events "created" event.
     *
     * @param  \App\Models\Events  $events
     * @return void
     */
    public function created(Events $events)
    {
        // Tạo nội dung QR chứa event_id
        $qrContent = json_encode(['event_id' => $events->id]);

        // Tạo mã QR từ nội dung
        $qrCode = QrCode::format('png')->size(300)->generate($qrContent);

        // Đặt đường dẫn lưu file QR trong storage
        $fileName = 'qr_codes/' . $events->code . '.png';

        // Lưu QR vào storage
        Storage::put($fileName, $qrCode);

        // Lưu đường dẫn QR vào cột 'qr_path' trong cơ sở dữ liệu
        $events->qr_path = $fileName;
        $events->save();

        // Log đường dẫn lưu QR code
        Log::info('QR Code saved', ['path' => $fileName]);
    }

    /**
     * Handle the Events "updated" event.
     *
     * @param  \App\Models\Events  $events
     * @return void
     */
    public function updated(Events $events)
    {
        //
    }

    /**
     * Handle the Events "deleted" event.
     *
     * @param  \App\Models\Events  $events
     * @return void
     */
    public function deleted(Events $events)
    {
        //
    }

    /**
     * Handle the Events "restored" event.
     *
     * @param  \App\Models\Events  $events
     * @return void
     */
    public function restored(Events $events)
    {
        //
    }

    /**
     * Handle the Events "force deleted" event.
     *
     * @param  \App\Models\Events  $events
     * @return void
     */
    public function forceDeleted(Events $events)
    {
        //
    }
}
