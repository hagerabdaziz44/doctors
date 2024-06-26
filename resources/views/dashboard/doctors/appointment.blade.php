

@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                         
                                                       
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> <a href="{{route('appointment.store',$doctor_id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">{{trans('admin.add.appointment')}}</a></h3>
                    <h3 class="content-header-title">المواعيد</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">{{trans('admin.dashboard')}}</a>
                                </li>
                                <li class="breadcrumb-item active">{{trans('admin.appointments')}}</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            
            <div class="content-body">

                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title"> {{trans('admin.all_appointments')}} </h4>
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
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th># </th>
                                                <th>{{trans('admin.day')}}</th>
                                                <th>{{trans('admin.hour')}}</th>
                                                <th>{{trans('adminaction')}}</th>
                                            
                                             

                                               
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($appointments)
                                                @foreach($appointments as $appointment)
                                                    <tr>
                                                        <td>{{$appointment -> id}}</td>
                                                        <td>{{$appointment ->days->name_ar}}</td>
                                                        <td>{{$appointment->hour}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                


                                                                  <a href="{{route('appointments.delete',$appointment->id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">{{trans('admin.delete')}}</a>
                                                             

                                                            </div>
                                                        </td>

                                                     
                                                    </tr>
                                                @endforeach
                                            @endisset


                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop
