@extends('layouts.master')

@push('plugin-styles')
    {{-- {!! Html::style('assets/css/loader.css') !!} --}}
    {!! Html::style('plugins/flatpickr/flatpickr.css') !!}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('assets/css/elements/tooltip.css') !!}
@endpush

@section('content')

  <div class="content-wraper">


  </div>
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
                            
                          <li class="breadcrumb-item" aria-current="page"><span> {{__('Report')}}</span></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{__('Monthly') }}</span></li>
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
        
                  <a href="{{ route('admin.export_month') }}" class="btn btn-sm bg-gradient-success text-white mb-2" target="_blank"><i class="las la-file-export"></i> Export Excel</a>
                    <table class="table table-hover" id="table-month">
                        <thead>
                          <tr>
                            <th>Tenant </th>
                            <th>Department</th>
                            <th>Description</th>
                            <th>Date Requests</th>
                            <th>Date finish</th>
                            <th class="no-content"></th>
                          </tr>
                        </thead>
                        <tbody>
                          @foreach ($data as $req)
                          <tr>
                            <td>{{ $req->name }}</td>
                            <td>{{ $req->department }}</td>
                            <td>{{ $req->description }}</td>
                            <td>{{ date('d M Y', strtotime($req->created_at)); }}</td>
                            <td>
                              @if ($req->created_at == $req->updated_at)
                                  N/A
                              @else
                              {{ date('d M Y', strtotime($req->updated_at)); }} 
                              @endif
                              
                            </td>
                            <td>
                              <a href="{{ route('admin.admin.cetak_request',$req->id) }}" class="btn btm-sm bg-gradient-warning text-white"><i class="lar la-file-pdf"></i> Print</a>
                            </td>
                          </tr>
                          @endforeach
                        

                        </tbody>
                    </table>
                    {{ $data->links('pagination::bootstrap-5') }}
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
   
@endsection





