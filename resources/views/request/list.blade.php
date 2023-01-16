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
                              
                              <li class="breadcrumb-item" aria-current="page"><span> {{__('Request')}}</span></li>
                              <li class="breadcrumb-item active" aria-current="page"><span> {{__('List')}}</span></li>
                          </ol>
                      </nav>
                  </div>
              </li>
          </ul>
      </header>
  </div>
  <!--  Navbar Ends / Breadcrumb Area  -->

    <form method="POST" action="">
      @csrf
    </form>
    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">
        <!-- Small boxes (Stat box) -->

        <div class="row">
          <!-- ./col -->
          <div class="col-12">
            
          </div>
          <div class="col-12">
            <div class="card card-success">
              <div class="card-header">
                <h6 class="card-title"><i class="las la-table text-primary"></i> My Request</h6>
              </div>
              <div class="card-body">
                <table class="table" id="table-list">
                  <thead>
                    <tr>
                      <th style="width: 19px">#</th>
                      <th>Description</th>
                      <th>Department</th>
                      <th>Relevant Part</th>
                      <th>Date</th>
                      <th style="width: 120px;">status</th>
                      <th>Verifications</th>
                    </tr>
                  </thead>
                  <tbody>
                    @foreach ($u as $req)
                    <tr>
                        <td>
                          @if ($req->progress_request ==5)
                           
                             <a href="#"><span class="badge bg-danger" data-toggle="modal" data-target="#modal-{{ $req->id }}" value="x">
                              <i class=" las la-ban"></i></a>
                            <div class="modal fade modal-success" id="modal-{{ $req->id}}">
                              <div class="modal-dialog modal-m">
                                <div class="modal-content bg-light">
                                  <div class="modal-header">
                                    <h5 class="modal-title">Cancel Request</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                      <span aria-hidden="true">&times;</span>
                                    </button>
                                  </div>
                                  <div class="modal-body">
                                    
                                      {{ $req->cancel }}


                                  </div>
                                  
                                  <div class="modal-footer justify-content-between">
                                      <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>                                 
                                  </div>
                                </div>
                              </div>
                            </div>
                          @else
                          <a href="{{ route('request.timeline', $req->id) }}"><i class="las la-eye green-text"></i>
                          </a>
                          @endif
                        </td>
                        <td>{{ $req->description }}</td>
                        <td>{{ $req->dept }}</td>
                        <td>{{ $req->name }}</td>
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

                          @if ($req->progress_request ==4)
                          <div class="progress progress-xs">
                            <div class="progress-bar bg-success" style="width: 100%"></div>
                            </div>Finish</td>
                          </div>
                          @endif

                          @if ($req->progress_request ==5)
                          
                            <span class="badge bg-danger"> Request Rejected</span>
            
                          @endif
                           
                        </td>
                        <td>
                          
                          @if ($req->progress_request == 4)
                              {{-- {{ $rate= DB::table('rate')
                              ->select('rate_point as rating')
                              ->where('id_request','=',$req->id)
                              ->first() }} --}}
                              <?php $rate = DB::select("select * from rate where id_request ='$req->id' limit 1");
                                $size = count($rate);
                              ?>
                              @if ($size > 0)
                                <span class="las la-star  <?php if($rate[0]->rate_point >=1){ echo 'text-warning';} ?>"></span>
                                <span class="las la-star <?php if($rate[0]->rate_point >=2){ echo 'text-warning';} ?>"></span>
                                <span class="las la-star <?php if($rate[0]->rate_point >=3){ echo 'text-warning';} ?>"></span>
                              @else
                              <a href="#">
                                {{-- <button class="btn-sm btn-success" data-toggle="modal" data-target="#modal-rate{{ $req->id }}" value="x">Rate Us</button> --}}
                                <button class="btn btn-sm bg-gradient-warning text-white" id="rateModal" data-id="{{ $req->id }}"><i class="las la-check-circle"></i>Verification</button>
                              </a>

                              
                              @endif
                            
                          
                          @else
                            <span class="badge bg-gradient-danger text-white">Stil Prosess</span>
                            
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

    {{-- Moodal sekses --}}
    <div class="modal fade modal-success" id="ajaxsukses">
      <div class="modal-dialog modal-m">
        <div class="modal-content bg-success">
          <div class="modal-header">
            <h5 class="modal-title">Verification Success</h5>
          </div>
          <div class="modal-body">
              <p>Thank you for your feedback :)</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-light btn-reload" data-dismiss="modal">Close</button>                              
        </div>
        </div>
      </div>
    </div>


  {{-- Moodal verify --}}
    <div class="modal fade " id="ajaxVerify">
      <div class="modal-dialog modal-m">
        <div class="modal-content bg-success">
          <div class="modal-header">
            <h5 class="modal-title">Verification</h5>
          </div>
          <div class="modal-body">
              <p id="id_req" hidden="true"></p>
              <p>Verify this Request?</p>
          </div>
          <div class="modal-footer justify-content-between">
            <button type="button" class="btn btn-light" data-dismiss="modal">Close</button> 
            <button type="button" class="btn btn-light btn-verify" >Verify</button>                                 
        </div>
        </div>
      </div>
    </div>

    {{-- Modal Rating --}}
    
    <div class="modal fade modal-success" id="ratingModal">
      <div class="modal-dialog modal-m">
        <div class="modal-content bg-light">
          <div class="modal-header">
            <h5 class="modal-title">Rate Us</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

                  <div class="stars" name="stars" id="stars">            
                    <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                    <label class="star star-3" for="star-3"></label>
                    <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                    <label class="star star-2" for="star-2"></label>
                    <input class="star star-1" id="star-1" type="radio" name="star" value="1"/>
                    <label class="star star-1" for="star-1"></label>
                </div>
              <div class="form-group">
                <label for="exampleSelectRounded0">Please give your feedback </label>
                <textarea class="form-control m-l-1 m-r-1" rows="2" placeholder="Enter Feedback ..." name="feedbackUser" id="feedbackUser"></textarea>
                  
              </div>
              
          </div>
          
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success btn-rating">Submit</button>                                    
          </div>
        </form>
        </div>
      </div>
    </div>
    <!-- maincontent -->
  <!-- Control Sidebar -->
  </div>
