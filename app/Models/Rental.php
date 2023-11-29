<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
}
