<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Country;

class District extends Model
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
    protected $table = 'districts';
    use HasFactory;

    protected $fillable = [
        'district','country_id','uid','slug', 'status','deleted'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function countryName()
    {
        return $this->belongsTo(Country::class,'country_id');
    }
}
