@extends('layouts.admin')
@section('content')
<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="container">

                <form action="{{route('admin.sizes.store')}}" method="POST">
                    @csrf
                    <div class="form-group">
                      <label>Size Name in Arabic</label>
                      <input type="text" class="form-control @error('name_ar') is-invalid
                      @enderror" name="name_ar" placeholder="Enter Size name in Arabic">
                      @error('name_ar')
                          <div class="alert alert-danger">   {{$message}}</div>
                      @enderror
                    </div>
                    <div class="form-group">
                        <label>Size Name in English</label>
                        <input type="text" class="form-control @error('name_en') is-invalid

                        @enderror" name="name_en" placeholder="Enter Size name in English">
                        @error('name_en')
                        <div class="alert alert-danger">   {{$message}}</div>
                       @enderror
                    </div>
                    <div class="form-group">
                        <button class="btn btn-primary " type="submit">Add Size</button>
                    </div>
                </form>
            </div>

        </div>
    </div>
</div>
@endsection
