@extends('layouts.app')

@section('content')

<div class="card">
    <div class="card-header">
        <div class="row">
            <div class="col col-md-6"><b>Task Details</b></div>
            <div class="col col-md-6">
                <a href="{{ route('tasks.index') }}" class="btn btn-primary btn-sm float-end">View All</a>
            </div>
        </div>
    </div>
    <div class="card-body">
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Content</b></label>
            <div class="col-sm-10">
                {{ $task->content }}
            </div>
        </div>
        <div class="row mb-3">
            <label class="col-sm-2 col-label-form"><b>Status</b></label>
            <div class="col-sm-10">
                {{ $task->status }}
            </div>
        </div>
    </div>
</div>

@endsection('content')