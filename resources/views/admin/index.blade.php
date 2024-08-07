@extends('layouts.master')

@push('plugin-styles')
    {!! Html::style('assets/css/loader.css') !!}
    {!! Html::style('plugins/apex/apexcharts.css') !!}
    {!! Html::style('assets/css/dashboard/dashboard_1.css') !!}
    {!! Html::style('plugins/flatpickr/flatpickr.css') !!}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('assets/css/elements/tooltip.css') !!}
    {!! Html::style('assets/css/apps/companies.css') !!}
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
                        
                    </div>
                </div>
                <div class="quick-category-content">
                    <h3> {{ count($tenant) }}</h3>
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
                        
                    </div>
                </div>
                <div class="quick-category-content">
                    <h3> {{ $departments }}</h3>
                    <p class="font-17 text-success-teal mb-0"> {{ __('Department') }}</p>
                </div>
            </a>
        </div>
    </div>

    <h3 class="text-primary">Basic Information</h3>
    <hr>
    <div class="row layout-spacing layout-top-spacing" id="cancel-row">
      {{-- Cardbox --}}
      <div class="col-xl-3 col-lg-4 col-md-4 mb-4">
        <div class="card single-project">
            <img src="{{ url('assets/img/company-7.jpg') }}" class="card-img-top" alt="widget-card-2">
            <div class="card-body">
                <h4 class="card-title"> {{__('Visa')}}</h4>
                <p class="card-text"> {{__('Visa dan paspor merupakan 2 dokumen penting dan wajib dimiliki apabila Anda hendak 
                melakuakn perjalanan ke luar negeri. Tanpa adanya kedua dokumen penting ini, 
                tentunya Anda akan ditolak memasuki negara tujuan oleh petugas imigrasi.')}} 
                (<b><span><a href="" class="text-blue"> {{ \Carbon\Carbon::now()->format('d M Y')}} </a></span></b>)</p>
                
                <div class="meta-info">
                    <div class="row">
                      <div class="col-6 text-right">
                        <a href="" class="btn  bg-gradient-success text-white">
                          <i class="las la-paper-plane"></i> Apply
                        </a>
                      </div>
                      <div class="col-6 text-left">
                        <a href="" class="btn  bg-gradient-warning text-white">Read More</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-4 col-md-4 mb-4">
        <div class="card single-project">
            <img src="{{ url('assets/img/company-8.jpg') }}" class="card-img-top" alt="widget-card-2">
            <div class="card-body">
                <h4 class="card-title"> {{__('Izin Lingkungan')}}</h4>
                <p class="card-text"> {{__('Visa dan paspor merupakan 2 dokumen penting dan wajib dimiliki apabila Anda hendak 
                melakuakn perjalanan ke luar negeri. Tanpa adanya kedua dokumen penting ini, 
                tentunya Anda akan ditolak memasuki negara tujuan oleh petugas imigrasi.')}} 
                (<b><span><a href="" class="text-blue"> {{ \Carbon\Carbon::now()->format('d M Y')}} </a></span></b>)</p>
                
                <div class="meta-info">
                    <div class="row">
                      <div class="col-6 text-right">
                        <a href="" class="btn  bg-gradient-success text-white">
                          <i class="las la-paper-plane"></i> Apply
                        </a>
                      </div>
                      <div class="col-6 text-left">
                        <a href="" class="btn  bg-gradient-warning text-white">Read More</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-4 col-md-4 mb-4">
        <div class="card single-project">
            <img src="{{ url('assets/img/company-5.jpg') }}" class="card-img-top" alt="widget-card-2">
            <div class="card-body">
                <h4 class="card-title"> {{__('Basic Permit')}}</h4>
                <p class="card-text"> {{__('Visa dan paspor merupakan 2 dokumen penting dan wajib dimiliki apabila Anda hendak 
                melakuakn perjalanan ke luar negeri. Tanpa adanya kedua dokumen penting ini, 
                tentunya Anda akan ditolak memasuki negara tujuan oleh petugas imigrasi.')}} 
                (<b><span><a href="" class="text-blue"> {{ \Carbon\Carbon::now()->format('d M Y')}} </a></span></b>)</p>
                
                <div class="meta-info">
                    <div class="row">
                      <div class="col-6 text-right">
                        <a href="" class="btn  bg-gradient-success text-white">
                          <i class="las la-paper-plane"></i> Apply
                        </a>
                      </div>
                      <div class="col-6 text-left">
                        <a href="" class="btn  bg-gradient-warning text-white">Read More</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>

      <div class="col-xl-3 col-lg-4 col-md-4 mb-4">
        <div class="card single-project">
            <img src="{{ url('assets/img/company-3.jpg') }}" class="card-img-top" alt="widget-card-2">
            <div class="card-body">
                <h4 class="card-title"> {{__('Passport')}}</h4>
                <p class="card-text"> {{__('Visa dan paspor merupakan 2 dokumen penting dan wajib dimiliki apabila Anda hendak 
                melakuakn perjalanan ke luar negeri. Tanpa adanya kedua dokumen penting ini, 
                tentunya Anda akan ditolak memasuki negara tujuan oleh petugas imigrasi.')}} 
                (<b><span><a href="" class="text-blue"> {{ \Carbon\Carbon::now()->format('d M Y')}} </a></span></b>)</p>
                
                <div class="meta-info">
                    <div class="row">
                      <div class="col-6 text-right">
                        <a href="" class="btn  bg-gradient-success text-white">
                          <i class="las la-paper-plane"></i> Apply
                        </a>
                      </div>
                      <div class="col-6 text-left">
                        <a href="" class="btn  bg-gradient-warning text-white">Read More</a>
                      </div>
                    </div>
                </div>
            </div>
        </div>
      </div>
      {{-- End carbox --}}

    </div>

    {{-- Table --}}
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
      <div class="widget dashboard-table">
          <div class="widget-heading">
              <h5 class=""> {{__('Recent Request')}}</h5>
          </div>
          <div class="widget-content">
              <div class="table-responsive">
                @role('admin|user')
                <table class="table">
                  <thead>
                  <tr>
                      <th><div class="no-content"> {{__('No')}}</div></th>
                      <th><div class="th-content"> {{__('Description')}}</div></th>
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
                @endrole
                  
                <?php $roles_name = Auth::user()->getRoleNames() ?>
                @if ($roles_name->first() != 'admin')
                    @role('tenant')
                    <table class="table">
                      <thead>
                      <tr>
                          <th><div class="no-content"> {{__('No')}}</div></th>
                          <th><div class="th-content"> {{__('Description')}}</div></th>
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
                    @endrole
                @endif
              </div>
          </div>
      </div>
    </div>
  </div>

  <!-- Control Sidebar -->
</div>
    
@endsection

@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/apex/apexcharts.min.js') !!}
    {!! Html::script('plugins/flatpickr/flatpickr.js') !!}
    {!! Html::script('assets/js/dashboard/dashboard_1.js') !!}
    {!! Html::script('assets/js/apps/companies.js') !!}
@endpush

@push('custom-scripts')
<script>
      
  $('#table-recent').DataTable();
</script>
@endpush

