<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Unit;

class Rental extends Model
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
    protected $table = 'rentals';

    use HasFactory;

    protected $fillable = [
        'name','slug', 'status','deleted'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function rentalUnits()
    {
        return $this->hasMany(Unit::class, 'rental_id', 'id');
    }

}
