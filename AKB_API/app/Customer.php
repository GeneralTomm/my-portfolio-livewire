<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Customer extends Model
{
    protected $table = 'customer';
    protected $primaryKey='id_customer';
    public $timestamps = false;
    protected $fillable = [
        'id_customer', 'nama_customer', 'no_hp', 'email_customer' 
    ];

}
