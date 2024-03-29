@extends('layouts.app')

@section('content')

@if($message = Session::get('success'))

<div class="alert alert-success">
    {{ $message }}
</div>

@endif

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Tasks</b></div>
            <div class="col col-md-6">
                <a href="{{ route('tasks.create') }}" class="btn btn-success btn-sm float-end">Create</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <table class="table table-bordered">
            <tr>
                <th>ID</th>
                <th>Content</th>
                <th>Status</th>
                <th>Action</th>
            </tr>
            @if(count($tasks) > 0)

                @foreach($tasks as $task)

                    <tr>
                        <td>{{ $task->id }}</td>
                        <td>
                            @if($task->status === "In-progress")
                                {{ $task->content }}
                            @else
                                <span style="color: {{ $task->status === 'Completed' ? 'green' : 'red' }};"><s>{{ $task->content }}</s></span>
                            @endif
                        </td>
                        <td>{{ $task->status }}</td>
                        <td>
                            <form method="post" action="{{ route('tasks.destroy', $task->id) }}">
                                @csrf
                                @method('DELETE')
                                <a href="{{ route('tasks.show', $task->id) }}" class="btn btn-primary btn-sm">View</a>
                                <a href="{{ route('tasks.edit', $task->id) }}" class="btn btn-warning btn-sm">Edit</a>
                                <input type="submit" class="btn btn-danger btn-sm" value="Delete" />
                            </form>
                        </td>
                    </tr>

                @endforeach

            @else
                <tr>
                    <td colspan="5" class="text-center">No Task Found</td>
                </tr>
            @endif
        </table>

        <div class="w-100 d-flex justify-content-center">
            {!! $tasks->links() !!}
        </div>
    </div>
</div>

@endsection
