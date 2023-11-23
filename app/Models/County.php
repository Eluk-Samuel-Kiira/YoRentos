<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\District;

class County extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_locations';

    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'counties';
    use HasFactory;

    protected $fillable = [
        'county','district_id','uid','slug', 'status','deleted'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function districtName()
    {
        return $this->belongsTo(District::class,'district_id');
    }
}
