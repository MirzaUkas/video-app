@extends('default')

@section('content')

<div class="container mt-5">
    <div class="panel panel-primary">
        <div class="panel-heading">
            <h2>Edit Video</h2>
        </div>
        <div class="panel-body">
            @if ($message = Session::get('success'))
            <div class="alert alert-success alert-block">
                <button type="button" class="close" data-dismiss="alert">×</button>
                <strong>{{ $message }}</strong>
            </div>
            @endif

            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <strong>Whoops!</strong> There were some problems with your input.
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif

            <form action="{{ route('videos.update', $video->id) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="row">

                    <div class="col-md-12">
                        <div class="col-md-6 form-group">
                            <label>Title:</label>
                            <input type="text" name="title" class="form-control" value="{{$video->title}}" />
                        </div>
                        <div class="col-md-6 form-group">
                            <label>Select Video:</label>
                            <input type="file" name="video" class="form-control" value="{{$video->path}}" />
                        </div>
                        <div class="col-md-6 form-group">
                            <button type="submit" class="btn btn-success">Save</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>

