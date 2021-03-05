@extends('layouts.app')


@section('content')
<div class="container">
    <div class="row">
        @if(auth()->user()->education() && $files->count() == 0)
        <div class="col-md-12 text-right">
            <button type="button" class="btn btn-info btn-sm" data-toggle="modal" data-target="#exampleModal">Add</button>
        </div>
        @endif
        @if($files->count() > 0 )
        <div class="col-md-12 text-left">
            <h1>Qualification file</h1>
        </div>
        @foreach ($files as $file )

        <div class="col-sm-3">
            <div class="card">
                <div class="card-body">
                    <h5 class="card-title">{{ $file->name }}</h5>
                    <p class="card-text">Schooljaar: #</p>
                    <div class="flex">
                        <a href="{{url('qualification_file')}}/{{$file->id}}" class="btn btn-sm btn-primary">View</a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
        @else
        <div>No qualification file yet.</div>
        @endif
    </div>
</div>






<!-- create modal  -->
@if(auth()->user()->education())
<div>
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">New Qualification</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form class="form-group" method="POST" enctype="multipart/form-data" action="{{ route('qualification_file.store') }}">
                        @csrf
                        <div>
                            <input type="text" hidden name="user_id" value="{{ Auth()->id() }}">
                            <div class="form-group">
                                <label for="name">Name</label>
                                <input type="text" name="name" class="form-control" id="name" required>

                                @error('name')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="form-group">
                                <label for="file">File (.pdf only)</label>
                                <input type="file" accept=".pdf" name="file" class="form-control" id="file" required>

                                @error('file')
                                <span class="text-danger">{{ $message }}</span>
                                @enderror
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endif
@if (!App\Models\Fileupload::all()->count() > 0)
<script>
    $(document).ready(function() {
        $('#exampleModal').modal('show');
    });
</script>
@endif

@endsection