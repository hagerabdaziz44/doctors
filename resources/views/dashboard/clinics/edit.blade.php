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
                            <li class="breadcrumb-item"><a href="">العيادات </a>
                            </li>
                            <li class="breadcrumb-item active"> انشاء عيادة
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
                                <h4 class="card-title" id="basic-layout-form">انشاء عيادة</h4>
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
                                    <form class="form" action="{{route('clinics.update',$clinic->id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf


                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> {{Auth::user()->name }}</h4>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الاسم باللغة الانجليزية</label>
                                                        <input type="text" id="name_en" class="form-control" value="{{$clinic->name_en}}" placeholder="" name="name_en" required>
                                                        @error("name_en")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">الاسم باللغة العربية</label>
                                                        <input type="text" id="name_ar" class="form-control" value="{{$clinic->name_ar}}" placeholder="" name="name_ar" required>
                                                        @error("name_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">البريد الالكتروني</label>
                                                        <input type="email" id="email" class="form-control" value="{{$clinic->email}}" placeholder="" name="email" required>
                                                        @error("email")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> رابط الموقع</label>
                                                        <input type="text" id="location_link" class="form-control" value="{{$clinic->location_link}}" placeholder="" name="location_link" required>
                                                        @error("location_link")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> المحتوي باللغة الانجليزية
                                                        </label>
                                                        <textarea name="description_en" id="description" class="form-control" placeholder="  ">{{$clinic->description_en}}</textarea>

                                                        @error("description_en")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> المحتوي باللغة العربية
                                                        </label>
                                                        <textarea name="description_ar" id="description" class="form-control" placeholder="  ">{{$clinic->description_ar}}</textarea>

                                                        @error("description_ar")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>



                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">خط العرض</label>
                                                        <input type="text" id="lat" class="form-control" value="{{$clinic->lat}}" placeholder="" name="lat" required>
                                                        @error("lat")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">خط الطول</label>
                                                        <input type="text" id="lat" class="form-control" value="{{$clinic->long}}" placeholder="" name="long" required>
                                                        @error("long")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">رقم الهاتف</label>
                                                        <input type="text" id="phone" class="form-control" value="{{$clinic->phone}}" placeholder="" name="phone" required>
                                                        @error("phone")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">التخصصات
                                                        </label>
                                                        <select name="specialization[]" class="select2 form-control" multiple>

                                                            <optgroup label="  select the specialization ">

                                                                @foreach($s as $specialization)
                                                                <option value="{{$specialization -> id }}" {{ (in_array($specialization -> id, $m)) ? 'selected' : '' }}>{{$specialization -> name_ar}}</option>
                                                                @endforeach

                                                            </optgroup>

                                                        </select>
                                                        @error('specialization.0')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">شركات التأمين
                                                        </label>
                                                        <select name="insurances[]" class="select2 form-control" multiple>

                                                            <optgroup label="  select the insurance ">
                                                                @if($insurances && $insurances -> count() > 0)
                                                                @foreach($insurances as $insurance)
                                                                <option value="{{$insurance -> id }}" {{ (in_array($insurance -> id, $I)) ? 'selected' : '' }}>{{$insurance -> title_ar}}</option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>

                                                        </select>
                                                        @error('insurances.0')
                                                        <span class="text-danger"> {{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> فيديو </label>
                                                        <input type="text" id="video" class="form-control" value="{{$clinic->video}}" placeholder=" " name="video" required>
                                                        @error("video")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            

                                              
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1">whatsapp</label>
                                                        <input type="text" id="end" class="form-control" value="{{$clinic->whatsapp}}" placeholder="" name="whatsapp" required>
                                                        @error("end")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> instagram</label>
                                                        <input type="text" id="end" class="form-control" value="{{$clinic->instagram}}" placeholder="" name="instagram" required>
                                                        @error("end")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> facebook</label>
                                                        <input type="text" id="end" class="form-control" value="{{$clinic->facebook}}" placeholder="" name="facebook" required>
                                                        @error("end")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                                
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>الشعار</label>
                                                        <input type="file" name="logo" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>الصور</label>
                                                            <input type="file" accept="image/*" multiple name="images[]"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                           
                                            <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label>اقصي عدد من الاطباء</label>
                                                            <input type="number" value="{{$clinic->max_doctor}}" name="max_doctor"
                                                                class="form-control">
                                                        </div>
                                                    </div>
                                            </div>
                                            
                                            <label for="projectinput1">المواعيد</label>
                                                <table class="table table-bordered" >
                                                    <tr>
                                                        <th>اليوم</th>
                                                        <th>بداية الشيفت الاول</th>
                                                        <th>نهاية الشيفت الاول</th>
                                                        <th>بداية الشيفت الثاني</th>
                                                        <th>نهاية الشيفت الثاني</th>
                                                        
</tr>
@foreach($appointments as $appointment)
                                                    <tr>
                                                        <td><input hidden type="text" name="day_id[]" class="form-control name_list" value="{{$appointment->day_id}}" required />{{$appointment->days->name_ar}}</td>
                                                        <td><input type="time" name="start1[]" class="form-control name_list"  value="{{$appointment->start1}}"/></td>
                                                        <td><input type="time" name="end1[]" class="form-control name_list" value="{{$appointment->end1}}"  /></td>
                                                        <td><input type="time" name="start2[]" class="form-control name_list"  value="{{$appointment->start2}}"/></td>
                                                        <td><input type="time" name="end2[]" class="form-control name_list" value="{{$appointment->end2}}"  />
                                                        </td>

                                                        
                                                    </tr>
                                                    @endforeach
                                                     </table>
                                      <label for="projectinput1">العناوين</label>
                                         <button type="button" name="add" id="add" class="btn btn-success">اضافه جديد</button>
                                         <br>
                                                <table class="table table-bordered" id="dynamic_field">
                                                    <tr>
                                                        <th>العنوان باللغة العربية</th>
                                                        <th>العنوان باللغة الانجليزية</th>
                                                      
                                                        
</tr>
@foreach($address as $ad)
                                                    <tr>
                                                        <td><input  type="text" name="address_ar[]" class="form-control name_list"  required value="{{$ad->address_ar}}" /></td>
                                                        <td><input type="text" name="address_en[]" class="form-control name_list" required value="{{$ad->address_en}}" /></td>
                                                        
</tr>

@endforeach                                                  
                                                   
                                               
                                                </table>
                                                


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
        $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><input type="text" name="address_ar[]"  class="form-control name_list" required /></td><td><input type="test" name="address_en[]"  class="form-control name_list" required /></td> <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

    });

    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
</script>
@stop
