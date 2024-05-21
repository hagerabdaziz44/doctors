@extends('layouts.admin')
@section('content')


<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="container">
                <table class="table">
                    <thead>
                      <tr>
                        <th scope="col">id</th>
                        <th scope="col">Name</th>
                        <th scope="col">Email</th>
                        <th scope="col">Phone</th>
                        <th scope="col">Action</th>
                      </tr>
                    </thead>
                    <tbody>
                        <div>
                           <a class="btn btn-primary mb-2" href="{{route('admin.users.create')}}"> Craete User</a>
                        </div>
                   @foreach ($users as $user)
                   <tr>
                    <th scope="row">{{$user->id}}</th>
                    <td>{{$user->name}}</td>
                    <td>{{$user->email}}</td>
                    <td>{{$user->phone}}</td>
                    <td><a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-success">Edit</a></td>
                    <td><a href="{{route('admin.users.delete',$user->id)}}" class="btn btn-danger">Delete</a></td>

                  </tr>

                   @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


@endsection