@endsection

@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/table/datatable/datatables.js') !!}
@endpush


@push('custom-scripts')
  <script>

  var SITEURL = '{{URL::to('')}}';
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
    $(document).ready(function () {
    

    var id_req;
    let star_value = 0;

    $('#table-list').DataTable();

 
   /* When click show modal verify */
    $('body').on('click', '#rateModal', function () {
      id_req = $(this).data('id');
      const element = document.getElementById("id_req");
      element.innerHTML = id_req;
      $('#ajaxVerify').modal('show');

   });
   
    /* button verify verify */
    $(".btn-verify").click(function(e){
  
      e.preventDefault();

      // var name = $("input[name=name]").val();
      // var password = $("input[name=password]").val();
      // var email = $("input[name=email]").val();
      let name = $("input[name=feedbackUser]").val();

      $.ajax({
        type:'POST',
        url:"{{ route('request.verify') }}",
        data:{id:id_req},
        success:function(data){
           //alert(data.success);
            $('#ajaxVerify').modal('hide');
            $('#ratingModal').modal('show');
        }
      });

    });

    /* button verify verify */
    $(".btn-rating").click(function(e){
  
      e.preventDefault();

      let id_user = {{ Auth::user()->id }}
      let desc = $("#feedbackUser").val();
      let rate = star_value;
      let _token   = $('meta[name="csrf-token"]').attr('content');
      $.ajax({
        type:'POST',
        url:"{{ route('request.rateus') }}",
        data:{id_req:id_req, id_user:id_user,rate:rate,message:desc},
        _token : _token,
        success:function(data){
          console.log('feedback success');
          $('#ratingModal').modal('hide');
          $('#ajaxsukses').modal('show');

        }
      });

    });

    $("#star-3").click(function(e){
      star_value = 3;
    });

    $("#star-2").click(function(e){
      star_value = 2;
    });

    $("#star-1").click(function(e){
      star_value = 1;
    });

    $(".btn-reload").click(function(e){
        location.reload();
    });
  });
  </script>
@endpush