@extends('layouts.master_auth')

@push('plugin-styles')
    {!! Html::style('assets/css/loader.css') !!}
    {!! Html::style('assets/css/authentication/auth_2.css') !!}
@endpush

@section('content')
    <!-- Main Body Starts -->
    <div class="login-two">
        <div class="container-fluid login-two-container">
            <div class="row main-login-two">
                <div class="col-xl-8 col-lg-7 col-md-7 d-none d-md-block p-0">
                    <div class="login-bg">
                        <div class="left-content-area">
                           
                            
                            <div>
                                {{-- <h2>{{__('A few clicks away from creating your account')}}</h2>
                                <p>{{__('Start your journey in minutes. Save your time and money.')}}</p>
                                <a class="btn mt-4" href="javascript:void(0)" type="button">{{__('Learn More')}}</a> --}}
                            </div>
                            <div class="d-flex align-items-center mt-4">
                                {{-- <a class="font-13 text-white mr-3">{{__('Find us: ')}}</a>
                                <a class="font-13 text-white mr-3" href="javascript:void(0)">{{__('Facebook')}}</a>
                                <a class="font-13 text-white mr-3" href="javascript:void(0)">{{__('Twitter')}}</a>
                                <a class="font-13 text-white mr-3" href="javascript:void(0)">{{__('Linked In')}}</a> --}}
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-xl-4 col-lg-5 col-md-5 p-0">
                    <div class="login-two-start">
                        <form method="POST" action="{{ route('login') }}">
                        @csrf
                        <div class="logo mt-5">
                            <img src="{{url('image/bie.png')}}" style="max-width: 150px;"/>
                        </div>
                        
                        {{-- <h6 class="right-bar-heading px-3 mt-2 text-dark text-center font-30 text-uppercase">{{__('Login')}}</h6> --}}
                        <p class="text-center text-muted mt-1 font-14">{{__('Please Log into your account')}}</p>
                        <div class="login-two-inputs mt-2">
                            <input name="email" id="email" class="form-control" type="email" placeholder="{{__('Username')}}" required autocomplete="email" autofocus/>
                            <i class="las la-user-alt"></i>
                           
                        </div>
                        @error('email')
                        <span class="invalid-feedback text-danger" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                        <div class="login-two-inputs mt-4">
                            <input id="password" type="password" placeholder="Password" class="form-control @error('password') is-invalid @enderror" name="password" required/>
                            <i class="las la-lock"></i>
                            
                        </div>
                        @error('password')
                                <span class="invalid-feedback text-danger" role="alert">
                                    <strong>{{ $message }}</strong>
                                </span>
                            @enderror
                        <div class="login-two-inputs  mt-4 check">
                            <div class="box">
                                <input type="checkbox" class="custom-control-input" id="item_checkbox" name="item_checkbox" value="one">
                                <span class="check"></span>
                                <label for="one">{{__('Remember me')}}</label>
                            </div>
                        </div>
                        <div class="login-two-inputs mt-5 text-center d-flex">
                            <button class="ripple-button ripple-button-primary w-100 btn-login ml-3 mr-3" type="submit">
                                <div class="ripple-ripple js-ripple">
                                    <span class="ripple-ripple__circle"></span>
                                </div>
                                {{__('Login')}}
                            </button>
                            
                        </div>
                        <div class="mt-4 text-center font-12 strong">
                            <a href="{{url('/authentications/style2/forgot-password')}}" class="text-primary">{{__('Forgot your Password ?')}}</a>
                        </div>
                        <div class="login-two-inputs mt-4">
                            <div class="find-us-container">
                                <p class="find-us text-center">{{__('Find Us :')}}</p>
                            </div>
                        </div>
                        <div class="login-two-inputs social-logins mt-4">
                            <div class="social-btn">
                                <a href="https://www.facebook.com/PT.BIIE/"  target="_blank" class="fb-btn"><i class="lab la-facebook-f"></i></a>
                            </div>
                            <div class="social-btn">
                                <a href="https://id.linkedin.com/company/biie?trk=public_post_feed-actor-name" target="_blank" class="twitter-btn"><i class="lab la-linkedin-in"></i>
                            </div>
                            <div class="social-btn">
                                <a href="https://www.instagram.com/biieofficial/" target="_blank" class="google-btn"><i class="lab la-instagram"></i></a>
                            </div>
                        </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Main Body Ends -->
@endsection

@push('plugin-scripts')
    {!! Html::script('assets/js/loader.js') !!}
    {!! Html::script('assets/js/libs/jquery-3.6.0.min.js') !!}
    {!! Html::script('plugins/bootstrap/js/bootstrap.min.js') !!}
    {!! Html::script('assets/js/authentication/auth_2.js') !!}
@endpush

@push('custom-scripts')

@endpush