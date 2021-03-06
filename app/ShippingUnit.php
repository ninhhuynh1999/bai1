<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class ShippingUnit extends Model
{
    protected $fillable = [
        'name', 'shortName', 
        'taxId', 'dateStopContact', 
        'bankName',    'bankNumber',    
        'bankAddress',    'address',    
        'contact',    'note',
        'phoneNumber','created_by',
        'updated_by','status_id'
    ];

    protected $casts = [
        'created_at' => 'datetime:d-m-Y',
        'updated_at' => 'datetime:d-m-Y'
    ];

    public function status()
    {
        return $this->belongsTo(StatusShippingUnit::class);
    }

    public function created_by()
    {
        return $this->belongsTo(User::class,'created_by','id');
    }

    
    public function updated_by()
    {
        return $this->belongsTo(User::class,'updated_by','id');
    }
}
