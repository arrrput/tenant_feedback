<?php

namespace App\Http\Livewire;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Departments;
use Illuminate\Support\Facades\DB;
use Asantibanez\LivewireCharts\Models\PieChartModel;

class ChartMonthly extends Component
{
    // public function render()
    // {

    //     $columnChartModel =     (new ColumnChartModel())
    //             ->setTitle('Request Departments')
    //             ->addColumn('Food', 100, '#f6ad55')
    //             ->addColumn('Shopping', 200, '#fc8181')
    //             ->addColumn('Travel', 300, '#90cdf4');



    //     return view('livewire.chart-monthly')->with(['chart'=> $columnChartModel]);
    // }

    public $types = ['IT & Media', 'Admin And Legal', 'Estate', 'Environtment', 'Security and Safety'
                        ,'Business Development and Villa','Project & Port Ops','Finance'
                    ,'GMO','HR and GA','Integrated Management System', 'Community Development',
                    'Customer Relations'];

    public $colors = [
        'IT & Media' => '#f6ad55',
        'Admin And Legal' => '#fc8181',
        'Estate' => '#90cdf4',
        'Environtment' => '#66DA26',
        'Security and Safety' => '#cbd5e0',
        'Business Development and Villa' => '#e86609',
        'Project & Port Ops'=>'#05f7ef',
        'Finance'=>'#df15ed',
        'GMO' =>'#2f15ed',
        'HR and GA' => '#3ded15',
        'Integrated Management System' => '#eded15', 
        'Community Development' => '#b17bc9',
        'Customer Relations' => '#31802f'
    ];
    public $firstRun = true;

    protected $listeners = [
        'onPointClick' => 'handleOnPointClick',
        'onSliceClick' => 'handleOnSliceClick',
        'onColumnClick' => 'handleOnColumnClick',
    ];
    public function handleOnPointClick($point)
    {
        dd($point);
    }
    public function handleOnSliceClick($slice)
    {
        dd($slice);
    }
    public function handleOnColumnClick($column)
    {
        dd($column);
    }
    public function render()
    {
        $bulan = Carbon::now();
        $department = Departments::all();
        $expenses = DB::table('requests')
            ->join('departments', 'departments.id', '=', 'requests.id_department')
            ->whereIn('departments.department',$this->types)
            ->whereMonth('requests.created_at',$bulan)
            ->select(
                'requests.id',
                'requests.description',
                'requests.id_department',
                'requests.created_at',
                'requests.progress_request',
                'departments.department'
            )->get();

        $pieChartModel = $expenses->groupBy('department')
            ->reduce(
                function (PieChartModel $pieChartModel, $data) {
                    $type = $data->first()->department;
                    $value = $data->count('id');
                    return $pieChartModel->addSlice($type, $value, $this->colors[$type]);
                },
                (new PieChartModel())
                    ->setTitle('Request by Department')
                    ->setAnimated($this->firstRun)
                    ->withOnSliceClickEvent('onSliceClick')
            );

        $this->firstRun = false;
        return view('livewire.chart-department')
            ->with([
                'pieChartModel' => $pieChartModel,
                'department' => $department,
            ]);
    }
}
