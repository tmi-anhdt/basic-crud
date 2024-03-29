@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">Edit Task</div>
    <div class="card-body">
        <form method="post" action="{{ route('tasks.update', $task->id) }}" enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Task Content</label>
                <div class="col-sm-10">
                    <input type="text" name="content" class="form-control" value="{{ $task->content }}" />
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-2 col-label-form">Status</label>
                <div class="col-sm-10">
                    <select id="status" name="status" value="{{ $task->status }}"">
                        <option value="Completed" @selected($task->status === 'Completed')>Completed</option>
                        <option value="In-progress" @selected($task->status === 'In-progress')>In-progress</option>
                        <option value="Canceled" @selected($task->status === 'Canceled')>Canceled</option>
                      </select>
                </div>
            </div>
            
            <div class="text-center">
                <input type="hidden" name="hidden_id" value="{{ $task->id }}" />
                <input type="submit" class="btn btn-primary" value="Edit" />
            </div>
        </form>
    </div>
</div>

@endsection('content')