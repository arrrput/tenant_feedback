<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FinishTask extends Model
{
    use HasFactory;

    protected $table ='finish_task';
    protected $fillable = [
        'description','image','id_request', 'id_user'
    ];
}
