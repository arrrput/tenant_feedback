@extends('layouts.master')

@section('title')
    {{ Auth::user()->name}} |
@endsection
@push('plugin-styles')
    {!! Html::style('assets/css/ui-elements/breadcrumbs.css') !!}
    {!! Html::style('plugins/table/datatable/datatables.css') !!}
    {!! Html::style('plugins/jquery-ui/jquery-ui.min.css') !!}
    {!! Html::style('plugins/table/datatable/dt-global_style.css') !!}
    {!! Html::style('assets/css/ui-elements/loading-spinners.css') !!}
    {!! Html::style('assets/css/ui-elements/alert.css') !!}

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
                              
                              <li class="breadcrumb-item active" aria-current="page"><span> {{__('User Request')}}</span></li>
                          </ol>
                      </nav>
                  </div>
              </li>
          </ul>
      </header>
    </div>
  <!--  Navbar Ends / Breadcrumb Area  -->


  {{-- Modal response request --}}
  <div class="modal fade bd-example-modal-xl" id="modal_response" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">      
        <form action="javascript:void(0)" id="form_response_req" name="form_response_req" method="POST" >                
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title block text-primary" id="no_emp">
                <i class="fa fa-plus"></i> 
                Response</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">

          <div class="text-center">
            
            <img id="image_response" class="img img-fluid rounded"/>
          </div>
          
            <div class="row m-3">
              <input type="hidden" name="id_response" id="id_response"/>
              
              <div class="col-md-12 col-lg-12 col-sm-12">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th >Description</th>
                      <th>Location</th>
                      <th>No Unit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td ><p id="desc_response"></p></td>
                      <td ><p id="loc_response"></p></td>
                      <td ><p id="unit_response"></p></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-md-6 col-lg-6 col-sm-12">
                <label for="name" >Response</label>
                  
                  <input type="text" class="form-control" id="response" name="response" placeholder="Input Response Here" required>
                 
              </div>
              <div class="col-md-6 col-lg-6 col-sm-12">
                <label for="name" >Target Completion (Working days)</label>
                <input type="number" class="form-control" id="target_hari" name="target_hari" value="" placeholder="1 day/ 2 day/ etc" required>
                
              </div>
                

            </div>
            
        
        </div>
        <div class="modal-footer">
            <div class="loading-container" id="load-response" style="display: none;">
                <div class="dots-one">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <button type="submit" id="btn-save-response" class="btn bg-gradient-success text-white">Response </button>
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
        </div>
        </form>
    </div>
  </div>

  {{-- Modal response request --}}
  <div class="modal fade bd-example-modal-xl" id="modal_reject" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">      
        <form action="javascript:void(0)" id="form_reject_req" name="form_reject_req" method="POST" >                
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title block text-primary" >
                <i class="fa fa-plus"></i> 
                Cancel Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img id="image_reject" class="img img-fluid rounded"/>
          </div>
          
            <div class="row m-3">
              <input type="hidden" name="id_reject" id="id_reject"/>
              
              <div class="col-md-12 col-lg-12 col-sm-12">
                <table class="table table-hover">
                  <thead>
                    <tr>
                      <th >Description</th>
                      <th>Location</th>
                      <th>No Unit</th>
                    </tr>
                  </thead>
                  <tbody>
                    <tr>
                      <td ><p id="desc_reject"></p></td>
                      <td ><p id="loc_reject"></p></td>
                      <td ><p id="unit_reject"></p></td>
                    </tr>
                  </tbody>
                </table>
              </div>
              <div class="col-sm-12 mb-6">
                  <label class="form-label text-primary">
                      Reason Cancel <span class="text-danger">(*)</span>
                  </label>
                  <textarea class="form-control m-l-1 m-r-1" rows="2" placeholder="Enter description ..." name="description_reject" id="description_reject" required></textarea>
              </div>               

            </div>
            
        
        </div>
        <div class="modal-footer">
            <div class="loading-container" id="load-reject" style="display: none;">
                <div class="dots-one">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <button type="submit" id="btn-save-reject" class="btn bg-gradient-success text-white">Submit </button>
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
        </div>
        </form>
    </div>
  </div>

  {{-- Modal progress request --}}
  <div class="modal fade bd-example-modal-xl" id="modal_progress" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">      
        <form action="javascript:void(0)" id="form_progress_req" name="form_progress_req" method="POST" >                
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title block text-primary" >
                <i class="fa fa-plus"></i> 
                Add Progress</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img id="image_progress" class="img img-fluid rounded"/>
          </div>
          
            <div class="row m-3">
              <input type="hidden" name="id_progress" id="id_progress"/>
              <input type="hidden" name="id_user" id="id_user"/>
              
              <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                <label class="form-label text-primary">
                    Upload Picture <span class="text-danger">(*.png / *.jpg / *.jpeg / Max 2MB)</span>
                </label>
                <input type="file" class="form-control" name="img_progress" id="img_progress"/>
            </div> 

              <div class="col-lg-6 col-md-6 col-sm-12 mb-6">
                  <label class="form-label text-primary">
                      Correction <span class="text-danger">(*)</span>
                  </label>
                  <textarea class="form-control m-l-1 m-r-1" rows="2" placeholder="Enter description ..." name="correction" id="correction" required></textarea>
              </div>               

              <div class="col-lg-6 col-md-6 col-sm-12 mb-6">
                  <label class="form-label text-primary">
                      Root Cause <span class="text-danger">(*)</span>
                  </label>
                  <textarea class="form-control m-l-1 m-r-1" rows="2" placeholder="Enter description ..." name="root_cause" id="root_cause" required></textarea>
              </div>  
            </div>
            
        
        </div>
        <div class="modal-footer">
            <div class="loading-container" id="load-progress" style="display: none;">
                <div class="dots-one">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
            <button type="submit" id="btn-save-progress" class="btn bg-gradient-success text-white">Submit </button>
            <button type="button" class="btn btn-white" data-dismiss="modal">Close</button>
        </div>
        </div>
        </form>
    </div>
  </div>

  {{-- Modal finish request --}}
  <div class="modal fade bd-example-modal-xl" id="modal_finish" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">      
        <form action="javascript:void(0)" id="form_finish_req" name="form_finish_req" method="POST" >                
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title block text-primary" >
                <i class="fa fa-plus"></i> 
                Close Request</h5>
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
            </button>
        </div>
        <div class="modal-body">
          <div class="text-center">
            <img id="image_finish" class="img img-fluid rounded"/>
          </div>
          
            <div class="row m-3">
              <input type="hidden" name="id_finish" id="id_finish"/>
              
              <div class="col-lg-12 col-md-12 col-sm-12 mb-3">
                  <label class="form-label text-primary">
                      Upload Picture <span class="text-danger">(*.png / *.jpg / *.jpeg / Max 2MB)</span>
                  </label>
                  <input type="file" class="form-control" name="img_finish" id="img_finish"/>
              </div> 

              <div class="col-lg-12 col-md-12 col-sm-12 mb-6">
                <label class="form-label text-primary">
                    Description <span class="text-danger">(*)</span>
                </label>
                <textarea class="form-control m-l-1 m-r-1" rows="2" placeholder="Enter description ..." name="description_finish" id="description_finish" required></textarea>
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
      
        {{-- Maint content --}}
        <section class="content mb-5">
          <div class="container-fluid">
            <div class="widget-content widget-content-area br-12">
              <ul class="nav nav-tabs mb-2 mt-2" id="normaltab" role="tablist">
                  <li class="nav-item ">
                      <a class="nav-link active" id="new-tab" data-toggle="tab" href="#new" role="tab" aria-controls="new" aria-selected="true"><b> {{__('New Request')}}</b></a>
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
                    <h5>News Request</h5>

                    <table class="table table-hover" id="table_news">
                      <thead>
                        <tr>
                          <th style="width: 19px">No</th>
                          <th>Name</th>
                          <th style="width: 200px;">Description</th>
                          <th>Location</th>
                          <th>No Unit</th>
                          <th>Date</th>
                          <th style="width: 200px;">status</th>
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
                        <th>Name</th>
                        <th style="width: 200px;">Description</th>
                        <th>Location</th>
                        <th>No Unit</th>
                        <th>Date</th>
                        <th style="width: 200px;">status</th>
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
                        <th>Name</th>
                        <th style="width: 200px;">Description</th>
                        <th>Location</th>
                        <th>No Unit</th>
                        <th>Date</th>
                        <th style="width: 200px;">status</th>
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
                        <th>Name</th>
                        <th style="width: 200px;">Description</th>
                        <th>Location</th>
                        <th>No Unit</th>
                        <th>Start</th>
                        <th>End</th>
                        <th>Day Work</th>
                        <th style="width: 200px;">status</th>
                      </tr>
                    </thead>
                    <tbody>

                    </tbody>
                  </table>
                </div>

                {{-- Reject --}}
                <div class="tab-pane fade" id="reject" role="tabpanel" aria-labelledby="reject-tab">
                  <h5>Cancel</h5>
                  <table class="table table-hover" id="table_cancel">
                    <thead>
                      <tr>
                        <th style="width: 19px">No</th>
                        <th>Name</th>
                        <th style="width: 200px;">Description</th>
                        <th>Location</th>
                        <th>Cancel Reason</th>
                        <th>Date</th>
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
        {{-- End Main content --}}
        
    </div>
    @endsection


