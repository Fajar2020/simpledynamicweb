@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
        @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            All Services
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col" width="10%">SL No.</th>
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="20%">Description</th>
                                    <th scope="col" width="20%">Icon</th>
                                    <th scope="col" width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($services as $service)
                                        <tr>
                                            <th scope="row">{{$services->firstItem()+$loop->index}}</th>
                                            <td>{{$service->name}}</td>
                                            <td>{{$service->description}}</td>
                                            <td><i class="{{$service->icon}}"></i></td>
                                            <td>
                                                <a href="{{ url('home/service/edit/'.$service->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('home/service/delete/'.$service->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete icon {{$service->name}}?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$services->links()}}
                        </div>
                    </div>
                </div>

                <!-- form for add new brand -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Service
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.home.service') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Description <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="description" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Icon <span class="text-danger">*</span></label>
                                    <br />
                                    <select class="form-control" name="icon" aria-label="Default select example">
                                        @foreach($icons as $icon)
                                            <option value="{{$icon->icon_img}}" data-content="<i class='{{$icon->icon_img}}'></i>">{{$icon->icon_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <button type="submit" class="btn btn-primary">Add New Service</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
