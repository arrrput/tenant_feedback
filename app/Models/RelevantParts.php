<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RelevantParts extends Model
{
    use HasFactory;
    protected $table = 'relevant_parts';
    protected $fillable = [
        'id', 'id_department','name_relevant','created_at','updated_at'
    ];
}
