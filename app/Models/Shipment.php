<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Shipment extends Model
{
    use HasFactory;

    public $fillable = [
        'tracking_code',
        'stage',
        'sender_id',
        'receiver_id',
        'status_id',
        'type_id',
        'mode_id',
        'origin',
        'destination',
        'pickedup_date',
        'expected_delivery_date',
        'actual_delivery_date',
        'comments',
    ];
}
