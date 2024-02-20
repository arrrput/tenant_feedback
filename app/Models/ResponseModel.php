<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ResponseModel extends Model
{
    use HasFactory;

    protected $table='response';

    protected $fillable = [
        'id_request', 'response','id_user','target_hari'
    ];
}
