<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\County;

class Subcounty extends Model
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
    protected $table = 'subcounties';
    use HasFactory;

    protected $fillable = [
        'subcounty','county_id','uid','slug', 'status','deleted'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function countyName()
    {
        return $this->belongsTo(County::class,'county_id');
    }
}
