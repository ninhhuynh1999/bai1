<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class StatusShippingUnit extends Model
{
    protected $fillable = [
        'name'
    ];

    public function shippingUnits()
    {
        return $this->belongsToMany(ShippingUnit::class);
    }
}
