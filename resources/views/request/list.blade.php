@extends('layouts.master')

@push('plugin-styles')
    {!! Html::style('assets/css/dashboard/dashboard_1.css') !!}
    {!! Html::style('assets/css/ui-elements/breadcrumbs.css') !!}
    {!! Html::style('plugins/table/datatable/datatables.css') !!}
    {!! Html::style('plugins/table/datatable/dt-global_style.css') !!}
    {!! Html::style('assets/css/pages/timeline.css') !!}
    {!!  Html::style('http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') !!}

<style>
      .checked {
        color: orange;
      }    
          div.stars {
        width: 370px;
        display: inline-block;
      }
      input.star { display: none; }
      label.star {
        float: right;
        padding: 10px;
        font-size: 36px;
        color: #444;
        transition: all .2s;
      }
      input.star:checked ~ label.star:before {
        content: '\f005';
        color: #FD4;
        transition: all .25s;
      }
      input.star-5:checked ~ label.star:before {
        color: #FE7;
        text-shadow: 0 0 20px #952;
      }
      input.star-1:checked ~ label.star:before { color: #F62; }
      label.star:hover { transform: rotate(-15deg) scale(1.3); }
      label.star:before {
        content: '\f006';
        font-family: FontAwesome;
      }
</style>
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

   {{-- Maint content --}}
   <section class="content mb-5">
    <div class="container-fluid">
      <div class="widget-content widget-content-area br-12">
        <ul class="nav nav-tabs mb-2 mt-2" id="normaltab" role="tablist">
            <li class="nav-item ">
                <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true"><b> {{__('My Request')}}</b></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" id="resp-tab" data-toggle="tab" href="#resp" role="tab" aria-controls="resp" aria-selected="false"><b> {{__('Response')}}</b></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" id="progress-tab" data-toggle="tab" href="#progress" role="tab" aria-controls="progress" aria-selected="false"><b> {{__('Progress')}}</b></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" id="finish-tab" data-toggle="tab" href="#finish" role="tab" aria-controls="finish" aria-selected="false"><b> {{__('Finish')}}</b></a>
            </li>
            <li class="nav-item ">
              <a class="nav-link" id="reject-tab" data-toggle="tab" href="#reject" role="tab" aria-controls="reject" aria-selected="false"><b> {{__('Cancel')}}</b></a>
            </li>
        </ul>
        {{-- Tab content --}}
        <div class="tab-content" id="normaltabContent">
          {{-- News Request --}}
          <div class="tab-pane fade show active" id="new" role="tabpanel" aria-labelledby="new-tab">
            
            <button class="btn bg-gradient-warning text-white m-3"><i class="las la-plus"></i> Add Request</button>
            <table class="table table-hover" id="table_news">
              <thead>
                <tr>
                  <th style="width: 19px">No</th>
                  <th>Ticket</th>
                  <th>Location</th>
                  <th>Description</th>
                  <th>Relevant Part</th>
                  <th>Date</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
            
          </div>

          {{-- Response --}}
          <div class="tab-pane fade" id="resp" role="tabpanel" aria-labelledby="resp-tab">
            <h5>Response</h5>

            <table class="table table-hover" id="table_resp">
              <thead>
                <tr>
                  <th style="width: 19px">No</th>
                  <th>Ticket</th>
                  <th>Description</th>
                  <th>Department</th>
                  <th>Date</th>
                  <th>Response Admin</th>
                  <th>Est. Day</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

          {{-- Progress --}}
          <div class="tab-pane fade" id="progress" role="tabpanel" aria-labelledby="progress-tab">
            <h5>Progress</h5>

            <table class="table table-hover" id="table_progress">
              <thead>
                <tr>
                  <th style="width: 19px">No</th>
                  <th>Ticket</th>
                  <th>Location</th>
                  <th>Description</th>
                  <th>Department</th>
                  <th>Date</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

          {{-- Finish --}}
          <div class="tab-pane fade" id="finish" role="tabpanel" aria-labelledby="finish-tab">
            <h5>Finish</h5>
            <table class="table table-hover" id="table_finish">
              <thead>
                <tr>
                  <th style="width: 19px">No</th>
                  <th>Ticket</th>
                  <th>Location</th>
                  <th>Description</th>
                  <th>Correction</th>
                  <th>Root Cause</th>
                  <th>Details</th>
                  <th>#</th>
                </tr>
              </thead>
              <tbody>

              </tbody>
            </table>
          </div>

        </div>
      </div>
    </div>
   </section>

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

                <div class="widget-content">
                  <div class="table-responsive">

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
                                    <span class="las la-star <?php if($rate[0]->rate_point >=4){ echo 'text-warning';} ?>"></span>
                                    <span class="las la-star <?php if($rate[0]->rate_point >=5){ echo 'text-warning';} ?>"></span>
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
            </div>
          </div>
          <!-- ./col -->        

          

        </div>
      </div>
      <!-- container fluid -->
    </section>
    <!-- maincontent -->

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

    {{-- Modal finish request --}}
  <div class="modal fade bd-example-modal-xl" id="modal_rating" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg" role="document">      
        <form action="javascript:void(0)" id="form_finish_req" name="form_finish_req" method="POST" >                
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title block text-primary" >
                <i class="fa fa-plus"></i> 
                Feedback Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">          
            <div class="row m-3">
              <input type="hidden" name="id_rating" id="id_rating"/>
              
              <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <div class="stars" name="stars" id="stars">    
                  <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                  <label class="star star-5" for="star-5"></label>   
                  <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                  <label class="star star-4" for="star-4"></label>       
                  <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                  <label class="star star-3" for="star-3"></label>
                  <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                  <label class="star star-2" for="star-2"></label>
                  <input class="star star-1" id="star-1" type="radio" name="star" value="1" required/>
                  <label class="star star-1" for="star-1"></label>
                </div>
              </div> 

              <div class="col-lg-12 col-md-12 col-sm-12 mb-6">
                <label class="form-label text-primary">
                    Feedback <span class="text-danger">(*)</span>
                </label>
                <textarea class="form-control m-l-1 m-r-1" rows="2" placeholder="Enter Feedback ..." name="description_finish" id="description_finish" required></textarea>
            </div>  
            </div>
            
        
        </div>
        <div class="modal-footer">
            <div class="loading-container" id="load-finish" style="display: none;">
                <div class="dots-one">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <button type="submit" id="btn-save-finish" class="btn bg-gradient-success text-white">Finish Request </button>
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
        </div>
        </form>
    </div>
  </div> 


    {{-- Modal Rating --}}
    {{-- <div class="modal fade modal-success" id="ratingModal">
      <div class="modal-dialog modal-lg">
        <div class="modal-content bg-light">
          <form action="javascript:void(0)" id="form_finish_req" name="form_finish_req" method="POST" >  
          <div class="modal-header">
            <h5 class="modal-title">Rate Us</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
            </button>
          </div>
          <div class="modal-body">

            <div class="row m-3">
              <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <div class="stars" name="stars" id="stars">    
                  <input class="star star-5" id="star-5" type="radio" name="star" value="5" />
                  <label class="star star-5" for="star-5"></label>   
                  <input class="star star-4" id="star-4" type="radio" name="star" value="4"/>
                  <label class="star star-4" for="star-4"></label>       
                  <input class="star star-3" id="star-3" type="radio" name="star" value="3"/>
                  <label class="star star-3" for="star-3"></label>
                  <input class="star star-2" id="star-2" type="radio" name="star" value="2"/>
                  <label class="star star-2" for="star-2"></label>
                  <input class="star star-1" id="star-1" type="radio" name="star" value="1" required/>
                  <label class="star star-1" for="star-1"></label>
                </div>
              </div>

              <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <div class="form-group">
                  <label for="exampleSelectRounded0">Please give your feedback<span class="text-danger"></span> </label>
                  <textarea class="form-control m-l-1 m-r-1" rows="2" placeholder="Enter Feedback ..." name="feedbackUser" id="feedbackUser" required></textarea>
                    
                </div>
              </div>
            </div>              
          </div>
          
          <div class="modal-footer justify-content-between">
              <button type="button" class="btn btn-light" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-success btn-rating">Submit</button>                                    
          </div>
        </form>
        </div>
      </div>
    </div> --}}

    {{-- Modal response request --}}
    <div class="modal fade bd-example-modal-xl" id="modal_progress" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
      <div class="modal-dialog modal-xl" role="document">                     
          <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title block text-primary" id="no_emp">
                  Progress Request</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">

            <div class="row">
              <div class="col-12">
                  <div class="timeline">
                      <article class="timeline-item">
                          <h2 class="m-0 d-none">&nbsp;</h2>
                          <div class="time-show mt-0">
                              <a href="#" class="btn btn-primary width-lg">{{__('Timeline')}}</a>
                          </div>
                      </article>
                      <article class="timeline-item timeline-item-left" >
                        <div class="timeline-desk" >
                            <div class="timeline-box">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                                <h4 class="mt-0 font-16" id="location_tl">Semi Detached No 16</h4>
                                <p class="text-muted" id="date_req_tl"><small>02:15 pm</small></p>
                                <p class="mb-0" id="desc_tl">{{__('On the other hand, we denounce with righteous indignation and dislike men who are so beguiled')}}</p>
                                <p class="mb-0 text-white" >{{__('On the other hand, we denounce with righteous indignation and dislike men who are so beguiled')}}</p>
                            </div>
                        </div>
                        <div class="timeline-desk">
                          <div class="text-center">
                            <img id="img_req" class="img img-fluid" style="max-width: 25rem;"/>
                          </div>
                            
                        </div>
                    </article>

                    {{-- Response --}}
                    <article class="timeline-item">
                      
                      <div class="timeline-desk">
                          <div class="timeline-box">
                              <span class="arrow"></span>
                              <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                              <h4 class="mt-0 font-16">Admin</h4>
                              <p class=" text-muted" id="date_response_tl"><small></small></p>
                              <p class="mb-0" id="response_tl"> </p>
                          </div>
                      </div>
                    </article>

                    {{-- Progress --}}
                    <article class="timeline-item timeline-item-left">
                      <div class="timeline-desk">
                          <div class="timeline-box">
                              <span class="arrow-alt"></span>
                              <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                              <h4 class="mt-0 font-16" id="user_dept_tl">{{__('Admin')}}</h4>
                              <p class="text-muted" id="date_progress_tl"><small>{{__('21 hours ago')}}x</small></p>
                              <p><b>Correction :</b></p>
                              <p id="correction_tl"></p>
                              <p><b>Root Cause :</b></p>
                              <p id="root_cause_tl"></p>
                              
                          </div>
                      </div>
                      <div class="timeline-option pt-1">
                        <div class="text-center">
                          <img id="img_progress" class="img img-fluid" style="max-width: 25rem;"/>
                        </div>
                      </div>
                  </article>
                  </div>
              </div>
            </div>

            
              
          
          </div>
          <div class="modal-footer">
             
              <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
          </div>
          </div>
      </div>
    </div>
  <!-- Control Sidebar -->
  </div>
@endsection

@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/table/datatable/datatables.js') !!}
    {!! Html::script('plugins/typehead/typeahead.bundle.js') !!}
    {!! Html::script('assets/js/forms/custom-typeahead.js') !!}
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
    

    var id_req, table_new, table_resp, table_progress, table_finish;
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

      let name = $("input[name=feedbackUser]").val();
      $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
      });
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

  // table news
  table_news = $('#table_news').DataTable({
            "lengthMenu": [[50, 100, 250, -1], [50, 100, 250, "All"]],
            "pageLength": 50,
            "language": {
                "paginate": {
                "previous": "<i class='las la-angle-left'></i>",
                "next": "<i class='las la-angle-right'></i>"
                }
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('request.my_request') }}",
            type: "GET",
            data: function (d) {
                d.status_progress = 3
            }
        },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data:'tic_number', name : 'tic_number',orderable: true, searchable: true},
                {data:'lokasi', name : 'lokasi',orderable: true, searchable: true},
                {data:'description', name : 'description',orderable: true, searchable: true},
                {data:'dept', name : 'dept',orderable: true, searchable: true},
                {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
            ]
});


