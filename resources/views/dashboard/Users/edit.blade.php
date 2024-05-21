@extends('layouts.admin')
@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="container">

                <form action="{{route('admin.users.update',$user->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>User Name</label>
                      <input type="text" class="form-control" name="name"  value="{{$user->name}}">
                    </div>
                    <div class="form-group">
                        <label>User Email</label>
                        <input type="email" class="form-control" name="email" value="{{$user->email}}">
                    </div>
                    <div class="form-group">
                        <label>User Phone</label>
                        <input type="number" class="form-control" name="phone"  value="{{$user->phone}}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary " type="submit">Edit User</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>


@endsection
