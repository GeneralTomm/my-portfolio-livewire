<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Settings extends Model
{
    use HasFactory;

    protected $table = 'settings';
    protected $fillable = ['name_website', 'phone', 'linkedin', 'email', 'facebook', 'tiktok', 'instagram', 'description', 'address', 'images', 'icon'];
}