@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('plugins/jquery-ui/jquery-ui.min.js') !!}
 
    {!! Html::script('plugins/table/datatable/datatables.js') !!}

@endpush

@push('custom-scripts')
<script>
    //set crsf token
    $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
var table_news, table_resp, table_progress, table_finish, table_cancel;

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
            url: "{{ route('department.new_request') }}",
            type: "GET"
        },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data:'name', name : 'name',orderable: true, searchable: true},
                {data:'description', name : 'description',orderable: true, searchable: true},
                {data:'lokasi', name : 'lokasi',orderable: true, searchable: true},
                {data: 'no_unit', name: 'no_unit', orderable: true, searchable: true},
                {data: 'created_at', name: 'created_at'},
                {data: 'response', name: 'response'},
            ]
    });

// table news
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
            url: "{{ route('department.resp_request') }}",
            type: "GET"
        },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data:'name', name : 'name',orderable: true, searchable: true},
                {data:'description', name : 'description',orderable: true, searchable: true},
                {data:'lokasi', name : 'lokasi',orderable: true, searchable: true},
                {data: 'no_unit', name: 'no_unit', orderable: true, searchable: true},
                {data: 'created_at', name: 'created_at'},
                {data: 'response', name: 'response'},
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
            url: "{{ route('department.progress_request') }}",
            type: "GET"
        },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data:'name', name : 'name',orderable: true, searchable: true},
                {data:'description', name : 'description',orderable: true, searchable: true},
                {data:'lokasi', name : 'lokasi',orderable: true, searchable: true},
                {data: 'no_unit', name: 'no_unit', orderable: true, searchable: true},
                {data: 'created_at', name: 'created_at'},
                {data: 'response', name: 'response'},
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
            url: "{{ route('department.finish_request') }}",
            type: "GET"
        },
            columns: [
                { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                {data:'name', name : 'name',orderable: true, searchable: true},
                {data:'description', name : 'description',orderable: true, searchable: true},
                {data:'lokasi', name : 'lokasi',orderable: true, searchable: true},
                {data: 'no_unit', name: 'no_unit', orderable: true, searchable: true},
                {data: 'created_at', name: 'created_at'},
                {data: 'updated_at', name: 'updated_at'},
                {data: 'start_end', name: 'start_end'},
                {data: 'rating', name: 'rating'},
            ]
});

