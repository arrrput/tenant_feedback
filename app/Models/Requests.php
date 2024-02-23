<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Alfa6661\AutoNumber\AutoNumberTrait;


class requests extends Model
{
    use HasFactory;
    use AutoNumberTrait;

    protected $table = 'requests';
    protected $fillable = [
        'tic_number','image','id_department', 'description','id_part', 'id_user','progress_request','lokasi','no_unit'
    ];

    protected $attributes = [
        'status_feedback' => '0',
    ];

    public function getAutoNumberOptions()
    {
        return [
            'tic_number' => [
                'format' => function () {
                    return 'CRS-REQ/' . date('Y/m') . '/?'; 
                },
                'length' => 3 
            ]
        ];
    }
}
