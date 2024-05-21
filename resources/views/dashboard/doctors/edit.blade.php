@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Dashboard </a>
                            </li>
                            <li class="breadcrumb-item"><a href="">Clients </a>
                            </li>
                            <li class="breadcrumb-item active"> Create Client
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
                                <h4 class="card-title" id="basic-layout-form"> Create Client </h4>
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
                                    <form class="form" action="{{route('doctors.update',$doctor->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf


                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> {{Auth::user()->name }}</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الاسم باللغة الانجليزية</label>
                                                        <input value ="{{$doctor->name_en}}" type="text" id="name_en" class="form-control" value="{{old('name_en')}}" placeholder=" ادخل الاسم باللغة الانجليزية" name="name_en" required>
                                                        @error("name_en")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الاسم باللغة العربية</label>
                                                        <input
                                                        value ="{{$doctor->name_ar}}"
                                                        type="text" id="name_ar" class="form-control" value="{{old('name_ar')}}" placeholder=" ادخل الاسم باللغة العربية" name="name_ar" required>
                                                        @error("name_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>





                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> التخصص
                                                        </label>
                                                        <select name="specialization_id" class="select2 form-control">
                                                            <optgroup label="please select category">
                                                                @if ($specializations && $specializations->count() > 0)
                                                                @foreach ($specializations as $specialization)
                                                                <option value="{{ $specialization->id }}" {{ $doctor->specialization_id == $specialization->id ? 'selected' : '' }}
                                                                    >{{
                                                                     $specialization->name_ar}}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('specialization_id')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> العيادات
                                                        </label>
                                                        <select name="clinic_id" class="select2 form-control">
                                                            <optgroup label="please select category">
                                                                @if ($clinics && $clinics->count() > 0)
                                                                @foreach ($clinics as $clinic)
                                                                <option value="{{ $clinic->id }}" {{ $doctor->clinic_id == $clinic->id ? 'selected' : '' }}>
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
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">التكلفة</label>
                                                        <input value="{{$doctor->cost}}" type="number" id="cost" class="form-control" value="{{old('cost')}}" placeholder=" ادخل التكلفة" name="cost" required>
                                                        @error("cost")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                             <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> التعليم بالغة العربية</label>
                                                            <textarea required name="education_ar" id="education_ar"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                            >{{$doctor->education_ar}}</textarea>

                                                            @error("education_ar")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                 <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> التعليم باللغة الانجليزية </label>
                                                            <textarea  name="education_en" id="education_en"
                                                                   class="form-control"
                                                                   placeholder="  "
                                                            >{{$doctor->education_ar}}</textarea>

                                                            @error("body_en")
                                                            <span class="text-danger">{{$message}}</span>
                                                            @enderror
                                                        </div>
                                                    </div>




                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الصورة</label>
                                                        <input type="file" name="image" class="form-control">
                                                        @error("image")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                               
                                              

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
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
@section('script')

<script>
    var i = 1;


    $('#add').click(function() {
        i++;
        $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><select name="day_ids[]" class="form-control item_unit">@foreach($days as $day)<option value="{{$day->id}}">{{$day->name_ar}}</option>@endforeach</select></td> <td><input type="time" name="hours[]"  class="form-control name_list" required /></td> <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

    });


    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
</script>
@stop