@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="container">
                <form action="{{route('admin.sizes.update',$size->id)}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Size Name in Arabic</label>
                      <input type="text" class="form-control" name="name_ar"  value="{{$size->name_ar}}">
                    </div>
                    <div class="form-group">
                        <label>Size Name in English</label>
                        <input type="text" class="form-control" name="name_en" value="{{$size->name_en}}">
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary " type="submit">Edit Size</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
