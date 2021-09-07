<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Multi Pictures
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="container">
            <div class="row">
                @if(session('success'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('success')}}</strong>
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                    </div>
                @endif
                <div class="col-md-8">
                    <div class="card-group">
                        @foreach($images as $image)
                            <div class="col-md-4 mt-5">
                                <div class="card">
                                    <img src="{{asset($image->image)}}"/>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>

                <!-- form for add new brand -->
                <div class="col-md-4">
                    <div class="card">
                        <div class="card-header">
                            Multi Images
                        </div>
                        <div class="card-body">
                            <form action="{{ route('store.image') }}" method="POST" enctype="multipart/form-data">
                                @csrf
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
</x-app-layout>
