@extends('layouts.master')

@push('plugin-styles')
    {!! Html::style('assets/css/dashboard/dashboard_1.css') !!}
    {!! Html::style('assets/css/ui-elements/breadcrumbs.css') !!}
    {!! Html::style('plugins/table/datatable/datatables.css') !!}
    {!! Html::style('plugins/table/datatable/dt-global_style.css') !!}
    {!! Html::style('assets/css/pages/timeline.css') !!}
    {!!  Html::style('http://netdna.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css') !!}
    {!! Html::style('assets/css/ui-elements/alert.css') !!}
    {!! Html::style('assets/css/forms/form-widgets.css') !!}
    {!! Html::style('assets/css/ui-elements/loading-spinners.css') !!}

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

    @if ($message = Session::get('success'))
        <div class="alert alert-icon-button-left alert-light-success text-success mb-4" role="alert">
            <button type="button" class="close" data-dismiss="alert" aria-label="{{__('Close')}}">
                <i class="las la-times text-warning"></i>
            </button>
            <i class="las la-exclamation-triangle text-success font-20"></i>
            <strong>Success</strong> {{ $message }}.
            <button type="button" class="btn btn-sm bg-gradient-success float-right mr-2 text-white" data-dismiss="alert" aria-label="{{__('Close')}}">
                {{__('Dismiss')}}
            </button>
        </div>
    @endif
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
            
            <button class="btn bg-gradient-warning text-white m-3" data-toggle="modal" data-target="#modal_add_req"><i class="las la-plus"></i> Add Request</button>
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

    
  {{-- modal_add_req --}}
  <div class="modal fade bd-example-modal-xl" id="modal_add_req" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-xl" role="document">                     
        <div class="modal-content">
          <form action="javascript:void(0)" id="form_add_req" name="form_add_req" method="POST" >
            <div class="modal-header">
                <h5 class="modal-title block text-primary" id="no_emp">
                    Add Request</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">

              <div class="row">
                <div class="col-12">
                  <div class="form-group">
                    <img id="preview-image-before-upload" 
                    src="{{ URL::asset('image/icon-img.png') }}"
                    class="rounded mx-auto d-block"
                      alt="preview image" style="max-height: 250px;">
                    <label for="image">Image <span class="text-danger">(*.jpg/ *.png / *.jpeg / Max Size 2Mb)</span></label>
                    <div class="col-sm-12">
                      <input type="file" class="form-control" id="image" name="image" placeholder="Input Response Here">
                      @error('image')
                      <span class="text-danger text-sm">{{ $message }}</span>                              
                    @enderror
                    </div>
                  </div>
                </div>

                <div class="col-sm-6">
                  <div class="form-group">
                    {{-- <label for="exampleSelectRounded0">Location <span class="text-danger">( * )</span></label> --}}
                    <input type="text" class="form-control typeahead" rows="3" placeholder="Location" name="location" required/>
                      @error('location')
                        <span class="text-danger text-sm">{{ $message }}</span>                              
                      @enderror
                  </div>
                </div>

                <div class="col-sm-6 mt-4">
                  <div class="form-group">
                    <label for="exampleSelectRounded0"> <span class="text-danger"></span></label>
                    <input type="text" class="form-control" placeholder="Number" name="no_unit" required/>
                      @error('no_unit')
                        <span class="text-danger text-sm">{{ $message }}</span>                              
                      @enderror
                  </div>
                </div>
                
              </div>
            

              <div class="row">
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="exampleSelectRounded0">Related Department <span class="text-danger">( * )</span></label>
                        <select class="custom-select rounded-0" id="id_department" name="id_department" required>
                            <option selected disabled>-- Select Here -- </option>
                            @foreach ($departments as $dept)
                              <option value="{{ $dept->id }}">{{ $dept->department }}</option>
                            @endforeach  
                        </select>
                        @error('department')
                            <span class="text-danger text-sm">{{ $message }}</span>                              
                          @enderror
                    </div>
                  </div>
                  <div class="col-sm">
                    <div class="form-group">
                      <label for="exampleSelectRounded0">Nature of Request  <span class="text-danger">( * )</span></label>
                          <select class="custom-select rounded-0" id="id_part" name="id_part" required>
                            <option disabled>-- Select Here -- </option>
            
                          </select>
                          @error('id_part')
                          <span class="text-danger text-sm">{{ $message }}</span>                              
                        @enderror 
                    </div>
                  </div>
              </div>
                
                <label for="exampleSelectRounded0">Description about request </label>
                <textarea class="form-control" rows="3" placeholder="Enter description ..." name="description"></textarea>
                @error('description')
                        <span class="text-danger text-sm">{{ $message }}</span>                              
                      @enderror
                <input type="hidden" value="{{ Auth::user()->id }}" name="id_user"/>
                      <input type="hidden" value="1" name="progress_request"/>
                <p></p>
                
            
            </div>
            <div class="modal-footer">
              <div class="loading-container" id="load-addreq" style="display: none;">
                <div class="dots-one">
                    <span></span>
                    <span></span>
                    <span></span>
                    <span></span>
                </div>
            </div>
                <button type="submit" id="btn-save-req" class="btn bg-gradient-success btn-sm text-white">Submit</button>
                <button type="button" class="btn btn-white btn-sm" data-dismiss="modal">Close</button>
            </div>
          </form>
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
              <input type="hidden" name="id_req_rated" id="id_req_rated"/>
              
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
                                <p class="mb-0 text-white" >&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;</p>
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

    {{-- Modal response request --}}
    <div class="modal fade bd-example-modal-xl" id="modal_finish" tabindex="-1" role="dialog" aria-labelledby="mySmallModalLabel" aria-hidden="true">
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
                              <a href="#" class="btn btn-primary width-lg">{{__('Start')}}</a>
                          </div>
                      </article>
                      <article class="timeline-item timeline-item-left" >
                        <div class="timeline-desk" >
                            <div class="timeline-box">
                                <span class="arrow-alt"></span>
                                <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                                <h4 class="mt-0 font-16" id="location_fn">Semi Detached No 16</h4>
                                <p class="text-muted" id="date_req_fn"><small>02:15 pm</small></p>
                                <p class="mb-0" id="desc_fn">{{__('On the other hand, we denounce with righteous indignation and dislike men who are so beguiled')}}</p>
                                <p class="mb-0 text-white" >&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp; &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                  &nbsp;&nbsp;&nbsp;&nbsp;
                                </p>
                            </div>
                        </div>
                        <div class="timeline-desk">
                          <div class="text-center">
                            <img id="img_req_fn" class="img img-fluid" style="max-width: 25rem;"/>
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
                              <p class=" text-muted" id="date_response_fn"><small></small></p>
                              <p class="mb-0" id="response_fn"> </p>
                          </div>
                      </div>
                    </article>

                    {{-- Progress --}}
                    <article class="timeline-item timeline-item-left">
                      <div class="timeline-desk">
                          <div class="timeline-box">
                              <span class="arrow-alt"></span>
                              <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                              <h4 class="mt-0 font-16" id="user_dept_fn">{{__('Admin')}}</h4>
                              <p class="text-muted" id="date_progress_fn"><small>{{__('21 hours ago')}}x</small></p>
                              <p><b>Correction :</b></p>
                              <p id="correction_fn"></p>
                              <p><b>Root Cause :</b></p>
                              <p id="root_cause_fn"></p>
                              
                          </div>
                      </div>
                      <div class="timeline-option pt-1">
                        <div class="text-center">
                          <img id="img_progress_fn" class="img img-fluid" style="max-width: 25rem;"/>
                        </div>
                      </div>
                    </article>

                    {{-- Finish --}}
                    <article class="timeline-item timeline-item-left">
                      <div class="timeline-desk">
                          <div class="timeline-box">
                              <span class="arrow-alt"></span>
                              <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                              <h4 class="mt-0 font-16" >{{__('Finish Task')}}</h4>
                              <p class="text-muted" id="date_finish"><small>{{__('21 hours ago')}}x</small></p>
                              <p id="message_finish"></p>
                                                            
                          </div>
                      </div>
                      <div class="timeline-option pt-1">
                        <div class="text-center">
                          <img id="img_finish" class="img img-fluid" style="max-width: 25rem;"/>
                        </div>
                      </div>
                    </article>

                    <article class="timeline-item">
                      
                      <div class="time-show">
                          <a href="#" class="btn btn-primary width-lg">Finish</a>
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

  // Typeahead
  (function($) {
    "use strict";
    $(document).ready(function() {
        // Defining the local dataset
        var cars = ['Detached','Semi Detached', 'Terrace', 'Dormitory', 'ShopHouse', 'Villa'];
        // Constructing the suggestion engine
        var cars = new Bloodhound({
            datumTokenizer: Bloodhound.tokenizers.whitespace,
            queryTokenizer: Bloodhound.tokenizers.whitespace,
            local: cars
        });
        // Initializing the typeahead
        $('.typeahead').typeahead({
                hint: true,
                highlight: true, /* Enable substring highlighting */
                minLength: 1 /* Specify minimum characters required for showing suggestions */
            },
            {
                name: 'cars',
                source: cars
            });
    });
})(jQuery);

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
                d.status_progress = 1
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
        bDestroy: true,
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
                {data: 'show_finish', name: 'show_finish'},
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

  function showFinish(id){
    
    $.ajax({
        type:"GET",
        url: "{{ URL::to('/') }}/request/"+id+"/show/",
        dataType: 'json',
        success: function(res){
              $('#modal_finish').modal('show');
              document.getElementById("desc_fn").innerHTML  = res.description;
              document.getElementById("location_fn").innerHTML  = res.location;
              document.getElementById("date_req_fn").innerHTML  = res.date_req;
              document.getElementById("response_fn").innerHTML  = res.response ;
              document.getElementById("date_response_fn").innerHTML  = res.date_resp;
              $('#img_req_fn').attr('src', '{{ URL::asset("/storage/img_progress/") }}'+'/'+res.image_req);
              $('#img_progress_fn').attr('src', '{{ URL::asset("/storage/img_progress/") }}'+'/'+res.image_progress);
              $('#img_finish').attr('src', '{{ URL::asset("/storage/img_finish/") }}'+'/'+res.image_finish);
              document.getElementById("date_progress_fn").innerHTML  = res.date_progress;
              document.getElementById("root_cause_fn").innerHTML  = res.root_cause;
              document.getElementById("correction_fn").innerHTML  = res.correction;
              document.getElementById("date_finish").innerHTML  = res.date_finish;
              document.getElementById("message_finish").innerHTML  = res.message_finish;
            }
        });
  }

  function showRating(id){
    
    $.ajax({
        type:"GET",
        url: "{{ URL::to('/') }}/request/"+id+"/show/",
        dataType: 'json',
        success: function(res){
          $('#modal_rating').modal('show');
            $("#id_req_rated").val(res.id);
              
          }
    });
  }

  // store rating
  $('#form_finish_req').submit(function(e) {
        document.getElementById('load-finish').style.display = 'block';
        document.getElementById('btn-save-finish').style.display = 'none';
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('request.rating')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
            document.getElementById('load-finish').style.display = 'none';
            document.getElementById('btn-save-finish').style.display = 'block';
            document.getElementById("form_finish_req").reset();
                
                
                $("#modal_rating").modal('hide');
                $('#table_finish').DataTable().ajax.reload();
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Thank you for your feedback',
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

  // add request
  $('#form_add_req').submit(function(e) {
        document.getElementById('load-addreq').style.display = 'block';
        document.getElementById('btn-save-req').style.display = 'none';
        e.preventDefault();
        var formData = new FormData(this);
        $.ajax({
        type:'POST',
        url: "{{ route('request.store')}}",
        data: formData,
        cache:false,
        contentType: false,
        processData: false,
        success: (data) => {
           
            document.getElementById("form_add_req").reset();
                document.getElementById('load-addreq').style.display = 'none';
                document.getElementById('btn-save-req').style.display = 'block';
                table_news.ajax.reload();
                //show success message
                Swal.fire({
                    type: 'success',
                    icon: 'success',
                    title: 'Request Successfully',
                    showConfirmButton: false,
                    timer: 3000
                });      
                $("#modal_add_req").modal('hide');
                findGuest();
            
        },
            error: function(data){
                document.getElementById('load-addreq').style.display = 'none';
                document.getElementById('btn-save-req').style.display = 'block';
                console.log(data);
            }
        })
    });

    $(document).ready(function (e) {
 
 $('#image').change(function(){
 let reader = new FileReader();
 reader.onload = (e) => { 
   $('#preview-image-before-upload').attr('src', e.target.result); 
 }

 reader.readAsDataURL(this.files[0]); 
   });

   $('#id_department').change(function(){
 var idDept = $(this).val();    
 if(idDept){
     $.ajax({
        type:"GET",
        url:"/getrelevant?id_department="+idDept,
        dataType: 'JSON',
        success:function(res){               
         if(res){
             $("#id_part").empty();
             $("#id_part").append('<option disabled>--Select Here--</option>');
             $.each(res,function(nama,kode){
                 $("#id_part").append('<option value="'+kode+'">'+nama+'</option>');
             });
         }else{
            $("#id_part").empty();
         }
        }
     });
 }else{
     $("#id_part").empty();
 }      
});
});
  </script>
@endpush