<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasOneThrough;
use App\Models\Rental;
use App\Models\User;
use App\Models\Broker;
use App\Models\Village;
use App\Models\Paymode;

class Estate extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_estates';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'estates';
    use HasFactory;

    protected $fillable = [
        'estate',
        'slug',
        'uid',
        'landlord_id',
        'broker_id',
        'village_id',
        'rental_id',
        'images',
        'latitude',
        'longitude',
        'video',
        'unit_no',
        'description',
        'sponsored',
        'status',
        'deleted',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function rentalEstate()
    {
        return $this->belongsTo(Rental::class,'rental_id');
    }

    public function villageEstate()
    {
        return $this->belongsTo(Village::class, 'village_id');
    }
    
    // public function brokerName()
    // {
    //     return $this->belongsTo(User::class, 'broker_id');
    // }

    public function unitEstate()
    {
        return $this->hasMany(Unit::class, 'estate_id');
    }

    public function rentalName()
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }

    public function payEstate()
    {
        return $this->hasMany(Paymode::class, 'estate_id', 'uid');
    }
}