// table cancel
table_cancel = $('#table_cancel').DataTable({
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
                url: "{{ route('department.reject_request') }}",
                type: "GET"
            },
                columns: [
                    { data: 'DT_RowIndex', name: 'DT_RowIndex', orderable: false, searchable: false },
                    {data:'name', name : 'name',orderable: true, searchable: true},
                    {data:'description', name : 'description',orderable: true, searchable: true},
                    {data:'lokasi', name : 'lokasi',orderable: true, searchable: true},
                    {data: 'cancel', name: 'cancel', orderable: true, searchable: true},
                    {data: 'created_at', name: 'created_at'},
                ]
});


function responseReq(id){
  $.ajax({
        type:"GET",
        url: "{{ URL::to('/') }}/department/"+id+"/show/",
        dataType: 'json',
        success: function(res){
              $('#modal_response').modal('show');
              $('#id_response').val(res.id);
              document.getElementById("desc_response").innerHTML  = res.description ;
              document.getElementById("loc_response").innerHTML  = res.lokasi ;
              document.getElementById("unit_response").innerHTML  = res.no_unit ;
              $('#image_response').attr('src', '{{ URL::asset("/storage/img_progress/") }}'+'/'+res.image);

              
            }
        });

}

  // store response
    $('#form_response_req').submit(function(e) {
        document.getElementById('load-response').style.display = 'block';
        document.getElementById('btn-save-response').style.display = 'none';
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('department.store_reponse')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
          document.getElementById('load-response').style.display = 'none';
                document.getElementById('btn-save-response').style.display = 'block';
            document.getElementById("form_response_req").reset();
                
                $("#modal_response").modal('hide');
                table_news.ajax.reload();
                table_resp.ajax.reload();
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Response Successfully',
                    showConfirmButton: false,
                    timer: 3000
                });  
            
        },
            error: function(data){
              document.getElementById('load-response').style.display = 'none';
              document.getElementById('btn-save-response').style.display = 'block';
              console.log(data);
            }
        })
    });


