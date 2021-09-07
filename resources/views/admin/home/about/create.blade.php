@extends('admin.admin_master')

@section('admin')

    <div class="card card-default">
        <div class="card-header card-header-border-bottom">
            <h2>Add Home About</h2>
        </div>
        <div class="card-body">
            <form action="{{ route('store.home.about') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="slider_title">Title</label>
                    <input type="text" class="form-control" name="title" id="title" placeholder="Please fill in your title">
                </div>
                <div class="form-group">
                    <label for="short_desc">Short Description</label>
                    <textarea class="form-control" name="short_desc" id="short_desc" rows="3"></textarea>
                </div>
                <div class="form-group">
                    <label for="long_desc">Long Description</label>
                    <textarea class="form-control" name="long_desc" id="long_desc" rows="6"></textarea>
                </div>
                <div class="form-footer pt-4 pt-5 mt-4 border-top">
                    <button type="submit" class="btn btn-primary btn-default">Submit</button>
                    <a class="btn btn-secondary btn-default" href="{{route('home.about')}}">Cancel</a>
                </div>
            </form>
        </div>
    </div>

<script>
    ClassicEditor.create( document.querySelector( '#long_desc' ) ).catch( error => {
        console.error( error );
    } );
</script>
@endsection
