

@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">الحجوزات</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">الحجوزات
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
                                    <h4 class="card-title">جميع الحجوزات   </h4>
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
                                                
                                                <th>اسم المريض</th>
                                                <th>رقم هاتف المريض</th>
                                                <th>البريد الالكتروني الخاص بالمريض</th>
                                                <th>اسم العيادة</th>
                                                <th>اسم الطبيب</th>
                                                <th>رقم هاتف العيادة</th>
                                                <th>التاريخ</th>
                                                <th>الساعة</th>
                                             

                                                <th>التكلفة</th>
                                              
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($booking_list)
                                                @foreach($booking_list as $booking)
                                                    <tr>
                                                   
                                                        <td>{{$booking -> id}}</td>
                                                        <td>{{$booking ->patient->name}}</td>
                                                    <td>{{$booking ->patient->phone}}</td>
                                                    <td>{{$booking ->patient->email}}</td>
                                                        <td>{{$booking ->clinic->name_ar }}</td>
                                                        <td>{{$booking ->doctor->name_ar}}</td>
                                                        <td>{{$booking ->clinic-> phone}}</td>
                                                        <td>{{$booking ->date}}</td>
                                                        <td>{{$booking ->doctorappointment->type
                                                            .''.$booking ->doctorappointment->hour}}</td>
                                                        <td>{{$booking -> fee}}</td>
                                                    


                                                       

                                                     
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
