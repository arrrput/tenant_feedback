<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Progres extends Model
{
    use HasFactory;

    protected $table = 'progress';
    protected $fillable = [
        'id_request', 'message','image', 'id_user','akar_penyebab'
    ];
}
