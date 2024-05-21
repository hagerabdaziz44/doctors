@extends('layouts.admin')
@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="container">

                <form action="{{route('admin.users.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>User Name</label>
                      <input type="text" class="form-control @error('name') is-invalid

                      @enderror" name="name" placeholder="Enter Your Name">
                      @error('name')
                          <div class="alert alert-danger">   {{$message}}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label>User Email</label>
                        <input type="email" class="form-control @error('email') is-invalid

                        @enderror" name="email" placeholder="Enter Your E-mail">
                        @error('email')
                        <div class="alert alert-danger">   {{$message}}</div>
                       @enderror
                    </div>
                    <div class="form-group">
                        <label>User Phone</label>
                        <input type="number" class="form-control @error('phone') is-invalid

                        @enderror" name="phone" placeholder="Enter Your Mobile Number">
                        @error('phone')
                        <div class="alert alert-danger">   {{$message}}</div>
                       @enderror
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" class="form-control" name="password" placeholder="Enter Your Password">
                    </div>
                    <div class="form-group">
                        <label>Password Confirmation</label>
                        <input type="password" class="form-control" name="password_confirm"  placeholder="confirm Your Password">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary " type="submit">Add User</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection
