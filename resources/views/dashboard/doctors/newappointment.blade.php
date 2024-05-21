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
                                    <form class="form" action="{{route('appointment.store',$doctor_id)}}" method="POST" enctype="multipart/form-data">
                                        @csrf


                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> {{Auth::user()->name }}</h4>
                                            <div class="row">
                                            
                                            <input value= "{{$doctor_id}}" type="hidden" 
                                                                       name="doctor_id" checked
                                                                       id="switcheryColor4"
                                                                       class="switchery" data-color="success"
                                                                    />
                                                    <div class="col-md-12"><h4>Working Days</h4></div>
                                                    @foreach($days as $day)
                                                    <div class="col-md-2">
                                                            <div class="form-group mt-1">
                                                                <input value= "{{$day->id}}" type="checkbox" 
                                                                       name="day_ids[]" checked
                                                                       id="switcheryColor4"
                                                                       class="switchery" data-color="success"
                                                                    />
                                                                <label for="switcheryColor4"
                                                                       class="card-title ml-1">{{$day->name_ar}}</label>

                                                                @error("hours[]")
                                                                <span class="text-danger">{{$message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                      @endforeach
                                                    <div class="col-md-12"><h4>Choose AM Time</h4></div>
                                                   
                                                @foreach($times as $time)
                                                        <div class="col-md-2">
                                                            <div class="form-group mt-1">
                                                                <input value= "{{$time->value}}" type="checkbox" 
                                                                       name="hours[]"
                                                                       id="switcheryColor4"
                                                                       class="switchery" data-color="success"
                                                                    />
                                                                <label for="switcheryColor4"
                                                                       class="card-title ml-1">{{$time->name}}</label>

                                                                @error("hours[]")
                                                                <span class="text-danger">{{$message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                       @endforeach
                                                        <div class="col-md-12"><h4>Choose PM Time</h4></div>
                                                   
                                                
                                                        @foreach($times_pm as $time_pm)
                                                        <div class="col-md-2">
                                                            <div class="form-group mt-1">
                                                                <input value= "{{$time_pm->value}}" type="checkbox" 
                                                                       name="hours[]"
                                                                       id="switcheryColor4"
                                                                       class="switchery" data-color="success"
                                                                    />
                                                                <label for="switcheryColor4"
                                                                       class="card-title ml-1">{{$time_pm->name}}</label>

                                                                @error("hours[]")
                                                                <span class="text-danger">{{$message }}</span>
                                                                @enderror
                                                            </div>
                                                        </div>
                                                       @endforeach
                                                   
                                                       
                                                     
                                                    
                                                    
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
        $('#dynamic_field').append('<tr id="row' + i + '" class="dynamic-added"><td><select name="day_ids[]" class="form-control item_unit">@foreach($days as $day)<option value="{{$day->id}}">{{$day->name_ar}}</option>@endforeach</select></td> <td><input type="time" name="hours[][]"  class="form-control name_list" required /></td> <td><button type="button" name="remove" id="' + i + '" class="btn btn-danger btn_remove">X</button></td></tr>');

    });


    $(document).on('click', '.btn_remove', function() {
        var button_id = $(this).attr("id");
        $('#row' + button_id + '').remove();
    });
</script>
@stop