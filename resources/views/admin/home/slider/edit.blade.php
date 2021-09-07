@extends('admin.admin_master')

@section('admin')

    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Edit Slider</h2>
        </div>
        <div class="card-body">
            <form action="{{ url('slider/update/'.$slider->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <input type="hidden" name="old_image" value="{{$slider->image}}" />
                                
                <div class="form-group">
                    <label for="slider_title">Title</label>
                    <input type="text" class="form-control" name="slider_title" id="slider_title" placeholder="Please fill in your title" value="{{$slider->title}}">
                </div>
                <div class="form-group">
                    <label for="slider_description">Description</label>
                    <textarea class="form-control" name="slider_description" id="slider_description" rows="3">{{$slider->description}}</textarea>
                </div>
                <div class="form-group">
                    <label for="exampleFormControlFile1">Image</label><br />
                    <img src="{{asset($slider->image)}}" alt="{{$slider->title}}" class="img-thumbnail" style = "width: 150px"/>
                    <input type="file" class="form-control-file" name="slider_image" id="exampleFormControlFile1">
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    <a class="btn btn-secondary btn-default" href="{{route('all.slider')}}">Cancel</a>
                </div>
            </form>
        </div>
    </div>

@endsection
