
@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('contact_us.index') }}">تواصل معنا  </a>
                                </li>
                                <li class="breadcrumb-item active">  أضافه تواصل معنا
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->

                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> أضافه تواصل معنا </h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>
                                @include('dashboard.includes.alerts.success')
                                @include('dashboard.includes.alerts.errors')
                                <div class="card-content collapse show">
                                    <div class="card-body">
                                        <form class="form"
                                              action="{{ route('contact_us.store') }}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> {{Auth::user()->name }}</h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  الاسم باللغة العربية</label>
                                                            <input type="text" name="title_ar" autofocus class="form-control" value="{{ old('title_ar') }}" required>
                                                            @error("title_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الاسم باللغة الانجليزية </label>
                                                            <input type="text" name="title_en" autofocus class="form-control" value="{{ old('title_en') }}" required>
                                                            @error("title_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                    
                                                         <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">  العنوان باللغة العربية </label>
                                                            <input type="text" name="address_ar" autofocus class="form-control" value="{{ old('address_ar') }}" required>
                                                            @error("address_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                        <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">   العنوان ياللغة الانجليزية  </label>
                                                            <input type="text" name="address_en" autofocus class="form-control" value="{{ old('address_en') }}" required>
                                                            @error("address_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> رقم الهاتف</label>
                                                            <input type="text" name="phone" autofocus class="form-control" value="{{ old('phone') }}" required>
                                                            @error("phone")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1">البريد الالكتروني</label>
                                                            <input type="email" name="email" autofocus class="form-control" value="{{ old('email') }}" required>
                                                            @error("email")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    
                                                

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الصورة</label>
                                                            {{--                                                        <input type="text" name="icon" autofocus class="form-control" placeholder="FontAweson Icon Ex : fa fa-facebook" value="{{ old('icon') }}" required>--}}
                                                            <input type="file" name="image" class="form-control" required>
                                                            @error("image")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>


                                                </div>

                                            </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> اضافة
                                                </button>
                                            </div>
                                        </form>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop
