<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Duration;
use App\Models\User;
use App\Models\Rental;

class Unit extends Model
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
    protected $table = 'units';

    use HasFactory;

    protected $fillable = [
        'description','price', 'square_footage','duration_id',
        'rental_id','estate_id', 'unit','uid','resources','slug','estate_uid',
        'tenant_id','lease_start','lease_stop','deleted','status','room_no',
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function durationName()
    {
        return $this->belongsTo(Duration::class, 'duration_id');
    }

    public function tenantName()
    {
        return $this->belongsTo(User::class, 'tenant_id');
    }

    public function rentalName()
    {
        return $this->belongsTo(Rental::class, 'rental_id');
    }

}
