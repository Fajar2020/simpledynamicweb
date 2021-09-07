@extends('admin.admin_master')

@section('admin')

    <div class="py-12">
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                    <div class="card">
                        <div class="card-header">
                            All Contact Message
                        </div>
                        <div class="card-body">
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th scope="col" width="15%">SL No.</th>
                                        <th scope="col" width="25%">Name</th>
                                        <th scope="col" width="20%">Email</th>
                                        <th scope="col" width="20%">Subject</th>
                                        <th scope="col" width="30%">Action</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    
                                    @foreach($messages as $msg)
                                        <tr>
                                            <th scope="row">{{$messages->firstItem()+$loop->index}}</th>
                                            <td>{{$msg->name}}</td>
                                            <td>{{$msg->email}}</td>
                                            <td>{{$msg->subject}}</td>
                                            <td>
                                                <a href="{{ url('contact/message/delete/'.$msg->id) }}" class="btn btn-danger" onClick="return confirm('Are you sure you want to delete?')">Delete</a>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td colspan="5">
                                                Message: <br />
                                                {{$msg->message}}
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <nav>
                            <ul class="pagination border-rounded">
                                {{$messages->links()}}
                            </ul>
                            </nav>
                            
                        </div>
                    </div>
                </div>

                
            </div>


        </div>
    </div>

@endsection
