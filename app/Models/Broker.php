<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Broker extends Model
{
    use HasFactory;
    protected $fillable = [
        'broker_id','district_id', 'status','deleted'
    ];

    public function brokerName()
    {
        return $this->belongsTo(User::class, 'broker_id');
    }

    public function brokerDistrict()
    {
        return $this->belongsTo(District::class, 'broker_id');
    }
}
