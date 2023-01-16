@extends('layouts.admin')

@section('title')
    Roles || Admin
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
                            <li class="breadcrumb-item">Manage Roles</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
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
            </div><!-- /.container-fluid -->
        </div>
        <!-- /.content-header -->

        <!-- Main content -->
        <section class="content">
            <div class="container-fluid">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                
                  <form method="POST" action="{{ route('admin.roles.index') }}" >
                    @csrf
                    @method('PUT')
                  </form>
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                    <div class="card-header bg-gradient-success">
                        <h3 class="card-title ">Roles Access</h3>

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
                      <a type="button" href="{{ route('admin.roles.create') }}" class="btn-sm jestify-end btn-success btn-flat">
                        <i class="fa fa-plus"></i> Create Role</a>
                      <p></p>
                      {{-- Table --}}
                      <table class="table table-bordered">
                        <thead>
                          <tr>
                            <th style="width: 10px">#</th>
                            <th>Name</th>
                            <th style="width: 200px;">Action</th>
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
                                  <a href="{{ route('admin.roles.edit', $role->id) }}" class="btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i></a>
                                
                                  <button type="submit" class=" btn-sm btn-danger"><i class="fa fa-trash"></i></button>
                                </form>
                              </td>
                            </tr>
                          @endforeach
                        
                        </tbody>
                      </table>
                      {{-- end table --}}
                    </div>
                    <!-- /.card-body --> 
                    </div>
                    <!-- /.card -->
                </div>
                <!-- col  -->

                

                </div>
            </div>
        <!-- container fluid -->
        </section>
        <!-- maincontent -->
  <!-- Control Sidebar -->
    </div>
@endsection

@section('title')
    Timeline
@endsection
