
@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="">
                                    العرضات</a>
                                </li>
                                <li class="breadcrumb-item active"> اضافة عرض جديد
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
                                              action="{{route('admin.offers.store')}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf



                                          <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> اضافة عرض جديد </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>الاسم باللغة العربية</label>
                                                            <input type="text" class="form-control @error('name_ar') is-invalid
                                                            @enderror" name="name_ar" placeholder="" required>
                                                            @error('name_ar')
                                                                <div class="alert alert-danger">   {{$message}}</div>
                                                            @enderror
                                                          </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                     <label>الاسم باللغة الانجليزية</label>
                                                       <input type="text" class="form-control @error('name_en') is-invalid

                                                            @enderror" name="name_en" placeholder="" required>
                                                          @error('name_en')
                                                           <div class="alert alert-danger">   {{$message}}</div>
                                                         @enderror
                                                          </div>
                                                      </div>
                                                </div>
                                                

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الوصف باللغة العربية
                                                            </label>
                                                            <textarea  name="body_ar" id="description_ar"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                            >{{old('body_ar')}}</textarea>

                                                            @error("description_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الوصف باللغة الانجليزية
                                                            </label>
                                                            <textarea  name="body_en" id="description_en"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                            >{{old('body_en')}}</textarea>

                                                            @error("body_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    </div>


                                                    </div>
                                                    <div class="row">
                                                    <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> العيادات
                                                        </label>
                                                        <select name="clinic_id" class="select2 form-control">
                                                            <optgroup label="please select category">
                                                                @if ($clinics && $clinics->count() > 0)
                                                                @foreach ($clinics as $clinic)
                                                                <option value="{{ $clinic->id }}">
                                                                    {{ $clinic->name_ar}}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('clinic_id')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

</div>

                                                     



                                              







                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1"
                                                        onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                <button type="submit" class="btn btn-primary">
                                                    <i class="la la-check-square-o"></i> اضافة
                                                </button>
                                            </div>
                                            </div>
                                        </form>



                                    </div>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                    </div>

                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop



