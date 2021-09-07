@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Edit Service
                        </div>
                        <div class="card-body">
                            <form action="{{ url('home/service/update/'.$service->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="name" value="{{$service->name}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Description <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="description" value="{{$service->description}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('description')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Icon <span class="text-danger">*</span></label>
                                    <br />
                                    <select class="form-control" name="icon" value="{{$service->icon}}" aria-label="Default select example">
                                        @foreach($icons as $icon)
                                            <option value="{{$icon->icon_img}}"
                                            @php
                                            if($service->icon == $icon->icon_img){echo("selected");}
                                            @endphp
                                            
                                            >{{$icon->icon_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="row" style="display: flex;">
                                    <button type="submit" class="btn btn-primary" style="flex:1;margin:10px">Update</button>
                                    <a href="{{ route('home.service') }}" class="btn btn-danger" style="flex:1; margin:10px">Cancel</a>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
