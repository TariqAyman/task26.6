@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                @include('layouts.messages')

                <div class="card card-new-task">
                    <div class="card-header">Edit Task</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.update',$task->id) }}">
                            @method('PATCH')
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off" value="{{ $task->title }}"/>
                            </div>
                            <div class="form-group">
                                <label for="project_id">Project</label>
                                <select class="form-control" name="project_id" id="project_id">
                                    <option> Select Project </option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ $project->id == $task->project_id ? 'selected' : '' }}> {{ $project->title }} </option>
                                    @endforeach
                                </select>
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
