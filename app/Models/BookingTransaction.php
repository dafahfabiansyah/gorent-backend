<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\SoftDeletes;

class BookingTransaction extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
       'name',
       'phone_number',
       'booking_trx_id',
       'is_paid',
       'started_at',
       'ended_at',
       'total_amount',
       'duration',
       'office_space_id',
       'invoice',
    ];

    public static function generateBookingTrxId()
    {
        $prefix = 'RAO';
        $formatId = Carbon::now()->setTimezone('Asia/Jakarta')->format('Y-m-d H:i:s T');

        do {
            // $randomString = $prefix . mt_rand(10000, 99999);
            $randomString = $prefix . $formatId . mt_rand(10000, 99999);
        }while (self::where('booking_trx_id', $randomString)->exists());

        return $randomString;
    }

    public function officeSpace() : BelongsTo
    {
        return $this->belongsTo(OfficeSpace::class, 'office_space_id');
    }
}