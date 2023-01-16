@extends('layouts.admin')

@section('Profile')
    Report Request || Admin
@endsection

@section('content')
    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
            
                    <div class="col-sm-12">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item active">Report</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            
            <div class="col-md-12">
              <div class="card card-success card-outline">
                <div class="card-header p-2">
                  <h3> <i class="fa fa-book"></i> Report Monthly</h3>
                </div><!-- /.card-header -->
                <div class="card-body">
        
                    <table class="table table-hover" id="table-list">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>finish</th>
                            <th>Onprogress</th>
                            <th>Response</th>
                            <th>Pending</th>
                            <th>Reject</th>
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
                                      <i class="fa fa-check"></i> 
                                  </span></a>
                              </td>
                              <td>
                                  
                                      <?php
                                          $finish = DB::table('requests')
                                          ->select(DB::raw("count(id) as finish "))
                                          ->where('progress_request','=','4')
                                          ->where('id_department','=',Auth::User()->id_department)
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
                                          ->where('id_department','=',Auth::User()->id_department)
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
                                      ->where('id_department','=',Auth::User()->id_department)
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

            <div class="col-md-12">
                <div class="card card-success card-outline">
                  <div class="card-header p-2">
                    <h3> <i class="fas fa-chart-bar"></i> Monthly Chart</h3>
                  </div><!-- /.card-header -->
                  <div class="card-body">
          
                    {{-- <canvas id="barChart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas> --}}
                     @livewire('chart-department')
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

@push('prepend-script')
    <script>
        
    </script>
@endpush




