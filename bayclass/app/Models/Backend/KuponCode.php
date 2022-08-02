<?php

namespace App\Models\Backend;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class KuponCode extends Model
{
    use HasFactory;

    protected $table = 'kupon_codes';

    protected $fillable = [
         'nama_kupon', 'status' , 'kode_kupon' , 'user_id'
    ];
    
    public function users()
    {
        return $this->belongsTo(User::class,  'user_id');
    }

}
