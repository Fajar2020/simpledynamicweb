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
                    <div class="card-group">
                        @foreach($portfolios as $portfolio)
                            <div class="col-md-4 mt-5">
                                <div class="card">
                                    <div class="card-header">
                                        {{$portfolio->folio_name}}
                                        <a href="{{ url('home/portfolio/delete/'.$portfolio->id) }}" 
                                        style="margin-left: 20px" onClick="return confirm('Are you sure you want to delete this portfolio?')"><i class='bx bxs-trash' ></i></a>
                                    </div>
                                    <div class="card-body">
                                        <p>
                                            {{$portfolio->short_desc}}
                                        </p>
                                        <img src="{{asset($portfolio->image)}}" class="img-thumbnail" style = "width: 200px"/>
                                    </div> 
                                    <div class="card-footer">
                                        <h5>
                                            Category: {{$portfolio->category->category_name}}
                                        </h5>
                                    </div>    
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- form for add new brand -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Portfolio
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.home.portfolio') }}" method="POST" enctype="multipart/form-data">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="folio_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('folio_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Short Description <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="short_desc" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('short_desc')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Category <span class="text-danger">*</span></label>
                                    <br />
                                    <select class="form-control" name="category_id" aria-label="Default select example">
                                        @foreach($categories as $category)
                                            <option value="{{$category->id}}">{{$category->category_name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Images <span class="text-danger">*</span></label>
                                    <input type="file" class="form-control" name="image[]" multiple="" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('image')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <button type="submit" class="btn btn-primary">Add Images</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>
@endsection
