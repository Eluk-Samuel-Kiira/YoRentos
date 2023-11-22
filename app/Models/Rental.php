<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rental extends Model
{
    use HasFactory;

    protected $fillable = [
        'name','slug', 'status','deleted'
    ];

    public function getRouteKeyName()
    {
        return 'slug';
    }
}
