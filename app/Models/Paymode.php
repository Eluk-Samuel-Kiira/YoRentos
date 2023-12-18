<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paymode extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_payments';

    use HasFactory;

    protected $fillable = [
        'estate_id','landlord_id','pay_mode','account_name','account_number','status','deleted'
    ];

}
