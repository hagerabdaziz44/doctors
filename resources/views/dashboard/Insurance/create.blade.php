@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                    <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">{{trans('admin.dashboard')}}</a>
                            </li>
                            <li class="breadcrumb-item"><a href=""> {{trans('admin.insurance')}}</a>
                            </li>
                            <li class="breadcrumb-item active"> {{trans('admin.add.insurance')}}</li>
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
                                <h4 class="card-title" id="basic-layout-form">{{trans('admin.add.insurance')}}</h4>
                                <a class="heading-elements-toggle"><i class="la la-ellipsis-v font-medium-3"></i></a>
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
                                    <form class="form" action="{{route('insurance.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf


                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i>{{trans('admin.insurance')}}</h4>
                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> {{trans('admin.name_ar')}}</label>
                                                        <input type="text" id="title_ar" class="form-control" placeholder="  " value="{{old('title_ar')}}" name="title_ar">
                                                        @error("title_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> {{trans('admin.name_en')}}</label>
                                                        <input type="text" id="title_en" class="form-control" placeholder="  " value="{{old('title_en')}}" name="title_en">
                                                        @error("title_en")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('admin.phone')}}</label>
                                                        <input type="text" id="phone" class="form-control" value="{{old('phone')}}" placeholder="" name="phone" required>
                                                        @error("phone")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">{{trans('admin.email')}}</label>
                                                        <input type="email" id="email" class="form-control" value="{{old('email')}}" placeholder="" name="email" required>
                                                        @error("email")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> {{trans('admin.desc_ar')}}</label>
                                                        <textarea name="body_ar" id="description" class="form-control" placeholder="  ">{{old('body_ar')}}</textarea>

                                                        @error("body_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> {{trans('admin.desc_eb')}}</label>
                                                        <textarea name="body_en" id="description" class="form-control" placeholder="  ">{{old('body_en')}}</textarea>

                                                        @error("body_en")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>{{trans('admin.image')}}</label>
                                                        <input type="file" name="photo" class="form-control">
                                                    </div>
                                                </div>



                                            </div>





                                        </div>

                                </div>

                                <div class="form-actions">
                                    <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                        <i class="ft-x"></i> {{trans('admin.back')}}</button>
                                    <button type="submit" class="btn btn-primary">
                                        <i class="la la-check-square-o"></i>{{trans('admin.add')}}</button>
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
