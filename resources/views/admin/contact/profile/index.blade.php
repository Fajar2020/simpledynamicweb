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
                            All Contact Profiles
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                    <th scope="col" width="15%">SL No.</th>
                                    <th scope="col" width="25%">Address</th>
                                    <th scope="col" width="20%">Email</th>
                                    <th scope="col" width="20%">Phone</th>
                                    <th scope="col" width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach($profiles as $profile)
                                        <tr>
                                            <th scope="row">{{$profiles->firstItem()+$loop->index}}</th>
                                            <td>{{$profile->address}}</td>
                                            <td>{{$profile->email}}</td>
                                            <td>{{$profile->phone}}</td>
                                            <td>
                                                <a href="{{ url('contact/profile/edit/'.$profile->id) }}" class="btn btn-info">Edit</a>
                                                <a href="{{ url('contact/profile/delete/'.$profile->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            {{$profiles->links()}}
                        </div>
                    </div>
                </div>

                <!-- form for add new brand -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Add Contact Profile
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.contact.profile') }}" method="POST">
                                @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <button type="submit" class="btn btn-primary">Add New Contact Profile</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>


        </div>
    </div>

@endsection
