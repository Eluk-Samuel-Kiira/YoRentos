<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Unitpay extends Model
{
    /**
     * The connection name for the model.
     *
     * @var string
     */
    protected $connection = 'mysql_payments';
    use HasFactory;

    protected $fillable = [
        'estate_id','landlord_id','duration','amount','txn_ref','status','deleted'
    ];
}
