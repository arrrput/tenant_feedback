@extends('layouts.master')

@push('plugin-styles')
    {{-- {!! Html::style('assets/css/loader.css') !!} --}}
    {!! Html::style('plugins/flatpickr/custom-flatpickr.css') !!}
    {!! Html::style('assets/css/elements/tooltip.css') !!}
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
                              
                              <li class="breadcrumb-item active" aria-current="page"><span> {{__('Request')}}</span></li>
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
    <div class="layout-top-spacing mb-2">
        <div class="col-md-12">
            <div class="row">
                <div class="container p-0">
                    <div class="row layout-top-spacing">
                        <div class="col-lg-12 layout-spacing">
                            <!-- Your Content Here -->

                            <!-- BASIC -->
                            <div class="col-xl-12 col-lg-12 col-sm-12  layout-spacing">
                                <div class="widget-content widget-content-area br-6">
                                    <h4 class="table-header"><i class="las la-plus text-success"></i> {{__('Add Request')}}</h4>
                                    <div class="table-responsive mb-4">
                                        <hr>
                                        
                                      {{-- Form input request --}}
                                      <form action="{{ route('request.store') }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                    <!-- Form input -->
                    
                                      <div class="form-group">
                                        <img id="preview-image-before-upload" 
                                        src="{{ URL::asset('image/icon-img.png') }}"
                                        class="rounded mx-auto d-block"
                                          alt="preview image" style="max-height: 250px;">
                                        <label for="image">Image</label>
                                        <div class="col-sm-12">
                                          <input type="file" class="form-control" id="image" name="image" placeholder="Input Response Here">
                                          @error('image')
                                          <span class="text-danger text-sm">{{ $message }}</span>                              
                                        @enderror
                                        </div>
                                      </div>
                    
                                      <div class="row">
                                        <div class="col-sm">
                                          <label for="exampleSelectRounded0">Location </label>
                                          <input type="text" class="form-control" rows="3" placeholder="Location here ..." name="location"/>
                                          @error('location')
                                                <span class="text-danger text-sm">{{ $message }}</span>                              
                                          @enderror
                                        </div>
                                        <div class="col-sm">
                                          <label for="exampleSelectRounded0">No. Unit </label>
                                          <input type="number" class="form-control" rows="3" placeholder="Number" name="no_unit"/>
                                        </div>
                                      </div>
                    
                                      <div class="row">
                                          <div class="col-sm">
                                            <div class="form-group">
                                              <label for="exampleSelectRounded0">Related Dept.</label>
                                                <select class="custom-select rounded-0" id="id_department" name="id_department">
                                                    <option disable>-- Select Here -- </option>
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
                                              <label for="exampleSelectRounded0">Nature of Request  </label>
                                                  <select class="custom-select rounded-0" id="id_part" name="id_part">
                                                    <option disable>-- Select Here -- </option>
                                    
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
                                        <button type="submit" class="btn btn-outline-success btn-block mb-5"><i class="fa fa-edit    "></i> SUBMIT</button>
                                    </div>
                    
                                    <!-- end form imnput -->
                    
                                    </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
  </div>
<!-- Main Body Ends -->



  
@endsection


@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
@endpush

@push('custom-scripts')
<script>
   //  display image
   var SITEURL = '{{URL::to('')}}';
   $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
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
                $("#id_part").append('<option>---Select Here---</option>');
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