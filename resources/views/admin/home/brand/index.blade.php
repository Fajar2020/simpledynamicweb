@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            All Brands
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col">SL No.</th>
                                    <th scope="col">Name</th>
                                    <th scope="col">Image</th>
                                    <th scope="col">Created At</th>
                                    <th scope="col">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($brands as $brand)
                                        <tr>
                                            <th scope="row">{{$brands->firstItem()+$loop->index}}</th>
                                            <td>{{$brand->brand_name}}</td>
                                            <td><img src="{{asset($brand->brand_image)}}" alt="{{$brand->brand_name}}" class="img-thumbnail" style = "width: 70px"/></td>
                                            <td>
                                            @if($brand->created_at == NULL)
                                                <span class="text-danger">No date set</span>
                                            @else
                                                {{Carbon\Carbon::parse($brand->created_at)->diffForHumans()}}
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('brand/edit/'.$brand->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('brand/delete/'.$brand->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete brand {{$brand->brand_name}}?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$brands->links()}}
                        </div>
                    </div>
                </div>

                <!-- form for add new brand -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Brand
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.brand') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Image <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="brand_image" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <button type="submit" class="btn btn-primary">Add New Brand</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
