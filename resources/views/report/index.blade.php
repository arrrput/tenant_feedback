@extends('layouts.master')

@push('plugin-styles')
    {!! Html::style('assets/css/ui-elements/breadcrumbs.css') !!}
    {!! Html::style('plugins/table/datatable/datatables.css') !!}
    {!! Html::style('plugins/table/datatable/dt-global_style.css') !!}
@endpush

@push('custom-style')
    <style>
        .dt-top-container {
        display: grid;
        grid-template-columns: auto auto auto;
        }

        .dt-center-in-div {
        margin: 0 auto;
        }

        .dt-filter-spacer {
        margin: 10px 0;
        }
    </style>
@endpush

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        
    <!--  Navbar Starts / Breadcrumb Area  -->
    <div class="sub-header-container">
        <header class="header navbar navbar-expand-sm">
            <a href="javascript:void(0);" class="sidebarCollapse" data-placement="bottom">
                <i class="las la-bars"></i>
            </a>
            <ul class="navbar-nav flex-row">
                <li>
                    <div class="page-header">
                        <nav class="breadcrumb-one" aria-label="breadcrumb">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item active" aria-current="page"><span> {{__('Report')}}</span></li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>
        </header>
    </div>
    <!--  Navbar Ends / Breadcrumb Area  -->


        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            
            <div class="col-md-12">
              <div class="card card-success card-outline">
                <div class="card-header p-2">
                  <h6> <i class="las la-book"></i> Report Monthly</h6>
                </div><!-- /.card-header -->
                <div class="card-body">
        
                    <table class="table table-hover" id="table_list">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>finish</th>
                            <th>Onprogress</th>
                            <th>Response</th>
                            <th>Pending</th>
                            <th>Cancel</th>
                            <th>Month </th>
                            <th>Year</th>
                            <th style="width: 200px;">Total Reqests</th>
                          </tr>
                          
                        </thead>
                        <tbody>
                            @foreach ($month as $data)
                            <tr>
                              <td>
                                  <a href="{{ route('admin.report.month',['date'=>$data->date,'year'=>$data->year]) }}"><span class="badge bg-primary">
                                      <i class="las la-check-double"></i> 
                                  </span></a>
                              </td>
                              <td>
                                  
                                      <?php
                                          $finish = DB::table('requests')
                                          ->select(DB::raw("count(id) as finish "))
                                          ->where('progress_request','=','4')
                                          ->whereMonth('created_at',$data->date)
                                          ->groupBy('progress_request')
                                          ->get();
                                          $p_finish = count($finish);
                                      ?>
                                       @if ($p_finish > 0)
                                       <span class="badge bg-success">
                                           {{ $finish[0]->finish }} Requests </span>
                                       @else
                                       <span class="badge bg-success">
                                           0 Requests </span>
                                       @endif  
                                   
                              </td>
                              <td>
                                  
                                      <?php
                                          $progress = DB::table('requests')
                                          ->select(DB::raw("count(id) as finish "))
                                          ->where('progress_request','=','3')
                                          ->whereMonth('created_at',$data->date)
                                          ->groupBy('progress_request')
                                          ->get();
                                          $p_count = count($progress);
                                      ?>
                                      @if ($p_count > 0)
                                      <span class="badge bg-primary">
                                          {{ $progress[0]->finish }} Requests </span>
                                      @else
                                      <span class="badge bg-primary">
                                          0 Requests </span>
                                      @endif
                                          
                              </td>
                              <td>
                                  
                                  <?php
                                      $respon = DB::table('requests')
                                      ->select(DB::raw("count(id) as finish "))
                                      ->where('progress_request','=','2')
                                      ->whereMonth('created_at',$data->date)
                                      ->groupBy('progress_request')
                                      ->get();
                                      $p_respon = count($respon);
                                  ?>
                                  @if ($p_respon > 0)
                                  <span class="badge bg-warning">
                                      {{ $respon[0]->finish }} Requests </span>
                                  @else
                                  <span class="badge bg-warning">
                                      0 Requests </span>
                                  @endif
                                      
                          </td>
  
                          <td>
                                  
                              <?php
                                  $pending = DB::table('requests')
                                  ->select(DB::raw("count(id) as finish "))
                                  ->where('progress_request','=','1')
                                  ->whereMonth('created_at',$data->date)
                                  ->groupBy('progress_request')
                                  ->get();
                                  $p_pending = count($pending);
                              ?>
                              @if ($p_pending > 0)
                              <span class="badge bg-danger">
                                  {{ $pending[0]->finish }} Requests </span>
                              @else
                              <span class="badge bg-danger">
                                  0 Requests </span>
                              @endif
                                  
                          </td>
  
                          <td>
                                  
                              <?php
                                  $pending = DB::table('requests')
                                  ->select(DB::raw("count(id) as finish "))
                                  ->where('progress_request','=','5')
                                  ->whereMonth('created_at',$data->date)
                                  ->groupBy('progress_request')
                                  ->get();
                                  $p_pending = count($pending);
                              ?>
                              @if ($p_pending > 0)
                              <span class="badge bg-danger">
                                  {{ $pending[0]->finish }} Requests </span>
                              @else
                              <span class="badge bg-danger">
                                  0 Requests </span>
                              @endif
                                  
                          </td>
  
                              <td>  
                                  @if ($data->date == 1)
                                      Jan
                                  @elseif ($data->date == 2)
                                      Feb
                                  @elseif ($data->date == 3)
                                      Mar
                                  @elseif ($data->date == 4)
                                      Apr
                                  @elseif ($data->date == 5)
                                      May
                                  @elseif ($data->date == 6)
                                      Jun
                                  @elseif ($data->date == 7)
                                      Jul
                                  @elseif ($data->date == 8)
                                      Aug
                                  @elseif ($data->date == 9)
                                      Sept
                                  @elseif ($data->date == 10)
                                      Okt
                                  @elseif ($data->date == 11)
                                      Nov
                                  @elseif ($data->date == 12)
                                      Dec
                                  @endif  
                              </td>
                              <td>{{ $data->year }}</td>
                              <td>{{ $data->total_request }} Requests</td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                   
                </div><!-- /.card-body -->
              </div>
              <!-- /.card -->
            </div>
            <!-- /.col -->

            <div class="col-md-12 mt-5">
                <div class="card card-success card-outline">
                  <div class="card-header p-2">
                    <h6> <i class="las la-chart-bar"></i> Detail Request</h6>
                  </div><!-- /.card-header -->
                  <div class="card-body">
                    
                    <table class="table table-hover" id="table_detail">
                        <thead>
                          <tr>
                            <th style="width: 10px">No</th>
                            <th>Date Feedback</th>
                            <th>Tenant</th>
                            <th>Feedback</th>
                            <th>Date Completed</th>
                          </tr>
                          
                        </thead>
                        <tbody>

                        </tbody>
                    </table>
                    
                  </div><!-- /.card-body -->
                </div>
                <!-- /.card -->
              </div>
              <!-- /.col -->
          </div>
          <!-- /.row -->
        </div><!-- /.container-fluid -->
      </section>
      <!-- /.content -->
        <!-- maincontent -->
  <!-- Control Sidebar -->
    </div>
