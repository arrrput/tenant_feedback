@extends('layouts.master')

@push('plugin-styles')
    {!! Html::style('assets/css/loader.css') !!}
    {!! Html::style('plugins/apex/apexcharts.css') !!}
    {!! Html::style('assets/css/dashboard/dashboard_1.css') !!}
    {!! Html::style('plugins/flatpickr/flatpickr.css') !!}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('assets/css/elements/tooltip.css') !!}
@endpush

@section('title')
    Dashboard || Admin
@endsection

@section('content')

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
                              
                              <li class="breadcrumb-item active" aria-current="page"><span> {{__('Dashboard')}}</span></li>
                          </ol>
                      </nav>
                  </div>
              </li>
          </ul>
      </header>
  </div>
  <!--  Navbar Ends / Breadcrumb Area  -->

  <!-- Main Body Starts -->
  <div class="layout-px-spacing">
    <div class="row layout-top-spacing">
        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
            <a class="widget quick-category">
                <div class="quick-category-head">
                            <span class="quick-category-icon qc-primary rounded-circle">
                                <i class="las la-user"></i>
                            </span>
                    <div class="ml-auto">
                        <div class="quick-comparison qcompare-success">
                            <span> {{ $tenant }}</span>
                            <i class="las la-user-circle"></i>
                        </div>
                    </div>
                </div>
                <div class="quick-category-content">
                    <h3> {{ $tenant }}</h3>
                    <p class="font-17 text-primary mb-0"> {{ __('User Tenant') }}</p>
                </div>
            </a>
        </div>

        <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <a class="widget quick-category">
              <div class="quick-category-head">
                          <span class="quick-category-icon qc-warning rounded-circle">
                              <i class="las la-box"></i>
                          </span>
                  <div class="ml-auto">
                      <div class="quick-comparison qcompare-danger">
                          <span> {{ __('10%') }}</span>
                          <i class="las la-pause-circle"></i>
                      </div>
                  </div>
              </div>
              <div class="quick-category-content">
                  <h3> {{ $pending }}</h3>
                  <p class="font-17 text-warning mb-0"> {{ __('Request Pending') }}</p>
              </div>
          </a>
      </div>
      <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <a class="widget quick-category">
              <div class="quick-category-head">
                          <span class="quick-category-icon qc-secondary rounded-circle">
                            <i class="las la-check-double"></i>
                          </span>
                  <div class="ml-auto">
                      <div class="quick-comparison qcompare-success">
                          <span> {{ $finish }}</span>
                          <i class="las la-arrow-up"></i>
                      </div>
                  </div>
              </div>
              <div class="quick-category-content">
                  <h3> {{ $finish }}</h3>
                  <p class="font-17 text-secondary mb-0"> {{ __('Request Done') }}</p>
              </div>
          </a>
      </div>
      <div class="col-xl-3 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
          <a class="widget quick-category">
              <div class="quick-category-head">
                          <span class="quick-category-icon qc-success-teal rounded-circle">
                            <i class="las la-project-diagram"></i>
                          </span>
                  <div class="ml-auto">
                      <div class="quick-comparison qcompare-danger">
                          <span> {{ $departments }}</span>
                          <i class="las la-arrow-down"></i>
                      </div>
                  </div>
              </div>
              <div class="quick-category-content">
                  <h3> {{ $departments }}</h3>
                  <p class="font-17 text-success-teal mb-0"> {{ __('Department') }}</p>
              </div>
          </a>
      </div>
    </div>

    {{-- Table --}}
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
      <div class="widget dashboard-table">
          <div class="widget-heading">
              <h5 class=""> {{__('Projects')}}</h5>
          </div>
          <div class="widget-content">
              <div class="table-responsive">
                  <table class="table">
                      <thead>
                      <tr>
                          <th><div class="no-content"> {{__('Name')}}</div></th>
                          <th><div class="th-content"> {{__('Tenant Name')}}</div></th>
                          <th><div class="th-content"> {{__('Status')}}</div></th>
                          <th><div class="th-content"> {{__('Date of Request')}}</div></th>
                      </tr>
                      </thead>
                      <tbody>
                        <?php $number=1; ?>
                        @foreach ($req_tenant as $recent )
                        <tr>
                          <td><?php  echo $number++;?></td>
                          <td>{{ $recent->description }}</span></td>
                          <td>
                              @if ($recent->progress_request ==1)
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-danger" style="width: 25%"></div>
                            </div>
                            @endif
    
                            @if ($recent->progress_request ==2)
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-warning" style="width: 40%"></div>
                            </div>
                            @endif
    
                            @if ($recent->progress_request =='3')
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-primary" style="width: 75%"></div>
                            </div>
                            @endif
    
                            @if ($recent->progress_request =='4')
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-success" style="width: 100%"></div>
                            </div>
                            @endif
                            @if ($recent->progress_request =='5')
                            <span class="badge bg-red">Rejected</span>
                            @endif
                          </td>
                          <td>{{ date('d M Y', strtotime($recent->created_at)); }}</td>
                        </tr>
                        @endforeach   
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>
  </div>

   
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <div class="row">
         
          
          <div class="col-12">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Recent Request</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                @role('admin|user')
                    <table class="table table-bordered" id="table-recent">
                      <thead>
                        <tr>
                          <th style="width: 10px">#</th>
                          <th>Tenant Name</th>
                          <th style="width: 100px">Status</th>
                          <th >Date of Request</th>
                        </tr>
                      </thead>
                      <tbody>
                        <?php $number=1; ?>
                        @foreach ($recent_req as $recent )
                        <tr>
                          <td><?php  echo $number++;?></td>
                          <td>{{ $recent->name }}</span></td>
                          <td>
                              @if ($recent->progress_request ==1)
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-danger" style="width: 25%"></div>
                            </div>
                            @endif

                            @if ($recent->progress_request ==2)
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-warning" style="width: 40%"></div>
                            </div>
                            @endif

                            @if ($recent->progress_request =='3')
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-primary" style="width: 75%"></div>
                            </div>
                            @endif

                            @if ($recent->progress_request =='4')
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-success" style="width: 100%"></div>
                            </div>
                            @endif
                            @if ($recent->progress_request =='5')
                            <span class="badge bg-danger">Rejected</span> 
                            @endif
                          </td>
                          <td>{{ date('d M Y', strtotime($recent->created_at)); }}</td>
                        </tr>
                        @endforeach                   

                      </tbody>
                    </table>
                @endrole
                
                <?php $roles_name = Auth::user()->getRoleNames() ?>
                @if ($roles_name->first() != 'admin')
                    
                @role('tenant')
                <table class="table table-bordered" id="table-recent">
                  <thead>
                    <tr>
                      <th style="width: 10px">#</th>
                      <th>Description</th>
                      <th style="width: 100px">Status</th>
                      <th >Date of Request</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php $number=1; ?>
                    @foreach ($req_tenant as $recent )
                    <tr>
                      <td><?php  echo $number++;?></td>
                      <td>{{ $recent->description }}</span></td>
                      <td>
                          @if ($recent->progress_request ==1)
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-danger" style="width: 25%"></div>
                        </div>
                        @endif

                        @if ($recent->progress_request ==2)
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-warning" style="width: 40%"></div>
                        </div>
                        @endif

                        @if ($recent->progress_request =='3')
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-primary" style="width: 75%"></div>
                        </div>
                        @endif

                        @if ($recent->progress_request =='4')
                        <div class="progress progress-xs">
                          <div class="progress-bar bg-success" style="width: 100%"></div>
                        </div>
                        @endif
                        @if ($recent->progress_request =='5')
                        <span class="badge bg-red">Rejected</span>
                        @endif
                      </td>
                      <td>{{ date('d M Y', strtotime($recent->created_at)); }}</td>
                    </tr>
                    @endforeach                   

                  </tbody>
                </table>
                    
                @endrole
                @endif
                
                
              </div>
              <!-- /.card-body --> 
            </div>
            <!-- /.card -->
          </div>
          <!-- col  -->

          {{-- <div class="col-lg-5">
            <!-- Default box -->
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">Chart Of Request</h3>

                <div class="card-tools">
                  <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                    <i class="fas fa-minus"></i>
                  </button>
                  <button type="button" class="btn btn-tool" data-card-widget="remove" title="Remove">
                    <i class="fas fa-times"></i>
                  </button>
                </div>
              </div>
              <div class="card-body">
                <canvas class="chart" id="line-chart" style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
              </div>
              <!-- /.card-body --> 
            </div>
            <!-- /.card -->
          </div> --}}
          <!-- col  -->

        </div>
      </div>
      <!-- container fluid -->
    </section>
    <!-- maincontent -->
  <!-- Control Sidebar -->
    </div>
    
@endsection

@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/apex/apexcharts.min.js') !!}
    {!! Html::script('plugins/flatpickr/flatpickr.js') !!}
    {!! Html::script('assets/js/dashboard/dashboard_1.js') !!}
@endpush

@push('custom-scripts')
<script>
      
  $('#table-recent').DataTable();
</script>
@endpush

