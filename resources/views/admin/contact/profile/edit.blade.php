@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-8">
                    <div class="card">
                        <div class="card-header">
                            Edit Contact Profile
                        </div>
                        <div class="card-body">
                        <form action="{{ url('contact/profile/update/'.$contact->id) }}" method="POST">
                            @csrf
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Address <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="address" value="{{$contact->address}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('address')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Email <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="email" value="{{$contact->email}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('email')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="mb-3">
                                    <label for="exampleInputEmail1" class="form-label">Phone <span class="text-danger">*</span></label>
                                    <input type="text" class="form-control" name="phone" value="{{$contact->phone}}" id="exampleInputEmail1" aria-describedby="emailHelp">
                                    @error('phone')
                                        <span class="text-danger">{{ $message }}</span>
                                    @enderror
                                </div>
                                
                                <div class="row" style="display: flex;">
                                    <button type="submit" class="btn btn-primary" style="flex:1;margin:10px">Update</button>
                                    <a href="{{ route('contact.profile') }}" class="btn btn-danger" style="flex:1; margin:10px">Cancel</a>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
