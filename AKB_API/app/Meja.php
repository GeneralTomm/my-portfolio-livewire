<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;

class Meja extends Model
{
    protected $table = 'meja';
    protected $primaryKey='id_meja';
    public $timestamps = false;
    protected $fillable = [
        'id_meja', 'no_meja','status_meja'
    ];

   
}
