@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Edit Brand
                        </div>
                        <div class="card-body">
                            <form action="{{ url('brand/update/'.$brand->id) }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <input type="hidden" name="old_image" value="{{$brand->brand_image}}" />
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="brand_name" id="exampleInputEmail1" value="{{$brand->brand_name}}" aria-describedby="emailHelp">
                                    @error('brand_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Image <span class="text-danger">*</span></label>
                                    <img src="{{asset($brand->brand_image)}}" alt="{{$brand->brand_name}}" class="img-thumbnail" style = "width: 150px"/>
                                    <input type="file" class="form-control" name="brand_image" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$brand->brand_image}}">
                                    @error('brand_image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="row" style="display: flex;">
                                    <button type="submit" class="btn btn-primary" style="flex:1;margin:10px">Update</button>
                                    <a href="{{ route('all.brand') }}" class="btn btn-danger" style="flex:1; margin:10px">Cancel</a>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
