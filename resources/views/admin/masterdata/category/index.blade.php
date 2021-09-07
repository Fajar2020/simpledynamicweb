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
                            All Categories
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col" width="10%">SL No.</th>
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="20%">User</th>
                                    <th scope="col" width="20%">Created At</th>
                                    <th scope="col" width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($categories as $category)
                                        <tr>
                                            <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                            <td>{{$category->category_name}}</td>
                                            <td>{{$category->user->name}}</td>
                                            <td>
                                            @if($category->created_at == NULL)
                                                <span class="text-danger">No date set</span>
                                            @else
                                                {{Carbon\Carbon::parse($category->created_at)->diffForHumans()}}
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('category/edit/'.$category->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('category/softDelete/'.$category->id) }}" class="btn btn-danger">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$categories->links()}}
                        </div>
                    </div>
                </div>

                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Category
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.category') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Name <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="category_name" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('category_name')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror

                                </div>
                                <button type="submit" class="btn btn-primary">Add New Category</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


            <!-- trash category -->
            <div class="row" style="margin-top: 40px">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            All Categories in Trash
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col" width="10%">SL No.</th>
                                    <th scope="col" width="20%">Name</th>
                                    <th scope="col" width="20%">User</th>
                                    <th scope="col" width="20%">Deleted At</th>
                                    <th scope="col" width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($trashCategories as $category)
                                        <tr>
                                            <th scope="row">{{$categories->firstItem()+$loop->index}}</th>
                                            <td>{{$category->category_name}}</td>
                                            <td>{{$category->user->name}}</td>
                                            <td>
                                            @if($category->deleted_at == NULL)
                                                <span class="text-danger">No date set</span>
                                            @else
                                                {{Carbon\Carbon::parse($category->deleted_at)->diffForHumans()}}
                                            @endif
                                            </td>
                                            <td>
                                                <a href="{{ url('category/restore/'.$category->id) }}" class="btn btn-info">Restore category</a>
                                                <a href="{{ url('category/pdelete/'.$category->id) }}" class="btn btn-danger">Delete Permanenly</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$trashCategories->links()}}
                        </div>
                    </div>
                </div>

            </div>

            <!-- end trash -->

        </div>
    </div>
@endsection