function rejectReq(id){ 
  $.ajax({
        type:"GET",
        url: "{{ URL::to('/') }}/department/"+id+"/show/",
        dataType: 'json',
        success: function(res){
          $("#modal_reject").modal('show');
              $('#id_reject').val(res.id);
              document.getElementById("desc_reject").innerHTML  = res.description ;
              document.getElementById("loc_reject").innerHTML  = res.lokasi ;
              document.getElementById("unit_reject").innerHTML  = res.no_unit ;
              $('#image_reject').attr('src', '{{ URL::asset("/storage/img_progress/") }}'+'/'+res.image);
            }
  });
}

  // store cancel
  $('#form_reject_req').submit(function(e) {
        document.getElementById('load-reject').style.display = 'block';
        document.getElementById('btn-save-reject').style.display = 'none';
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('department.store_cancel')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            document.getElementById('load-reject').style.display = 'none';
            document.getElementById('btn-save-reject').style.display = 'block';
            document.getElementById("form_reject_req").reset();
                
                table_news.ajax.reload();
                $("#modal_reject").modal('hide');
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Request was cancel',
                    showConfirmButton: false,
                    timer: 3000
                });  
            
        },
            error: function(data){
              document.getElementById('load-reject').style.display = 'none';
              document.getElementById('btn-save-reject').style.display = 'block';
              console.log(data);
            }
        })
  });

// progress request
function progressReq(id){ 
  $.ajax({
        type:"GET",
        url: "{{ URL::to('/') }}/department/"+id+"/show/",
        dataType: 'json',
        success: function(res){
          $("#modal_progress").modal('show');
          $('#id_progress').val(res.id);
          $('#image_progress').attr('src', '{{ URL::asset("/storage/img_progress/") }}'+'/'+res.image);
        }
  });
}

// store cancel
$('#form_progress_req').submit(function(e) {
        document.getElementById('load-progress').style.display = 'block';
        document.getElementById('btn-save-progress').style.display = 'none';
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('department.create_progress')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            document.getElementById('load-progress').style.display = 'none';
            document.getElementById('btn-save-progress').style.display = 'block';
            document.getElementById("form_progress_req").reset();
                
                table_resp.ajax.reload();
                table_progress.ajax.reload();
                $("#modal_progress").modal('hide');
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Add Progress Successfully',
                    showConfirmButton: false,
                    timer: 3000
                });  
            
        },
            error: function(data){
              document.getElementById('load-progress').style.display = 'none';
              document.getElementById('btn-save-progress').style.display = 'block';
              console.log(data);
            }
        })
});

function finishReq(id){
  $.ajax({
        type:"GET",
        url: "{{ URL::to('/') }}/department/"+id+"/show/",
        dataType: 'json',
        success: function(res){
          $("#modal_finish").modal('show');
          $('#id_finish').val(res.id);
          
        }
  });
}


// store finish
$('#form_finish_req').submit(function(e) {
        document.getElementById('load-finish').style.display = 'block';
        document.getElementById('btn-save-finish').style.display = 'none';
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('department.finish')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            document.getElementById('load-finish').style.display = 'none';
            document.getElementById('btn-save-finish').style.display = 'block';
            document.getElementById("form_finish_req").reset();
                
                table_progress.ajax.reload();
                table_finish.ajax.reload();
                $("#modal_finish").modal('hide');
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Request was close',
                    showConfirmButton: false,
                    timer: 3000
                });  
            
        },
            error: function(data){
              document.getElementById('load-finish').style.display = 'none';
              document.getElementById('btn-save-finish').style.display = 'block';
              console.log(data);
            }
        })
  });
  
</script>

@endpush
