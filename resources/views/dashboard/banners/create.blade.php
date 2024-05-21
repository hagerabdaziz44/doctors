@extends('layouts.admin')
@section('content')

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">الرئيسية</a>
                            </li>
                            <li class="breadcrumb-item"><a href="">
                                    اللوحات الاعلانية</a>
                            </li>
                            <li class="breadcrumb-item active"> اضافة لوحة اعلانية جديدة
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
                                    <form class="form" action="{{route('admin.banners.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf



                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i> اضافة لوحة اعلانية جديدة</h4>



                                            <div class="row">

                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label>الصور</label>
                                                        <input type="file" name="banner" class="form-control">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> العيادة
                                                            </label>
                                                            <select name="clinic_id" class="select2 form-control">
                                                                <optgroup label="please select clinic">
                                                                    @if ($clinics && $clinics->count() > 0)
                                                                        @foreach ($clinics as $clinic)
                                                                            <option value="{{ $clinic->id }}">
                                                                                {{ $clinic->name_ar}}</option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('clinic')
                                                                <span class="text-danger"> {{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                            </div>

                                            <div class="form-actions">
                                                <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                    <i class="ft-x"></i> تراجع
                                                    <button type="submit" class="btn btn-primary">
                                                        <i class="la la-check-square-o"></i> اضافة
                                                    </button>
                                            </div>
                                        </div>
                                    </form>



                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>

        <!-- // Basic form layout section end -->
    </div>
</div>
</div>

@stop
