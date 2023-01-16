@extends('layouts.admin')

@section('title')
    Roles || Create
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
                            <li class="breadcrumb-item active">Create</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
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

                        {{-- Form create --}}
                            <form action="{{ route('admin.roles.store') }}" method="POST">
                                @csrf
                                {{ csrf_field() }}
                                <div class="form-group">
                                    <label for="name">Role Name </label>
                                    <input type="text" id="name" name="name" class="form-control" placeholder="Role Name"/>
                                    <p></p>
                                </div>
                                <button class="btn btn-outline-success btn-block"><i class="fa fa-plus"></i> SUBMIT</button>
                            </form>
                        {{-- end form --}}
                    </div>
                    <!-- /.card-body --> 
                    </div>
                    <!-- /.card -->
                </div>
                <!-- col  -->
                </div>
                {{-- row --}}
            </div>
        <!-- container fluid -->
        </section>
        <!-- maincontent -->
  <!-- Control Sidebar -->
    </div>
@endsection
