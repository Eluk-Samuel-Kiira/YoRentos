<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Subcounty;

class Parish extends Model
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
    protected $table = 'parishes';
    use HasFactory;

    protected $fillable = [
        'parish','subcounty_id','uid','slug', 'status','deleted'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function subcountyName()
    {
        return $this->belongsTo(Subcounty::class,'subcounty_id');
    }
}
