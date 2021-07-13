<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Items extends Model
{
    use HasFactory;

    public $fillable = [
        'shipment_id',
        'quantity_type_id',
        'quantity_number',
        'description',
        'value',
        'currency',
        'weight',
        'length',
        'width',
        'height'
    ];

    public function user(){

        return $this->belongsTo(User::class);
    }

    public function shipment(){
        
        return $this->belongsTo(Shipment::class);
    }

    public function quantityType(){

        return $this->belongsTo(quantityType::class);
    }
    
}
