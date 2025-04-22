@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card glass-card">
                <div class="card-header">
                    <h2 class="mb-0">Add New Milestone</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('milestones.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="startup_id" class="form-label">Startup</label>
                            <select class="form-select @error('startup_id') is-invalid @enderror" 
                                id="startup_id" name="startup_id" required>
                                <option value="">Select Startup</option>
                                @foreach($startups as $startup)
                                    <option value="{{ $startup->id }}" {{ old('startup_id') == $startup->id ? 'selected' : '' }}>
                                        {{ $startup->name }}
                                    </option>
                                @endforeach
                            </select>
                            @error('startup_id')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="title" class="form-label">Title</label>
                            <input type="text" class="form-control @error('title') is-invalid @enderror" 
                                id="title" name="title" value="{{ old('title') }}" required>
                            @error('title')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="description" class="form-label">Description</label>
                            <textarea class="form-control @error('description') is-invalid @enderror" 
                                id="description" name="description" rows="3" required>{{ old('description') }}</textarea>
                            @error('description')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="category" class="form-label">Category</label>
                            <select class="form-select @error('category') is-invalid @enderror" 
                                id="category" name="category" required>
                                <option value="">Select Category</option>
                                <option value="funding" {{ old('category') == 'funding' ? 'selected' : '' }}>Funding</option>
                                <option value="product" {{ old('category') == 'product' ? 'selected' : '' }}>Product</option>
                                <option value="team" {{ old('category') == 'team' ? 'selected' : '' }}>Team</option>
                                <option value="growth" {{ old('category') == 'growth' ? 'selected' : '' }}>Growth</option>
                                <option value="marketing" {{ old('category') == 'marketing' ? 'selected' : '' }}>Marketing</option>
                                <option value="operations" {{ old('category') == 'operations' ? 'selected' : '' }}>Operations</option>
                            </select>
                            @error('category')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="target_date" class="form-label">Target Date</label>
                            <input type="date" class="form-control @error('target_date') is-invalid @enderror" 
                                id="target_date" name="target_date" value="{{ old('target_date') }}" required>
                            @error('target_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="status" class="form-label">Status</label>
                            <select class="form-select @error('status') is-invalid @enderror" 
                                id="status" name="status" required>
                                <option value="">Select Status</option>
                                <option value="pending" {{ old('status') == 'pending' ? 'selected' : '' }}>Pending</option>
                                <option value="in_progress" {{ old('status') == 'in_progress' ? 'selected' : '' }}>In Progress</option>
                                <option value="completed" {{ old('status') == 'completed' ? 'selected' : '' }}>Completed</option>
                                <option value="delayed" {{ old('status') == 'delayed' ? 'selected' : '' }}>Delayed</option>
                            </select>
                            @error('status')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="priority" class="form-label">Priority</label>
                            <select class="form-select @error('priority') is-invalid @enderror" 
                                id="priority" name="priority" required>
                                <option value="">Select Priority</option>
                                <option value="low" {{ old('priority') == 'low' ? 'selected' : '' }}>Low</option>
                                <option value="medium" {{ old('priority') == 'medium' ? 'selected' : '' }}>Medium</option>
                                <option value="high" {{ old('priority') == 'high' ? 'selected' : '' }}>High</option>
                            </select>
                            @error('priority')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="completion_percentage" class="form-label">Completion Percentage</label>
                            <input type="number" class="form-control @error('completion_percentage') is-invalid @enderror" 
                                id="completion_percentage" name="completion_percentage" 
                                value="{{ old('completion_percentage') }}" min="0" max="100" required>
                            @error('completion_percentage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Create Milestone</button>
                            <a href="{{ route('milestones.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 