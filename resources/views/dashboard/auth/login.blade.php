@extends('layouts.login')

@section('content')

    <section class="flexbox-container">
        <div class="col-12 d-flex align-items-center justify-content-center">
            <div class="col-md-4 col-10 box-shadow-2 p-0">
                <div class="card border-grey border-lighten-3 m-0">
                    <div class="card-header border-0">
                        <div class="card-title text-center">
                            <!-- <div class="p-1">
                                <img src="{{asset('assets/front/images/logo.png')}}" alt="LOGO"/>

                            </div> -->
                        </div>
                        <h6 class="card-subtitle line-on-side text-muted text-center font-small-3 pt-2">
                            <span>Dashboard </span>
                        </h6>
                    </div>
                    @include('dashboard.includes.alerts.errors')
                    @include('dashboard.includes.alerts.success')

                    <div class="card-content">
                        <div class="card-body">
                            <form class="form-horizontal form-simple" action="{{route('login')}}" method="post"
                                  novalidate>
                                @csrf
                                <input type="hidden" value="{{$type}}" name="type">
                                <fieldset class="form-group position-relative has-icon-left mb-0">
                                    <input type="text" name="email" class="form-control form-control-lg input-lg"
                                           value="" id="email" placeholder=" Enter Email ">
                                    <div class="form-control-position">
                                        <i class="ft-user"></i>
                                    </div>
                                    @error('email')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror

                                </fieldset>
                                <fieldset class="form-group position-relative has-icon-left">
                                    <input type="password" name="password" class="form-control form-control-lg input-lg"
                                           id="user-password"
                                           placeholder="Enter Password">
                                    <div class="form-control-position">
                                        <i class="la la-key"></i>
                                    </div>
                                    @error('password')
                                    <span class="text-danger">{{$message}}</span>
                                    @enderror


                                </fieldset>

                                <button type="submit" class="btn btn-info btn-lg btn-block"><i class="ft-unlock"></i>
                                    Login
                                </button>
                            </form>
                        </div>
                    </div>

                </div>
            </div>
        </div>
    </section>

@stop
