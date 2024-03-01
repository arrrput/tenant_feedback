@extends('layouts.master')

@push('plugin-styles')
    {!! Html::style('assets/css/ui-elements/breadcrumbs.css') !!}
    {!! Html::style('plugins/table/datatable/datatables.css') !!}
    {!! Html::style('plugins/table/datatable/dt-global_style.css') !!}
@endpush


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
                            
                            <li class="breadcrumb-item active" aria-current="page"><span> {{__('User Management')}}</span></li>
                        </ol>
                    </nav>
                </div>
            </li>
        </ul>
    </header>
</div>
<!--  Navbar Ends / Breadcrumb Area  -->
  <!-- Content Header (Page header) -->
  <div class="content-header">
      <div class="container-fluid">

        @if ($message = Session::get('success'))
        <div class="alert alert-success">
          <p>{{ $message }}</p>
        </div>
        @endif
        @if (session('status'))
          <div class="alert alert-primary alert-dismissible fade show" role="alert">
             {{ session('status') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif
          @if (session('message'))
          <div class="alert alert-danger alert-dismissible fade show" role="alert">
             {{ session('message') }}.
            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          @endif

         
        <div class="col-12">
          <div class="card card-success">
            {{-- card header --}}
            <div class="card-header">
              <h6 class="card-title">Users Management</h6>
            </div>
            {{-- end card header --}}

            <div class="card-body">
              <div class="row">
                <div class="col-lg-12 margin-tb">
      
                    <div class="pull-right">
                        <a class="btn bg-gradient-success btn-sm text-white mb-3" href="{{ route('admin.user_management.create') }}"> Create New User</a>
                    </div>

                    <table class="table table-hover">
                      <tr>
                        <th>No</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th width="280px">Action</th>
                      </tr>
                      @php
                        $no =1;
                      @endphp
                      @foreach ($data as $key => $user)
                       <tr>
                         <td>{{ $no }}</td>
                         <td>{{ $user->name }}</td>
                         <td>{{ $user->email }}</td>
                         <td>
                           @if(!empty($user->getRoleNames()))
                             @foreach($user->getRoleNames() as $v)
                                <label class="badge badge-success">{{ $v }}</label>
                             @endforeach
                           @endif
                         </td>
                         <td>
                            <a class="btn btn-primary" href=" {{ route('admin.user.edit',$user->id) }} ">Edit</a>
                             <a class="btn btn-danger" href=" route('users.destroy',$user->id) "> Delete</a>
                         </td>
                       </tr> @php $no++ @endphp
                      @endforeach
                     </table>
                </div>
            </div>
          </div>
        </div>
          
          
      </div><!-- /.container-fluid -->
  </div>
  </div>
</div>

 

@endsection 


@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/table/datatable/datatables.js') !!}
@endpush


@push('custom-scripts')


@endpush