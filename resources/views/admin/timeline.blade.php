@extends('layouts.master')

@push('plugin-styles')
    {{-- {!! Html::style('assets/css/loader.css') !!} --}}
    {!! Html::style('plugins/apex/apexcharts.css') !!}
    {!! Html::style('assets/css/dashboard/dashboard_1.css') !!}
    {!! Html::style('plugins/flatpickr/flatpickr.css') !!}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('assets/css/elements/tooltip.css') !!}
    {!! Html::style('assets/css/pages/timeline.css') !!}
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
                                
                              <li class="breadcrumb-item" aria-current="page"><span> {{__('Request')}}</span></li>
                                <li class="breadcrumb-item active" aria-current="page">Timelilne</li>
                            </ol>
                        </nav>
                    </div>
                </li>
            </ul>
        </header>
      </div>
      <!--  Navbar Ends / Breadcrumb Area  -->


       <!-- Main Body Starts -->
    <div class="layout-px-spacing">
        <div class="layout-top-spacing mb-5">
            <div class="col-md-12">
                <div class="row">
                    <div class="col-12">
                        <div class="timeline">
                            <article class="timeline-item">
                                <h2 class="m-0 d-none">&nbsp;</h2>
                                <div class="time-show mt-0">
                                    <a href="#" class="btn btn-primary width-lg">{{ $req->created_at->format('d M Y') }}</a>
                                </div>
                                
                            </article>
                            <article class="timeline-item timeline-item-left">
                                <div class="timeline-desk">
                                    <div class="timeline-box">
                                        <span class="arrow-alt"></span>
                                        <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                                        <h4 class="mt-0 font-16"> {{ $u->name }}</h4>
                                        <p class="text-muted"><small></a> Send Request {{ $req->created_at->format('d M Y / H:i') }}</small></p>
                                        <p class="mb-0">{{ $req->description }}</p>
                                        {{-- <img src="{{ asset('storage/img_progress/'.$u->image) }}" class=" timeline-album rounded-circle align-self-center rounded-1 mr-1 ml-2 mr-auto"/> --}}
                                    </div>
                                </div>
                                <div class="timeline-option">
                                    <img class="img img-fluid timeline-req" style="min-width: 80%;" src="{{ asset('storage/img_progress/'.$u->image) }}" >
                                </div>
                            </article>

                            @if ($response != null)
                            <article class="timeline-item">
                                <div class="timeline-desk">
                                    <div class="timeline-box">
                                        <span class="arrow"></span>
                                        <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                                        <h4 class="mt-0 font-16">{{ $response->nama_dept }}</h4>
                                        <p class=" text-muted"><small>Response {{ date('d M Y / H : i', strtotime($response->created_at)) }}</small></p>
                                        <p class="mb-0">{{$response->response}} </p>
                                    </div>
                                </div>
                            </article>  
                            @endif
                            
                            @if ($pg != null)
                            <article class="timeline-item text-left">
                                <div class="media text-left">
                                    <div class="timeline-option ">
                                        <img class="align-self-left ml-5 timeline-img  ml-0 mr-0" src="{{ asset('storage/img_progress/'.$pg->image) }}" style="height: 250px; width: auto;">
                                    </div>
                                </div>
                                
                                <div class="timeline-desk">
                                    <div class="timeline-box">
                                        <span class="arrow"></span>
                                        <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                                        <h4 class="mt-0 font-16">{{__('Progress of work')}}</h4>
                                        <p class="text-muted">{{  date('d M Y / H : i', strtotime($pg->created_at)) }}</p>
                                        <p class="mb-0">{{ $pg->message }}</p>
                                    </div>
                                </div>
                            </article>
                            @endif
   
                            
                            @if ($u->progress_request == 4)
                            <article class="timeline-item">
                                <div class="media text-left">
                                    <div class="timeline-option ">
                                        
                                        <img class="align-self-left ml-5 timeline-img  ml-0 mr-0" src="{{ asset('storage/img_finish/'.$finish->image) }}" style="height: 250px; width: auto;">
                                    </div>
                                </div>
                                <div class="timeline-desk">
                                    <div class="panel">
                                        <div class="timeline-box">
                                            <span class="arrow"></span>
                                            <span class="timeline-icon"><i class="lar la-dot-circle"></i></span>
                                            <h4 class="mt-0 font-16">Request has done.</h4>
                                            <p class="text-muted"><small>{{  date('d M Y / H : i', strtotime($u->updated_at)) }}</small></p>
                                            <p class="mb-0 mr-5">{{ $finish->description }} &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                                                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</p>
                                            <p></p>
                                        </div>
                                    </div>
                                </div>
                            </article>
                            @endif

                            
                         
                            
                            @if ($u->progress_request == 4)
                            <article class="timeline-item">
                                <h2 class="m-0 d-none">&nbsp;</h2>
                                <div class="time-show">
                                    <a href="#" class="btn btn-primary width-lg">{{  date('d M Y', strtotime($finish->created_at)) }}</a>
                                </div>
                            </article>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Body Ends -->


       
</div>
@endsection

@section('title')
    Timeline
@endsection
