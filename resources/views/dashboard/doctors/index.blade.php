

@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">الاطباء</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item active">الاطباء
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
                                    <h4 class="card-title">جميع الاطباء   </h4>
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
                                                <th>الاسم </th>
                                              
                                                <!--<th>رقم الهاتف</th>-->
                                                <th>التخصص</th>
                                                <th>السعر</th>
                                             

                                                <!--<th>النوع</th>-->
                                                <th>الصورة</th>
                                                <th>العمليات</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($doctors)
                                                @foreach($doctors as $doctor)
                                                    <tr>
                                                        <td>{{$doctor -> id}}</td>
                                                        <td>{{$doctor -> name_ar}}</td>
                                                        
                                                        <!--<td>{{$doctor -> phone}}</td>-->
                                                        <td>{{$doctor ->specialization->name_ar}}</td>
                                                        <td>{{$doctor -> cost}}</td>
                                                    


                                                        <!--<td>{{$doctor -> gender}}</td>-->

                                                        <td><img src= {{URL::to('/images/doctors/'. $doctor->photo)}} style="width:50px;"></td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{route('doctors.edit',$doctor->id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                  <a href="{{route('doctors.delete',$doctor->id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>
                                                             <a href="{{route('doctors.appointments',$doctor->id)}}"
                                                                   class="btn btn-outline-success btn-min-width box-shadow-3 mr-1 mb-1">المواعيد</a>

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
