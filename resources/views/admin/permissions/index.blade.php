@extends('layouts.admin')

@section('title')
    Dashboard || Admin
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
                            <li class="breadcrumb-item">Manage Permissions</li>
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
                
                
                <div class="col-12">
                    <!-- Default box -->
                    <div class="card">
                    <div class="card-header bg-gradient-success">
                        <h3 class="card-title ">Permissions Access</h3>

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
                      <form method="POST" action="{{ route('admin.roles.index') }}" >
                        @csrf
                        @method('PUT')
                      </form>
                        <a type="button"  href="{{ route('admin.permissions.create') }}"class="btn-sm jestify-end btn-success btn-flat"><i class="fa fa-plus"></i> Create Permission</a>
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
                          @foreach ($permissions as $permission)
                            <tr>
                              <td>{{ $loop->index+1 }}</td>
                              <td>{{ $permission->name }}</td>
                              <td>
                                <form method="POST" action="{{ route('admin.permissions.destroy', $permission->id) }}" onsubmit="return confirm('Delete this permission?');">
                                  @csrf
                                  @method('DELETE')
                                <a href="{{ route('admin.permissions.edit', $permission->id) }}" type="button" class="btn-sm btn-primary btn-flat"><i class="fa fa-edit"></i> Edit</a>
                                <button type="submit" class=" btn-sm btn-danger"><i class="fa fa-trash"></i></button>
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
