@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card glass-card">
                <div class="card-header d-flex justify-content-between align-items-center">
                    <h2 class="mb-0">Milestone Details</h2>
                    <div>
                        <a href="{{ route('milestones.edit', $milestone->id) }}" class="btn btn-primary">Edit</a>
                        <form action="{{ route('milestones.destroy', $milestone->id) }}" method="POST" class="d-inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger" onclick="return confirm('Are you sure you want to delete this milestone?')">Delete</button>
                        </form>
                    </div>
                </div>
                <div class="card-body">
                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Startup:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $milestone->startup->name }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Title:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $milestone->title }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Description:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $milestone->description }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Target Date:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $milestone->target_date->format('F j, Y') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Status:</strong>
                        </div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $milestone->status == 'completed' ? 'success' : ($milestone->status == 'in_progress' ? 'primary' : ($milestone->status == 'delayed' ? 'danger' : 'warning')) }}">
                                {{ ucfirst($milestone->status) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Priority:</strong>
                        </div>
                        <div class="col-md-8">
                            <span class="badge bg-{{ $milestone->priority == 'high' ? 'danger' : ($milestone->priority == 'medium' ? 'warning' : 'info') }}">
                                {{ ucfirst($milestone->priority) }}
                            </span>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Completion:</strong>
                        </div>
                        <div class="col-md-8">
                            <div class="progress">
                                <div class="progress-bar" role="progressbar" 
                                    style="width: {{ $milestone->completion_percentage }}%;" 
                                    aria-valuenow="{{ $milestone->completion_percentage }}" 
                                    aria-valuemin="0" 
                                    aria-valuemax="100">
                                    {{ $milestone->completion_percentage }}%
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Created At:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $milestone->created_at->format('F j, Y, g:i a') }}
                        </div>
                    </div>

                    <div class="row mb-3">
                        <div class="col-md-4">
                            <strong>Last Updated:</strong>
                        </div>
                        <div class="col-md-8">
                            {{ $milestone->updated_at->format('F j, Y, g:i a') }}
                        </div>
                    </div>

                    <div class="d-grid gap-2">
                        <a href="{{ route('milestones.index') }}" class="btn btn-secondary">Back to Milestones</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 