<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
    ];

    public $timestamps = false;

    public function shipments(){

        return $this->hasMany(Shipment::class);
    }

    public function locations(){
        
        return $this->hasMany(Location::class);
    }
}
