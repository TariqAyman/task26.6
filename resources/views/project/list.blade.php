@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
               @include('layouts.messages')

                <div class="card card-new-task">
                    <div class="card-header">New Project</div>

                    <div class="card-body">
                        <form method="POST" action="{{ route('projects.store') }}">
                            @csrf
                            <div class="form-group">
                                <label for="title">Title</label>
                                <input id="title" name="title" type="text" maxlength="255" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" autocomplete="off"/>
                            </div>
                            <button type="submit" class="btn btn-primary">Create</button>
                        </form>
                    </div>
                </div>
                <br>
                <div class="card">
                    <div class="card-header">Projects</div>

                    <div class="card-body">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <td>
                                    Title
                                </td>
                                <td>
                                    Task Done
                                </td>
                                <td>
                                    Task InProgress
                                </td>
                                <td>
                                    Progress percentage
                                </td>
                                <td>
                                    Action
                                </td>
                            </tr>
                            </thead>
                            @foreach ($projects as $project)
                                <tr>
                                    <td>
                                        <a href="/tasks/?project_id={{ $project->id }}">
                                            {{ $project->title }}
                                        </a>
                                    </td>

                                    <td>
                                        {{ $project->taskDoneCount }}
                                    </td>
                                    <td>
                                        {{ $project->taskInProgressCount }}
                                    </td>
                                    <td>
                                        {{ $project->progressPercentage }}
                                    </td>
                                    <td class="text-right">
                                        <a href="{{ route('projects.edit',$project->id)}}" class="btn btn-primary">Edit</a>

                                        <form action="{{ route('projects.destroy', $project->id)}}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit">Delete</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </table>

                        {{ $projects->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
