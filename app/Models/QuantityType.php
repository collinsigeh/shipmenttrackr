<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class QuantityType extends Model
{
    use HasFactory;

    public $fillable = [
        'name',
    ];

    public function items(){

        return $this->hasMany(Item::class);
    }
}
