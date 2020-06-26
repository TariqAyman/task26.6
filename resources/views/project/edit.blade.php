@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('layouts.messages')
                <div class="card card-new-task">
                    <div class="card-header">Edit Project</div>
                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.update',$project->id) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ $project->title }}"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Update</button>
                        </form>
                    </div>
                </div>
                <br>
            </div>
        </div>
    </div>
@endsection
