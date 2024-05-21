

@extends('layouts.admin')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">تواصل معنا</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية</a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{ route('contact_us.create') }}">اضافة تواصل معنا  </a>
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
{{--                                    <h4 class="card-title">تواصل معنا   </h4>--}}
                                    <li class="breadcrumb-item"><a href="{{ route('contact_us.create') }}" class="btn btn-info">اضافة تواصل معنا  </a>
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
                                                <th>الاسم باللغة العربية</th>
                                                <th>الاسم باللغة الانجليزية</th>
                                                <th>العنوان باللغة العربية</th>
                                                 <th>العنوان باللغة الانجليزية</th>
                                                  <th>رقم الهاتف</th>
                                                   <th>البريد الالكتروني</th>
                                                <th>الصورة</th>
                                                <th>العمليات</th>

                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($contact_us)
                                                @foreach($contact_us as $contact)
                                                    <tr>

                                                        <td>
                                                            {{$contact->title_ar}}
                                                        </td>

                                                            <td>
                                                                {{$contact->title_en}}
                                                            </td>

                                                        <td>
                                                            {{ $contact->description_ar }}
                                                        </td>
                                                         <td>
                                                            {{ $contact->description_en }}
                                                        </td>
                                                           <td>
                                                            {{ $contact->phone }}
                                                        </td>
                                                           <td>
                                                            {{ $contact->email }}
                                                        </td>
                                                        <td>
                                                            <img src= {{URL::to('/images/settings/'. $contact->icon)}} style="width:50px;">
                                                        </td>


                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">
                                                                <a href="{{ route('contact_us.update',$contact->id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">تعديل</a>


                                                                <a href="{{ route('settings.destroy',$contact->id) }}"
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
