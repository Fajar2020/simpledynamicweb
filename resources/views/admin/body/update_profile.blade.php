@extends('admin.admin_master')

@section('admin')

<div class="card card-default">
    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show" role="alert">
            <strong>{{session('success')}}</strong>
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif
    <div class="card-header card-header-border-bottom">
        <h2>User Profile Update</h2>
    </div>
    <div class="card-body">
    
        <form method="POST" action="{{ route('profile.update') }}" class="form-pill" enctype="multipart/form-data">
            @csrf
            <input type="hidden" name="old_image" value="{{Auth::user()->profile_photo_url}}" />
                                
            <div class="form-group">
                <label for="exampleFormControlPassword1">User Name</label>
                <input type="text" class="form-control" name="name" value="{{$user->name}}">
            </div>

            <div class="form-group">
                <label for="exampleFormControlPassword1">User Email</label>
                <input type="text" class="form-control" name="email" value="{{$user->email}}">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1" class="form-label">Profile Image</label><br />
                <img src="{{Auth::user()->profile_photo_url}}" class="img-circle" alt="User Image" class="img-thumbnail" style = "width: 150px"/>
                <input type="file" class="form-control" name="profile_photo_path" id="exampleInputEmail1" aria-describedby="emailHelp">
            </div>

            <button type="submit" class="btn btn-primary btn-default" >Update</button>
        </form>
    </div>
</div>

@endsection