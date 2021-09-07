@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <h3 style="margin-bottom: 20px">Home About</h3>
                <br/>
                <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <a href="{{route('add.home.about')}}" type="button" class="btn btn-outline-primary" style="margin-bottom: 20px">Add About</a>
                    <div class="card">
                        <div class="card-header">
                            All Home About
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col" width="7%">SL No.</th>
                                    <th scope="col" width="13%">Title</th>
                                    <th scope="col" width="15%">Short Description</th>
                                    <th scope="col" width="25%">Long Description</th>
                                    <th scope="col" width="15%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($homeAbouts as $about)
                                        <tr>
                                            <th scope="row">{{$homeAbouts->firstItem()+$loop->index}}</th>
                                            <td>{{$about->title}}</td>
                                            <td>{{$about->short_desc}}</td>
                                            <td>{{$about->long_desc}}</td>
                                            <td>
                                                <a href="{{ url('home/about/edit/'.$about->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('home/about/delete/'.$about->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete about {{$about->title}}?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$homeAbouts->links()}}
                        </div>
                    </div>
                </div>

                
            </div>


        </div>
    </div>

@endsection
