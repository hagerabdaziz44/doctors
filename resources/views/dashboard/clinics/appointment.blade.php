

@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">Bookings</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">dashbaord</a>
                                </li>
                                <li class="breadcrumb-item active">Bookings
                                </li>
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
                                    <h4 class="card-title">Bookings</h4>
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
                                                <th>Patient Name</th>
                                                <th>Patient Phone</th>
                                                <th>Doctor Name</th>
                                                <th>Hour</th>
                                                <th>Date</th>
                                                <th>fee</th>
                                                <th>status</th>
                                            
                                             

                                               
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($appointments)
                                                @foreach($appointments as $appointment)
                                                    <tr>
                                                        <td>{{$appointment ->patient->name}}</td>
                                                        <td>{{$appointment ->patient->phone}}</td>
                                                        <td>{{$appointment ->doctor->name_ar}}</td>
                                                        
                                                        <td>{{$appointment->doctorappointment->hour}}</td>
                                                        <td>{{$appointment->date}}</td>
                                                        <td>{{$appointment->fee}}</td>
                                                        <td>{{$appointment->status}}</td>

                                                     
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
