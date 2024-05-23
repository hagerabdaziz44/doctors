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
                            <li class="breadcrumb-item active"> Edit Client Information
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
                                <h4 class="card-title" id="basic-layout-form"> Edit Client Information </h4>
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
                                    <form class="form" action="{{ route('reception.update', $client->id) }}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                       
                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i>Reception</h4>
                                            <div class="row">
                                             
                                               
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Patient's medical history</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter Description">{{ $client->description }}</textarea>
                                                        @error('description')
                                                        <div class="alert alert-danger"> {{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> clinic
                                                        </label>
                                                        <select name="clinic_id" class="select2 form-control">
                                                            <optgroup label="please select clinic">
                                                                @if ($clinics && $clinics->count() > 0)
                                                                @foreach ($clinics as $clinic)
                                                                <option value="{{ $clinic->id }}" @if($client->clinic_id == $clinic->id) selected @endif>
                                                                    {{ $clinic->name_ar}}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('clinic')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 userDropdown">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> users
                                                        </label>
                                                        <select name="user_id" class="select2 form-control">
                                                            <optgroup label="please select clinic">
                                                                @if ($users && $users->count() > 0)
                                                                @foreach ($users as $user)
                                                                <option value="{{ $user->id }}" @if($client->user_id == $user->id) selected @endif>
                                                                    {{ $user->name}}
                                                                </option>
                                                                @endforeach
                                                                @endif
                                                            </optgroup>
                                                        </select>
                                                        @error('user')
                                                        <span class="text-danger"> {{ $message }}</span>
                                                        @enderror
                                                    </div>
                                                </div>

                                            </div>
                                        </div>

                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1" onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> تحديث
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