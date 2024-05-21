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
                                <li class="breadcrumb-item"><a href="">{{trans('admin.terms')}}</a>
                                </li>
                                <li class="breadcrumb-item active"> {{trans('admin.edit.offer')}}
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
                                    <h4 class="card-title" id="basic-layout-form"> {{trans('admin.edit.term')}}</h4>
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
                                              action="{{route('admin.terms.update',$term->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf


                                            <div class="form-body">
 <h4 class="form-section"><i class="ft-home"></i> {{trans('admin.edit.term')}} </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                           <label>{{trans('admin.name_ar')}}</label>
                                                            <input type="text"
                                                            value="{{$term->name_ar}}"
                                                            class="form-control

                                                            @error('name_ar') is-invalid

                                                            @enderror" name="name_ar" placeholder="">
                                                            @error('name_ar')
                                                                <div class="alert alert-danger">   {{$message}}</div>
                                                            @enderror
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                    <label>{{trans('admin.name_en')}}</label>
                                                       <input type="text"
                                                       value="{{$term->name_en}}"
                                                       class="form-control @error('name_en') is-invalid

                                                            @enderror" name="name_en" placeholder="">
                                                          @error('name_en')
                                                           <div class="alert alert-danger">   {{$message}}</div>
                                                         @enderror
                                                          </div>
                                                      </div>
                                                </div>
                                               

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                          <label>{{trans('admin.desc_ar')}}</label>
                                                            <textarea
                                                            value="{{$term->body_ar}}"
                                                            
                                                             name="body_ar" id="body_ar"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                            >
                                                                {{$term->body_ar}}
                                                                </textarea>

                                                            @error("body_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                       <label>{{trans('admin.desc_en')}}</label>
                                                            <textarea
                                                            value="{{$term->body_en}}"
                                                              name="body_en" id="description_en"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                            >{{$term->body_en}}</textarea>

                                                            @error("description_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    </div>
                                                  


                                                


                                                    </div>


                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> <label>{{trans('admin.back')}}</label>
                                                </button>
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i><label>{{trans('admin.edit')}}</label>
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
