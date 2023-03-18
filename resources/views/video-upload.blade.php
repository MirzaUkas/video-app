@extends('default')

@section('content')

<body>
    <div class="container mt-5">
        <div class="panel panel-primary">
            <div class="panel-heading">
                <h2>Laravel Video Upload </h2>
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

                <form action="{{ route('videos.store') }}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">

                        <div class="col-md-12">
                            <div class="col-md-6 form-group">
                                <label>Title:</label>
                                <input type="text" name="title" class="form-control" />
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Select Video:</label>
                                <input type="file" name="video" class="form-control" />
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
    <div class="container">

        <table class="table table-bordered">
            <tr>
                <th>No</th>
                <th>Title</th>
                <th>Video</th>
                <th>Created At</th>
                <th width="280px">Action</th>
            </tr>
            @foreach ($videos as $key=>$video)
            <tr>
                <td>{{ ++$key }}</td>
                <td>{{ $video->title }}</td>
                <td>
                    <video width="320" height="240" controls>
                        <source src="{{asset('storage/' . $video->path)}}" type="video/mp4">
                    </video>
                </td>
                <td>{{ $video->created_at }}</td>
                <td>
                    <form action="{{ route('videos.destroy',$video->id) }}" method="POST">

                        <a class="btn btn-primary" href="{{ route('videos.edit',$video->id) }}">Edit</a>

                        @csrf
                        @method('DELETE')

                        <button type="submit" class="btn btn-danger">Delete</button>
                    </form>
                </td>
            </tr>
            @endforeach
        </table>
    </div>
</body>
