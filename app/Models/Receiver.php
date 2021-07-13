<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receiver extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
        'email',
        'phone',
        'address',
    ];

    public function shipments(){

        return $this->hasMany(Shipment::class);
    }
}
