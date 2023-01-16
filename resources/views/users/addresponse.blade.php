@extends('layouts.master')

@push('plugin-styles')
    {{-- {!! Html::style('assets/css/loader.css') !!} --}}
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
                            
                          <li class="breadcrumb-item" aria-current="page"><span> {{__('Department')}}</span></li>
                            <li class="breadcrumb-item active" aria-current="page"><span>{{__('Add Response') }}</span></li>
                        </ol>
                    </nav>
                </div>
            </li>
        </ul>
    </header>
  </div>
  <!--  Navbar Ends / Breadcrumb Area  -->

        <form method="POST" action=""></form>
        {{-- Modal cancel --}}

        <div class="modal fade modal-success" id="modal-cancel">
          <div class="modal-dialog modal-m">
            <div class="modal-content bg-light">
              <div class="modal-header">
                <h5 class="modal-title">Cancel Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
                </button>
              </div>
              <div class="modal-body">
                <form method="POST" action="{{ route('department.cancel') }}">
                  @csrf
                  <input type="hidden" value="{{ $requests->id }}" name="id_request"/>
                    @error('id_request')
                      <span class="text-danger text-sm">{{ $message }}</span>                              
                    @enderror
                   <div class="form-group">
                    <label for="exampleSelectRounded0">Cancel Reason</label>
                    <textarea class="form-control m-l-1 m-r-1" rows="2" placeholder="Enter description ..." name="description"></textarea>
                      @error('description')
                      <span class="text-danger text-sm">{{ $message }}</span>                              
                      @enderror
                  </div>
      
              </div>
              
              <div class="modal-footer justify-content-between">
                  <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
                  <button type="submit" class="btn btn-danger">Submit</button>                                    
              </div>
            </form>
            </div>
          </div>
        </div>


        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
           
            <!-- /.col -->
            <div class="col-md-12">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                   
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Add Response</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                    <div class=" tab-pane" id="activity">
                      <!-- Post -->
                      <div class="post">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="{{ URL::asset('backend/img/ava.png') }}" alt="user image">
                          <span class="username">
                            <a href="#">Jonathan Burke Jr.</a>
                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                          </span>
                          <span class="description">Shared publicly - 7:30 PM today</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                          Lorem ipsum represents a long-held tradition for designers,
                          typographers and the like. Some people hate it and argue for
                          its demise, but others ignore the hate as they create awesome
                          tools to help create filler text for everyone from bacon lovers
                          to Charlie Sheen fans.
                        </p>
  
                        <p>
                          <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                          <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                          <span class="float-right">
                            <a href="#" class="link-black text-sm">
                              <i class="far fa-comments mr-1"></i> Comments (5)
                            </a>
                          </span>
                        </p>
  
                        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                      </div>
                      <!-- /.post -->
  
                      <!-- Post -->
                      <div class="post clearfix">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="../../dist/img/user7-128x128.jpg" alt="User Image">
                          <span class="username">
                            <a href="#">Sarah Ross</a>
                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                          </span>
                          <span class="description">Sent you a message - 3 days ago</span>
                        </div>
                        <!-- /.user-block -->
                        <p>
                          Lorem ipsum represents a long-held tradition for designers,
                          typographers and the like. Some people hate it and argue for
                          its demise, but others ignore the hate as they create awesome
                          tools to help create filler text for everyone from bacon lovers
                          to Charlie Sheen fans.
                        </p>
  
                        <form class="form-horizontal" method="POST" action="{{ Route('dashboard') }}">
                            @csrf
                          <div class="input-group input-group-sm mb-0">
                            <input class="form-control form-control-sm" placeholder="Response">
                            <div class="input-group-append">
                              <button type="submit" class="btn btn-danger">Send</button>
                            </div>
                          </div>
                        </form>
                      </div>
                      <!-- /.post -->
  
                      <!-- Post -->
                      <div class="post">
                        <div class="user-block">
                          <img class="img-circle img-bordered-sm" src="../../dist/img/user6-128x128.jpg" alt="User Image">
                          <span class="username">
                            <a href="#">Adam Jones</a>
                            <a href="#" class="float-right btn-tool"><i class="fas fa-times"></i></a>
                          </span>
                          <span class="description">Posted 5 photos - 5 days ago</span>
                        </div>
                        <!-- /.user-block -->
                        <div class="row mb-3">
                          <div class="col-sm-6">
                            <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                          </div>
                          <!-- /.col -->
                          <div class="col-sm-6">
                            <div class="row">
                              <div class="col-sm-6">
                                <img class="img-fluid mb-3" src="../../dist/img/photo2.png" alt="Photo">
                                <img class="img-fluid" src="../../dist/img/photo3.jpg" alt="Photo">
                              </div>
                              <!-- /.col -->
                              <div class="col-sm-6">
                                <img class="img-fluid mb-3" src="../../dist/img/photo4.jpg" alt="Photo">
                                <img class="img-fluid" src="../../dist/img/photo1.png" alt="Photo">
                              </div>
                              <!-- /.col -->
                            </div>
                            <!-- /.row -->
                          </div>
                          <!-- /.col -->
                        </div>
                        <!-- /.row -->
  
                        <p>
                          <a href="#" class="link-black text-sm mr-2"><i class="fas fa-share mr-1"></i> Share</a>
                          <a href="#" class="link-black text-sm"><i class="far fa-thumbs-up mr-1"></i> Like</a>
                          <span class="float-right">
                            <a href="#" class="link-black text-sm">
                              <i class="far fa-comments mr-1"></i> Comments (5)
                            </a>
                          </span>
                        </p>
  
                        <input class="form-control form-control-sm" type="text" placeholder="Type a comment">
                      </div>
                      <!-- /.post -->
                    </div>
                      
                    <div class="active tab-pane" id="settings">
                      <b>{{ $id_req->description }}</b>
                      <div class="text-center">
                        <img src="{{ asset('storage/img_progress/'.$id_req->image) }}" class="rounded"/>
                      </div>
                      <form class="form-horizontal" method="POST" action="{{ route('department.create_response') }}">
                        @csrf
                        <p></p>
                        <div class="row">
                          <div class="col-sm">
                            <label for="name" >Response</label>
                              <input type="hidden" value="{{ $requests->id }}" name="response_req"/>
                              <input type="text" class="form-control" id="response" name="response" placeholder="Input Response Here">
                              @error('response')
                              <span class="text-danger text-sm">{{ $message }}</span>                              
                              @enderror
                          </div>
                          <div class="col-sm">
                            <label for="name" >Target Completion (Working days)</label>
                            <input type="number" class="form-control" id="target_hari" name="target_hari" value="7" placeholder="1 day/ 2 day/ etc">
                            @error('response')
                            <span class="text-danger text-sm">{{ $message }}</span>                              
                            @enderror
                          </div>
                        </div>
                        
                        <div class="form-group row mt-3 ml-2">
                          <button type="submit" class="btn btn-success">Submit</button>
                            <button type="button" class="btn btn-danger ml-3" data-toggle="modal" data-target="#modal-cancel">Cancel Request</button>
                          <div class="offset-sm-2 col-sm-10">
                            
                          </div>
                        </div>
                      </form>
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
