<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Duration extends Model
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
    protected $table = 'durations';

    use HasFactory;

    protected $fillable = [
        'duration','slug', 'status','deleted'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
