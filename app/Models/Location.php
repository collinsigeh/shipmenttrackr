<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    use HasFactory;

    public $fillable = [
        'shipment_id',
        'name',
        'status_id',
        'date',
        'time',
        'remark',
    ];

    public function user()
    {

        return $this->belongsTo(User::class);
    }

    public function shipment()
    {

        return $this->belongsTo(Shipment::class);
    }

    public function status()
    {

        return $this->belongsTo(Status::class);
    }
}
