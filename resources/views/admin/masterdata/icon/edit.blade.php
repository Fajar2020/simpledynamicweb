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
                            <form action="{{ url('icon/update/'.$icon->id) }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="icon_name" id="exampleInputEmail1" aria-describedby="emailHelp" value="{{$icon->icon_name}}">
                                    @error('icon_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Icon <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="icon_img" id="exampleInputEmail1" aria-describedby="emailHelp" placeholder="bx bx-taxi" value="{{$icon->icon_img}}">
                                    @error('icon_img')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="row" style="display: flex;">
                                    <button type="submit" class="btn btn-primary" style="flex:1;margin:10px">Update</button>
                                    <a href="{{ route('all.icon') }}" class="btn btn-danger" style="flex:1; margin:10px">Cancel</a>
                                </div>
                                
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
