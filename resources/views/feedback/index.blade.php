@extends('layouts.admin')

@section('Profile')
    Tenant Feedback
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
                            <li class="breadcrumb-item active">Tenant Feedback</li>
                        </ol>
                    </div><!-- /.col -->
                </div><!-- /.row -->
                @if (session('message'))
                    <div class="alert alert-primary alert-dismissible fade show" role="alert">
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
          <div class="row">
           
            <!-- /.col -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                   
                    <li class="nav-item"><a class="nav-link active" href="#feedback3" data-toggle="tab">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link " href="#feedback2" data-toggle="tab">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star "></span>
                        </a>
                    </li>
                    <li class="nav-item"><a class="nav-link " href="#feedback1" data-toggle="tab">
                        <span class="fa fa-star checked"></span>
                        <span class="fa fa-star "></span>
                        <span class="fa fa-star "></span>
                        </a>
                    </li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class="active tab-pane" id="feedback3">
                      <!-- Post -->
                      <table class="table table-hover" id="table-list">
                          <thead>
                            <tr>
                              <th>No</th>
                              <th>Tenant</th>
                              <th>Respon Tenant</th>
                              <th>Request Description</th>
                              <th>Date</th>
                            </tr>
                          </thead>
                          <tbody>
                              <?php $no=0; ?>
                            @foreach ($feedback3 as $feedback )
                            <?php $no++; ?>
                            <tr>
                                <td>{{ $no }}</td>
                                <td>{{ $feedback->name }}</td>
                                <td>{{ $feedback->message }}</td>
                                <td>{{ $feedback->description }}</td>
                                <td>{{ date('d M Y', strtotime($feedback->created_at)); }}</td>
                            </tr>
                            @endforeach
                          </tbody>
                      </table>
                    </div>
                      
                    <div class=" tab-pane" id="feedback2">
                        <table class="table table-hover" id="table-feedback2">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Tenant</th>
                                <th>Respon Tenant</th>
                                <th>Request Description</th>
                                <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $no=0; ?>
                              @foreach ($feedback2 as $feedback )
                              <?php $no++; ?>
                              <tr>
                                  <td>{{ $no }}</td>
                                  <td>{{ $feedback->name }}</td>
                                  <td>{{ $feedback->message }}</td>
                                  <td>{{ $feedback->description }}</td>
                                  <td>{{ date('d M Y', strtotime($feedback->created_at)); }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>

                    <div class=" tab-pane" id="feedback1">
                        <table class="table table-hover" id="table-feedback1">
                            <thead>
                              <tr>
                                <th>No</th>
                                <th>Tenant</th>
                                <th>Respon Tenant</th>
                                <th>Request Description</th>
                                <th>Date</th>
                              </tr>
                            </thead>
                            <tbody>
                                <?php $no=0; ?>
                              @foreach ($feedback1 as $feedback )
                              <?php $no++; ?>
                              <tr>
                                  <td>{{ $no }}</td>
                                  <td>{{ $feedback->name }}</td>
                                  <td>{{ $feedback->message }}</td>
                                  <td>{{ $feedback->description }}</td>
                                  <td>{{ date('d M Y', strtotime($feedback->created_at)); }}</td>
                              </tr>
                              @endforeach
                            </tbody>
                        </table>
                    </div>
                    <!-- /.tab-pane -->
                  </div>
                  <!-- /.tab-content -->
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
$('#table-feedback2').DataTable();
$('#table-feedback1').DataTable();
</script>
@endpush
