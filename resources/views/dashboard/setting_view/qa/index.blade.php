

@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">الاسئلة والاجوبة</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('qa.create') }}">اضافة اسئلة واجوبة  </a>
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
{{--                                    <h4 class="card-title"> الاسئلة والاجوبة  </h4>--}}
                                    <li class="breadcrumb-item"><a href="{{ route('qa.create') }}" class="btn btn-info">اضافة اسئلة واجوبة  </a>
                                    </li>
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
                                                {{--                                                <th><input type="checkbox" id="checkboxall"/></th>--}}
                                                <th> السؤال باللغة العربية </th>
                                                <th> السؤال باللغة الانجليزية </th>
                                                <th> الاجابة باللغة العربية </th>
                                                <th> الاجابة باللغة الانجليزية </th>
                                                <th>العمليات</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($qa)
                                                @foreach($qa as $q)
                                                    <tr>
                                                        <td>
                                                            {{$q->title_ar}}
                                                        </td>
                                                        <td>
                                                            {{$q->title_en}}
                                                        </td>
                                                        <td>
                                                            {{ $q->description_ar }}
                                                        </td>


                                                            <td>
                                                                {{ $q->description_en }}
                                                            </td>




                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{ route('qa.update',$q->id) }}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href="{{ route('settings.destroy',$q->id) }}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">حذف</a>

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