// table response
table_resp = $('#table_resp').DataTable({
            "lengthMenu": [[50, 100, 250, -1], [50, 100, 250, "All"]],
            "pageLength": 50,
            "language": {
                "paginate": {
                "previous": "<i class='las la-angle-left'></i>",
                "next": "<i class='las la-angle-right'></i>"
                }
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('request.my_request') }}",
            type: "GET",
            data: function (d) {
                d.status_progress = 2
            }
        },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data:'tic_number', name : 'tic_number',orderable: true, searchable: true},
                {data:'description', name : 'description',orderable: true, searchable: true},
                {data:'dept', name : 'dept',orderable: true, searchable: true},
                {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
                {data: 'resp', name: 'resp', orderable: true, searchable: true},
                {data: 'est_day', name: 'est_day'},
            ]
});


// table progress
table_progress = $('#table_progress').DataTable({
            "lengthMenu": [[50, 100, 250, -1], [50, 100, 250, "All"]],
            "pageLength": 50,
            "language": {
                "paginate": {
                "previous": "<i class='las la-angle-left'></i>",
                "next": "<i class='las la-angle-right'></i>"
                }
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('request.my_request') }}",
            type: "GET",
            data: function (d) {
                d.status_progress = 3
            }
        },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data:'tic_number', name : 'tic_number',orderable: true, searchable: true},
                {data:'lokasi', name : 'lokasi',orderable: true, searchable: true},
                {data:'description', name : 'description',orderable: true, searchable: true},
                {data:'dept', name : 'dept',orderable: true, searchable: true},
                {data: 'created_at', name: 'created_at', orderable: true, searchable: true},
                {data: 'show_progress', name: 'show_progress'},
            ]
});

