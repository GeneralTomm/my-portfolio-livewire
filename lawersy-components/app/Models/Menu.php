<?php

namespace App\Models;

use App\Models\SubMenu;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Menu extends Model
{
    use HasFactory;

    protected $table = 'menus';
    protected $fillable = ['name','status'];

    public function subMenu()
    {
        return $this->hasMany(SubMenu::class, 'id', 'name');
    }
}
