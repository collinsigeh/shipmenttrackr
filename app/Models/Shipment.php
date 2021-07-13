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

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function sender(){

        return $this->belongsTo(Sender::class);
    }

    public function receiver(){

        return $this->belongsTo(Receiver::class);
    }

    public function status(){

        return $this->belongsTo(Status::class);
    }

    public function type(){

        return $this->belongsTo(Type::class);
    }

    public function mode(){

        return $this->belongsTo(Mode::class);
    }

    public function items()
    {

        return $this->hasMany(Item::class);
    }

}
