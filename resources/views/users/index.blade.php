@extends('layouts.master')

@section('title')
    {{ Auth::user()->name}} |
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
                              
                              <li class="breadcrumb-item active" aria-current="page"><span> {{__('User Request')}}</span></li>
                          </ol>
                      </nav>
                  </div>
              </li>
          </ul>
      </header>
    </div>
  <!--  Navbar Ends / Breadcrumb Area  -->

        <form method="POST">
         
        </form>

        

        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <!-- Small boxes (Stat box) -->
          <div class="row">
            <!-- ./col -->
            <div class="col-12">
              <div class="card card-success">
                <div class="card-header">
                  <h6>List Request</h6>
  
                </div>
                <div class="card-body">
                  <table class="table table-hover" id="table-list">
                    <thead>
                      <tr>
                        <th style="width: 19px">#</th>
                        <th>Name</th>
                        <th style="width: 200px;">Description</th>
                        <th>Location</th>
                        <th>No Unit</th>
                        <th>Date</th>
                        <th style="width: 200px;">status</th>
                      </tr>
                    </thead>
                    <tbody>
                      @foreach ($req_user as $req)
                      <tr>
                          <td>
                            @if ($req->progress_request ==1)
                            <a href="{{route('department.addresponse', $req->id) }}">
                              <span class="badge bg-primary"><i class="las la-eye"></i></span></a>
                            @elseif ($req->progress_request ==2)
                            <a href="{{route('department.addprogress', $req->id) }}">
                              <span class="badge bg-primary"><i class="las la-eye"></i></span></a>
                            @elseif ($req->progress_request ==3)
                            <a href="{{route('department.addprogress', $req->id) }}" data-toggle="modal" data-target="#modal-sm">
                              <span class="badge bg-primary"><i class="las la-spinner"></i></span></a>
                            <div class="modal fade modal-success" id="modal-sm">
                              <div class="modal-dialog modal-m">
                                <div class="modal-content bg-light">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Confirmation</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    <form method="POST" action="{{ route('department.finish') }}" enctype="multipart/form-data">
                                      @csrf
                                      <input type="hidden" value="{{ $req->id }}" name="id_request"/>
                                        @error('id_request')
                                          <span class="text-danger text-sm">{{ $message }}</span>                              
                                        @enderror
                                      <input type="hidden" value="{{ Auth::user()->id }}" name="id_user"/>
                                          @error('id_user')
                                            <span class="text-danger text-sm">{{ $message }}</span>                              
                                          @enderror
                                      <div class="form-group">
                                        <label for="exampleSelectRounded0">Feedback Summary </label>
                                        <textarea class="form-control m-l-1 m-r-1" rows="2" placeholder="Enter description ..." name="description"></textarea>
                                          @error('description')
                                          <span class="text-danger text-sm">{{ $message }}</span>                              
                                          @enderror
                                      </div>
                                      <div class="form-group">
                                        <label for="exampleSelectRounded0">Upload Image</label>
                                        <input type="file" class="form-control" name="image"/>
                                        @error('image')
                                        <span class="text-danger text-sm">{{ $message }}</span>                              
                                        @enderror
                                      </div>
                                    <p>Are you sure to finish this request?</p>
                                  </div>
                                  
                                  <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                                      <button type="submit" class="btn btn-success">Submit</button>                                    
                                  </div>
                                </form>
                                </div>
                              </div>
                            </div>
                            @elseif ($req->progress_request ==4)
                            <a href="{{ route('department.timeline', $req->id) }}">
                              <span class="badge bg-success"><i class="las la-check green-text"></i></span>
                            </a>
                                 
                            @elseif ($req->progress_request == 5)
                            <a href="" data-toggle="modal" data-target="#modal-{{ $req->id }}"><span class="badge bg-danger"><i class="las la-ban "></i></span></a>

                            <div class="modal fade modal-success" id="modal-{{ $req->id }}">
                              <div class="modal-dialog modal-m">
                                <div class="modal-content bg-light">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Rejected</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    {{ $req->cancel }}
                                </div>
                              </div>
                            </div>
                          @endif
                            
                          </td>
                          <td>{{ $req->name }}</td>
                          <td>{{ $req->description }}</td>
                          <td>{{ $req->lokasi }}</td>
                          <td>{{ $req->no_unit }}</td>
                          <td> {{ date('d M Y', strtotime($req->created_at)); }}</td>
                          <td>
                            @if ($req->progress_request ==1)
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-danger" style="width: 25%"></div>
                              </div>Request was delivery</td>
                            </div>
                            @endif
  
                            @if ($req->progress_request ==2)
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-warning" style="width: 40%"></div>
                              </div>On Response</td>
                            </div>
                            @endif
  
                            @if ($req->progress_request ==3)
                            <div class="progress progress-xs">
                              <div class="progress-bar bg-primary" style="width: 75%"></div>
                              </div>On Progress</td>
                            </div>
                            @endif
                            
                            <?php $rate = DB::select("select * from rate where id_request ='$req->id' limit 1");
                              $size = count($rate);
                            ?>
                            
                            @if ($req->progress_request ==4)

                              @if ($size > 0)
                              <span class="las la-star <?php if($rate[0]->rate_point >=1){ echo 'text-warning';} ?>"></span>
                                <span class="las la-star <?php if($rate[0]->rate_point >=2){ echo 'text-warning';} ?>"></span>
                                <span class="las la-star <?php if($rate[0]->rate_point >=3){ echo 'text-warning';} ?>"></span>
                              
                              @else
                              <div class="progress progress-xs">
                                <div class="progress-bar bg-primary" style="width: 100%"></div>
                                </div>Finish</td>
                              </div>
                              @endif
                            
                            @endif
                             
                            @if ($req->progress_request ==5)
                            <span class=" badge bg-danger">Request Rejected</span>
                            @endif
                          </td>
                      </tr>   
                      @endforeach
                        
                      </tr>
                    </tbody>
                  </table>
                  
                
                </div>
              </div>
            </div>
            <!-- ./col -->        
  
            
  
          </div>
        </div>
        <!-- container fluid -->
      </section>
      <!-- maincontent -->
    </div>
    @endsection