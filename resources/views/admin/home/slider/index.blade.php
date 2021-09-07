@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h3 style="margin-bottom: 20px">Home Slider</h3>
                <br/>
                <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <a href="{{route('add.slider')}}" type="button" class="btn btn-outline-primary" style="margin-bottom: 20px">Add Slider</a>
                    <div class="card">
                        <div class="card-header">
                            All Sliders
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col" width="5%">SL No.</th>
                                    <th scope="col" width="15%">Title</th>
                                    <th scope="col" width="25%">Description</th>
                                    <th scope="col" width="15%">Image</th>
                                    <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($sliders as $slider)
                                        <tr>
                                            <th scope="row">{{$sliders->firstItem()+$loop->index}}</th>
                                            <td>{{$slider->title}}</td>
                                            <td>{{$slider->description}}</td>
                                            <td><img src="{{asset($slider->image)}}" alt="{{$slider->title}}" class="img-thumbnail" style = "width: 70px"/></td>
                                            <td>
                                                <a href="{{ url('slider/edit/'.$slider->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('slider/delete/'.$slider->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete slider {{$slider->title}}?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$sliders->links()}}
                        </div>
                    </div>
                </div>

                
            </div>


        </div>
    </div>

@endsection
