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
                            All Icons
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">SL No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Icon</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($icons as $icon)
                                        <tr>
                                            <th scope="row">{{$icons->firstItem()+$loop->index}}</th>
                                            <td>{{$icon->icon_name}}</td>
                                            <td><i class="{{$icon->icon_img}}"></i></td>
                                            <td>
                                            @if($icon->created_at == NULL)
                                                <span class="text-danger">No date set</span>
                                            @else
                                                {{Carbon\Carbon::parse($icon->created_at)->diffForHumans()}}
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('icon/edit/'.$icon->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('icon/delete/'.$icon->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete icon {{$icon->icon_name}}?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$icons->links()}}
                            
                        </div>
                    </div>
                </div>

                <!-- form for add new brand -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Icon
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.icon') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="icon_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('icon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Icon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="icon_img" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="bx bx-taxi">
                                    @error('icon_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <button type="submit" class="btn btn-primary">Add New Icon</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
