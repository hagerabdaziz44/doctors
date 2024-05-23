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
                            <li class="breadcrumb-item active"> Create Client information
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
                                <h4 class="card-title" id="basic-layout-form"> Create Client information </h4>
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
                                    <form class="form" action="{{route('reception.store')}}" method="POST" enctype="multipart/form-data">
                                        @csrf
                                        <div class="form-body">

                                            <h4 class="form-section"><i class="ft-home"></i>Reception</h4>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group mt-1">
                                                        <input id="toggleCheckbox" type="checkbox" name="type" class="switchery" data-color="success" />

                                                        <label class="card-title ml-1">
                                                            Not registered yet
                                                        </label>
                                                    </div>
                                                </div>

                                                <div class="col-md-6 inputContainer" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="toggleInput1">الاسم</label>
                                                        <input id="toggleInput1" type="text" class="form-control @error('name') is-invalid @enderror" name="name" placeholder="Enter Your Name">
                                                        @error("name")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 inputContainer" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="toggleInput2">User Email</label>
                                                        <input id="toggleInput2" type="email" class="form-control @error('email') is-invalid @enderror" name="email" placeholder="Enter Your E-mail">
                                                        @error('email')
                                                        <div class="text-danger"> {{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 inputContainer" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="toggleInput3">Phone Number</label>
                                                        <input id="toggleInput3" type="number" class="form-control @error('phone') is-invalid @enderror" name="phone" placeholder="Enter Your Phone Number">
                                                        @error('phone')
                                                        <div class="text-danger"> {{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6 inputContainer" style="display: none;">
                                                    <div class="form-group">
                                                        <label for="toggleInput4">Password</label>
                                                        <input id="toggleInput4" type="password" class="form-control @error('password') is-invalid @enderror" name="password" placeholder="Enter Your Password">
                                                        @error('password')
                                                        <div class="text-danger"> {{$message}}</div>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <label>Patient's medical history</label>
                                                        <textarea class="form-control @error('description') is-invalid @enderror" name="description" placeholder="Enter Description"></textarea>
                                                        @error('description')
                                                        <div class="text-danger"> {{$message}}</div>
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
                                                                <option value="{{ $clinic->id }}">
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
                                                                <option value="{{ $user->id }}">
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
    document.addEventListener('DOMContentLoaded', function() {
        const checkbox = document.getElementById('toggleCheckbox');
        const inputContainers = document.querySelectorAll('.inputContainer');
        const userDropdown = document.querySelector('.userDropdown');

        // Function to show or hide the input fields based on checkbox state
        function toggleInputs() {
            inputContainers.forEach(container => {
                container.style.display = checkbox.checked ? 'block' : 'none';
            });
        }

        // Function to show or hide the user dropdown based on checkbox state
        function toggleUserDropdown() {
            userDropdown.style.display = checkbox.checked ? 'none' : 'block';
        }

        // Initial check when the page loads
        toggleInputs();
        toggleUserDropdown();

        // Add event listener to the checkbox
        checkbox.addEventListener('change', function() {
            toggleInputs();
            toggleUserDropdown();
        });
    });
</script>
@stop