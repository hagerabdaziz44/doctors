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
                        <th scope="col">size in Arabic </th>
                        <th scope="col">size in English</th>
                        <th scope="col">Actions</th>
                      </tr>
                    </thead>
                    <tbody>
                        <div>
                           <a class="btn btn-primary mb-2" href="{{route('admin.sizes.create')}}"> Craete Size</a>
                        </div>
                   @foreach ($sizes as $size)
                   <tr>
                    <th scope="row">{{$size->id}}</th>
                    <td>{{$size->name_ar}}</td>
                    <td>{{$size->name_en}}</td>
                    <td><a href="{{route('admin.sizes.edit',$size->id)}}" class="btn btn-success">Edit</a></td>
                    <td><a href="{{route('admin.sizes.delete',$size->id)}}" class="btn btn-danger">Delete</a></td>
                  </tr>
                   @endforeach
                    </tbody>
                </table>
            </div>

        </div>
    </div>
</div>


@endsection
