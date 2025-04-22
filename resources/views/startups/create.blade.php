@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card glass-card">
                <div class="card-header">
                    <h2 class="mb-0">Add New Startup</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('startups.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Startup Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="founder_name" class="form-label">Founder Name</label>
                            <input type="text" class="form-control @error('founder_name') is-invalid @enderror" 
                                id="founder_name" name="founder_name" value="{{ old('founder_name') }}" required>
                            @error('founder_name')
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
                            <label for="industry" class="form-label">Industry</label>
                            <input type="text" class="form-control @error('industry') is-invalid @enderror" 
                                id="industry" name="industry" value="{{ old('industry') }}" required>
                            @error('industry')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                id="location" name="location" value="{{ old('location') }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="stage" class="form-label">Stage</label>
                            <select class="form-select @error('stage') is-invalid @enderror" 
                                id="stage" name="stage" required>
                                <option value="">Select Stage</option>
                                <option value="idea" {{ old('stage') == 'idea' ? 'selected' : '' }}>Idea Stage</option>
                                <option value="mvp" {{ old('stage') == 'mvp' ? 'selected' : '' }}>MVP</option>
                                <option value="early_traction" {{ old('stage') == 'early_traction' ? 'selected' : '' }}>Early Traction</option>
                                <option value="growth" {{ old('stage') == 'growth' ? 'selected' : '' }}>Growth</option>
                                <option value="scaling" {{ old('stage') == 'scaling' ? 'selected' : '' }}>Scaling</option>
                            </select>
                            @error('stage')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="founded_date" class="form-label">Founded Date</label>
                            <input type="date" class="form-control @error('founded_date') is-invalid @enderror" 
                                id="founded_date" name="founded_date" value="{{ old('founded_date') }}" required>
                            @error('founded_date')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                id="website" name="website" value="{{ old('website') }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="total_funding" class="form-label">Total Funding ($)</label>
                            <input type="number" step="0.01" class="form-control @error('total_funding') is-invalid @enderror" 
                                id="total_funding" name="total_funding" value="{{ old('total_funding') }}" required>
                            @error('total_funding')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Create Startup</button>
                            <a href="{{ route('startups.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 