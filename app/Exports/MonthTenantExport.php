<?php

namespace App\Exports;

use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;

class MonthTenantExport implements FromQuery, WithHeadings
{
    /**
    * @return \Illuminate\Support\Collection
    */
    use Exportable;
    
    public function query()
    {
        //return Requests::select('description','progress_request','image')->get();
        return DB::table('requests')
        ->select('users.name','departments.department as department','requests.description' ,'requests.created_at')
        ->join('departments','departments.id','requests.id_department')
        ->join('users','users.id','requests.id_user')
        ->orderBy('users.name');
        //->whereMonth('requests.created_at', '=', $month)
        //->get();
    }

    public function headings(): array
    {
        return ["Company Name", "Department", "Description Request","Date Request"];
    }    

    
}
