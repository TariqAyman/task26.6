@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">

                @include('layouts.messages')

                <div class="card card-new-task">
                    <div class="card-header">New Task</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('tasks.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off"/>
                            </div>
                            <div class="form-group">
                                <label for="project_id">Project</label>
                                <select class="form-control" name="project_id" id="project_id">
                                    <option> Select Project </option>
                                    @foreach($projects as $project)
                                        <option value="{{ $project->id }}" {{ request()->has('project_id') && request()->get('project_id') == $project->id ? 'selected' : '' }}> {{ $project->title }} </option>
                                    @endforeach
                                </select>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">Tasks {{ request()->has('project_id') ? 'in Project : ' . \App\Project::find(request()->get('project_id'))->title : '' }}</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>
                                    Title
                                </td>
                                <td>
                                    Project
                                </td>
                                <td>
                                    Status
                                </td>
                                <td>
                                    Action
                                </td>
                            </tr>
                            </thead>
                            @foreach ($tasks as $task)
                                <tr>
                                    <td>
                                        @if ($task->status == \App\Helpers\TaskStatus::Done)
                                            <s>{{ $task->title }}</s>
                                        @else
                                            {{ $task->title }}
                                        @endif
                                    </td>
                                    <td>
                                        {{ $task->project->title }}
                                    </td>
                                    <td class="text-right">
                                        @if ($task->status == \App\Helpers\TaskStatus::InProgress)
                                            <form method="POST" action="{{ route('tasks.update', $task->id) }}">
                                                @csrf
                                                @method('PATCH')
                                                <input hidden name="status" value="{{ \App\Helpers\TaskStatus::Done  }}">
                                                <button type="submit" class="btn btn-primary">Complete</button>
                                            </form>
                                        @else
                                            <button class="btn btn-success">Done</button>
                                        @endif
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('tasks.edit',$task->id)}}" class="btn btn-primary">Edit</a>
                                        <form action="{{ route('tasks.destroy', $task->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>
                        {{ $tasks->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
