<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;


class requests extends Model
{
    use HasFactory;

    protected $table = 'requests';
    protected $fillable = [
        'image','id_department', 'description','id_part', 'id_user','progress_request','lokasi','no_unit'
    ];

    protected $attributes = [
        'status_feedback' => '0',
    ];

}