// table finish
table_finish = $('#table_finish').DataTable({
            "lengthMenu": [[50, 100, 250, -1], [50, 100, 250, "All"]],
            "pageLength": 50,
            "language": {
                "paginate": {
                "previous": "<i class='las la-angle-left'></i>",
                "next": "<i class='las la-angle-right'></i>"
                }
        },
        processing: true,
        serverSide: true,
        ajax: {
            url: "{{ route('request.my_request') }}",
            type: "GET",
            data: function (d) {
                d.status_progress = 4
            }
        },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data:'tic_number', name : 'tic_number',orderable: true, searchable: true},
                {data:'lokasi', name : 'lokasi',orderable: true, searchable: true},
                {data:'description', name : 'description',orderable: true, searchable: true},
                {data:'message', name : 'message',orderable: true, searchable: true},
                {data: 'akar_penyebab', name: 'akar_penyebab', orderable: true, searchable: true},
                {data: 'show_progress', name: 'show_progress'},
                {data: 'verified', name: 'verified'},
            ]
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

    $("#star-5").click(function(e){
      star_value = 5;
    });

    $("#star-4").click(function(e){
      star_value = 4;
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

  function showProgress(id){
    
    $.ajax({
        type:"GET",
        url: "{{ URL::to('/') }}/request/"+id+"/show/",
        dataType: 'json',
        success: function(res){
              $('#modal_progress').modal('show');
              document.getElementById("desc_tl").innerHTML  = res.description;
              document.getElementById("location_tl").innerHTML  = res.location;
              document.getElementById("date_req_tl").innerHTML  = res.date_req;
              document.getElementById("response_tl").innerHTML  = res.response ;
              document.getElementById("date_response_tl").innerHTML  = res.date_resp;
              $('#img_req').attr('src', '{{ URL::asset("/storage/img_progress/") }}'+'/'+res.image_req);
              $('#img_progress').attr('src', '{{ URL::asset("/storage/img_progress/") }}'+'/'+res.image_progress);
              document.getElementById("date_progress_tl").innerHTML  = res.date_progress;
              document.getElementById("root_cause_tl").innerHTML  = res.root_cause;
              document.getElementById("correction_tl").innerHTML  = res.correction;
            }
        });
  }

  function showRating(id){
    $('#modal_rating').modal('show');
  }

  </script>
@endpush