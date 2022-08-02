<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderSteps extends Model
{
    use HasFactory;

    protected $table = 'order_steps';

    protected $fillable = ['title' , 'description'];
}
