<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Parish;

class Village extends Model
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
    protected $table = 'villages';
    use HasFactory;

    protected $fillable = [
        'village','parish_id','uid','slug', 'status','deleted'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function parishName()
    {
        return $this->belongsTo(Parish::class,'parish_id');
    }
}
