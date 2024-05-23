@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <h3 class="content-header-title">Client Information</h3>
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item active">Client Information
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
                                <h4 class="card-title">Client Information </h4>
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
                                <div class="card-body card-dashboard">
                                    <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                        <thead class="">
                                            <tr>
                                                <th>ID</th>
                                                <th>Description</th>
                                                <th>Clinic</th>
                                                <th>User</th>
                                                <th>Actions</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            @foreach($info as $info)
                                            <tr>
                                                <td>{{ $info->id }}</td>
                                                <td>{{ $info->description }}</td>
                                                <td>{{ $info->clinic->name_ar }}</td>
                                                <td>{{ $info->patient->name  }}</td>
                                                <td>
                                                    <a href="{{ route('reception.edit', $info->id) }}" class="btn btn-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>
                                                    <a href="{{ route('reception.destroy', $info->id) }}" class="btn btn-danger btn-min-width box-shadow-3 mr-1 mb-1">Delete</a>

                                                </td>
                                            </tr>
                                            @endforeach



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