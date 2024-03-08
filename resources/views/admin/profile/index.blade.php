@extends('layouts.master')


@push('plugin-styles')
    {{-- {!! Html::style('assets/css/loader.css') !!} --}}
    {!! Html::style('plugins/apex/apexcharts.css') !!}
    {!! Html::style('assets/css/dashboard/dashboard_1.css') !!}
    {!! Html::style('plugins/flatpickr/flatpickr.css') !!}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('assets/css/elements/tooltip.css') !!}
    {!! Html::style('assets/css/ui-elements/loading-spinners.css') !!}
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
                              
                            <li class="breadcrumb-item" aria-current="page"><span> {{__('Profile')}}</span></li>
                              <li class="breadcrumb-item active" aria-current="page"><span> {{Auth::user()->name }}</span></li>
                          </ol>
                      </nav>
                  </div>
              </li>
          </ul>
      </header>
    </div>
    <!--  Navbar Ends / Breadcrumb Area  -->

        <form method="POST">
          @csrf
        </form>
        <!-- Main content -->
    <section class="content">
        <div class="container-fluid">
          <div class="row">
            <div class="col-md-3">
  
              <!-- Profile Image -->
              <div class="card card-success card-outline">
                <div class="card-body box-profile">
                  <div class="text-center">
                    <a href="#" id="OpenImgUpload">

                      @if (Auth::user()->image == 'avatar.png')
                      <img class="profile-user-img img-fluid img-circle" id="preview-image-before-upload"
                          src="{{ URL::asset('backend/img/avatar.png') }}"
                          alt="User profile picture"></a>
                      @else
                          <img class="profile-user-img img-fluid img-circle img-round" id="preview-image-before-upload"
                            src="{{asset('storage/profile/'.Auth::user()->image)}}"
                            alt="User profile picture"></a>
                      @endif
                      @if (Auth::user()->image === 'avatar.png')
                          
                      @else

                      @endif
                    
                  </div>
  
                  <h3 class="profile-username text-center">{{ Auth::user()->name }}</h3>
  
                  <p class="text-muted text-center">{{ Auth::user()->email }}</p>
  
                  <form method="POST" action="{{ route('update_pass') }}">
                    @csrf
                    @foreach ($errors->all() as $error)
                            <span class="text-danger">{{ $error }}</span>
                    @endforeach
                    
                    <div class="form-group">
                      <input type="password" name="current_password" class="form-control" id="old_pass" placeholder="Old Password" autocomplete="current-password"/>
                    </div>
                    <div class="form-group">
                      <input type="password" name="new_password" class="form-control" id="new_pass" placeholder="New Password" autocomplete="current-password"/>
                    </div>
                    <div class="form-group">
                      <input type="password" name="new_confirm_password" class="form-control" id="old_pass" placeholder="Confirm Password" autocomplete="current-password"/>
                    </div>
                    
                  
                  <p></p>
                  <button type="submit" class="btn btn-success btn-block">Update Password</button>
                </form>
                <input type="file" id="imgupload" style="display:none"/> 
                </div>
                <!-- /.card-body -->
              </div>
              <!-- /.card -->
  
              
              <!-- /.card -->
            </div>
            <!-- /.col -->
            <div class="col-md-9">
              <div class="card">
                <div class="card-header p-2">
                  <ul class="nav nav-pills">
                   
                    <li class="nav-item"><a class="nav-link active" href="#settings" data-toggle="tab">Update Profile</a></li>
                  </ul>
                </div><!-- /.card-header -->
                <div class="card-body">
                  <div class="tab-content">
                   
                    <div class="active tab-pane" id="settings">
                      <form action="javascript:void(0)" id="form_update_profile" name="form_update_profile" method="POST" enctype="multipart/form-data" >
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="file" class="form-control" id="img_user" name="img_user" placeholder="Profil">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName" class="col-sm-2 col-form-label">Name</label>
                          <div class="col-sm-10">
                            <input type="text" value="{{ Auth::user()->name }}" class="form-control" id="name" name="name" placeholder="Name">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputEmail" class="col-sm-2 col-form-label">Email</label>
                          <div class="col-sm-10">
                            <input type="email" value="{{ Auth::user()->email }}" class="form-control" id="inputEmail" placeholder="Email">
                          </div>
                        </div>
                        <div class="form-group row">
                          <label for="inputName2" class="col-sm-2 col-form-label">No HP</label>
                          <div class="col-sm-10">
                            <input type="number" value="{{ Auth::user()->nohp }}" class="form-control" id="nohp" placeholder="Phone Number" name="nohp">
                          </div>
                        </div>
                        
                        
                        <div class="form-group row">
                          <div class="offset-sm-2 col-sm-10">
                            <div class="loading-container" id="load-req" style="display: none;">
                              <div class="dots-one">
                                  <span></span>
                                  <span></span>
                                  <span></span>
                                  <span></span>
                              </div>
                            </div>
                            <button type="submit" class="btn btn-success btn-save-profile" id="btn-save-profile">Save</button>
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


@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
@endpush

@push('custom-scripts')
  <script>

    var SITEURL = '{{URL::to('')}}';
    $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
          }
    });

    $('#OpenImgUpload').click(function(){ $('#imgupload').trigger('click'); });

    $(document).ready(function (e) {
 
      $('#img_user').change(function(){
      let reader = new FileReader();
      reader.onload = (e) => { 
        $('#preview-image-before-upload').attr('src', e.target.result); 
      }

      reader.readAsDataURL(this.files[0]); 
   });
  });

  // update profile
  $('#form_update_profile').submit(function(e) {
        document.getElementById('load-req').style.display = 'block';
        document.getElementById('btn-save-profile').style.display = 'none';
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('update_profile')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            document.getElementById('load-req').style.display = 'none';
            document.getElementById('btn-save-profile').style.display = 'block';       
                
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Update Successfully',
                    showConfirmButton: false,
                    timer: 3000
                });  
            
        },
            error: function(data){
              document.getElementById('load-req').style.display = 'none';
              document.getElementById('btn-save-profile').style.display = 'block';
              console.log(data);
            }
        })
  });
  </script>
@endpush