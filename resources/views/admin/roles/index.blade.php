@extends('layouts.master')

@push('plugin-styles')
    {!! Html::style('assets/css/loader.css') !!}
    {!! Html::style('plugins/apex/apexcharts.css') !!}
    {!! Html::style('assets/css/dashboard/dashboard_1.css') !!}
    {!! Html::style('plugins/flatpickr/flatpickr.css') !!}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('assets/css/elements/tooltip.css') !!}
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
                              
                              <li class="breadcrumb-item active" aria-current="page"><span> {{__('Manage Roles')}}</span></li>
                          </ol>
                      </nav>
                  </div>
              </li>
          </ul>
        </header>
    </div>
    <!--  Navbar Ends / Breadcrumb Area  -->


    {{-- Table --}}
    <div class="col-xl-12 col-lg-12 col-md-12 col-sm-12 col-12 layout-spacing">
      <div class="widget dashboard-table">
          <div class="widget-heading">
              <h5 class=""> {{__('Roles')}}</h5>
          </div>
          <div class="widget-content">
              <div class="table-responsive">
                <a type="button" href="{{ route('admin.roles.create') }}" class="btn-sm mb-3 jestify-end btn-success btn-flat">
                  <i class="fa fa-plus"></i> Create Role</a>

                  <table class="table mt-2">
                      <thead>
                      <tr>
                          <th><div class="no-content"> {{__('#')}}</div></th>
                          <th><div class="no-content"> {{__('Role')}}</div></th>
                          <th><div class="th-content"> {{__('Action')}}</div></th>
                      </tr>
                      </thead>
                      <tbody>
                        @foreach ($roles as $role)
                            <tr>
                              <td>{{ $loop->index+1 }}</td>
                              <td>{{ $role->name }}</td>
                              <td>
                               
                                <form method="POST" action="{{ route('admin.roles.destroy', $role->id) }}" onsubmit="return confirm('Delete this role?');">
                                  @csrf
                                  @method('DELETE')
                                  <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn-sm bg-gradient-success btn-flat text-white"><i class="las la-edit"></i></a>
                                
                                  <button type="submit" class=" btn-sm  bg-gradient-danger text-white"><i class="las la-trash"></i></button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                      </tbody>
                  </table>
              </div>
          </div>
      </div>
  </div>

 
</div>
@endsection


@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/apex/apexcharts.min.js') !!}
    {!! Html::script('plugins/flatpickr/flatpickr.js') !!}
    {!! Html::script('assets/js/dashboard/dashboard_1.js') !!}
@endpush