@endsection

@push('plugin-scripts')
   
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/table/datatable/datatables.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/dataTables.buttons.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/jszip.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/buttons.html5.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/buttons.print.min.js') !!}
    <!-- The following JS library files are loaded to use PDF Options-->
    {!! Html::script('plugins/table/datatable/button-ext/pdfmake.min.js') !!}
    {!! Html::script('plugins/table/datatable/button-ext/vfs_fonts.js') !!}
@endpush

@push('custom-scripts')
    <script>

        var table_list, table_detail;
        table_list = $('#table_list').DataTable({
            dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<"dt-filter-spacer"><ip>',
                    buttons: {
                        buttons: [
                            
                            { extend: 'copy', className: 'btn btn-sm btn-dark' },
                            { extend: 'csv', className: 'btn btn-sm btn-dark' },
                            { extend: 'excel', className: 'btn btn-sm btn-dark' },
                            { extend: 'print', className: 'btn btn-sm btn-dark' },
                            
                        ]
                    },
                "lengthMenu": [[50, 100, 250, -1], [50, 100, 250, "All"]],
                "pageLength": 50,
                "language": {
                    "paginate": {
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>"
                    }
                }
            });

        table_detail = $('#table_detail').DataTable({
            dom: '<"dt-top-container"<l><"dt-center-in-div"B><f>r>t<"dt-filter-spacer"><ip>',
                    buttons: {
                        buttons: [
                            
                            { extend: 'copy', className: 'btn btn-sm btn-dark' },
                            { extend: 'csv', className: 'btn btn-sm btn-dark' },
                            { extend: 'excel', className: 'btn btn-sm btn-dark' },
                            { extend: 'print', className: 'btn btn-sm btn-dark' },
                            
                        ]
                    },
                "lengthMenu": [[50, 100, 250, -1], [50, 100, 250, "All"]],
                "pageLength": 50,
                "language": {
                    "paginate": {
                    "previous": "<i class='las la-angle-left'></i>",
                    "next": "<i class='las la-angle-right'></i>"
                    }
            },
            processing: true,
            serverSide: true,
            
            ajax: {
                
                url: "{{ URL::to('/') }}/admin/report/detail_req",
                type: "GET"
                
            },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data:'date_req', name : 'date_req',orderable: true, searchable: true},
                    {data:'tenant_name', name : 'tenant_name',orderable: true, searchable: true},
                    {data:'feedback', name : 'feedback',orderable: true, searchable: true},
                    {data:'date_finish', name : 'date_finish',orderable: true, searchable: true},
                ]
        });

        $(document).ready(function (e) {
            var areaChartData = {
                labels  : ['January', 'February', 'March', 'April', 'May', 'June', 'July'],
                datasets: [
                    {
                    label               : 'Digital Goods',
                    backgroundColor     : 'rgba(60,141,188,0.9)',
                    borderColor         : 'rgba(60,141,188,0.8)',
                    pointRadius          : false,
                    pointColor          : '#F24C4C',
                    pointStrokeColor    : 'rgba(60,141,188,1)',
                    pointHighlightFill  : '#fff',
                    pointHighlightStroke: 'rgba(60,141,188,1)',
                    data                : [28, 48, 40, 19, 86, 27, 90]
                    }
                ]
                }
        //-------------
            //- BAR CHART -
            //-------------
    var barChartCanvas = $('#barChart').get(0).getContext('2d')
    var barChartData = $.extend(true, {}, areaChartData)
    var temp0 = areaChartData.datasets[0]
    barChartData.datasets[0] = temp0
    var barChartOptions = {
      responsive              : true,
      maintainAspectRatio     : false,
      datasetFill             : false
    }

    new Chart(barChartCanvas, {
      type: 'bar',
      data: barChartData,
      options: barChartOptions
    })
        });
    </script>
@endpush




