@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card glass-card">
                <div class="card-header">
                    <h2 class="mb-0">Edit Investor</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('investors.update', $investor) }}" method="POST">
                        @csrf
                        @method('PUT')

                        <div class="mb-3">
                            <label for="name" class="form-label">Investor Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name', $investor->name) }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Investor Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="angel" {{ old('type', $investor->type) == 'angel' ? 'selected' : '' }}>Angel Investor</option>
                                <option value="vc" {{ old('type', $investor->type) == 'vc' ? 'selected' : '' }}>Venture Capital</option>
                                <option value="pe" {{ old('type', $investor->type) == 'pe' ? 'selected' : '' }}>Private Equity</option>
                                <option value="corporate" {{ old('type', $investor->type) == 'corporate' ? 'selected' : '' }}>Corporate Investor</option>
                            </select>
                            @error('type')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="location" class="form-label">Location</label>
                            <input type="text" class="form-control @error('location') is-invalid @enderror" 
                                id="location" name="location" value="{{ old('location', $investor->location) }}" required>
                            @error('location')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="contact_person" class="form-label">Contact Person</label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                                id="contact_person" name="contact_person" value="{{ old('contact_person', $investor->contact_person) }}" required>
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email', $investor->email) }}" required>
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="text" class="form-control @error('phone') is-invalid @enderror" 
                                id="phone" name="phone" value="{{ old('phone', $investor->phone) }}" required>
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                id="website" name="website" value="{{ old('website', $investor->website) }}">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="investment_focus" class="form-label">Investment Focus</label>
                            <textarea class="form-control @error('investment_focus') is-invalid @enderror" 
                                id="investment_focus" name="investment_focus" rows="3" required>{{ old('investment_focus', $investor->investment_focus) }}</textarea>
                            @error('investment_focus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="row">
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="min_investment" class="form-label">Minimum Investment ($)</label>
                                    <input type="number" step="0.01" class="form-control @error('min_investment') is-invalid @enderror" 
                                        id="min_investment" name="min_investment" value="{{ old('min_investment', $investor->min_investment) }}" required>
                                    @error('min_investment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                            <div class="col-md-6">
                                <div class="mb-3">
                                    <label for="max_investment" class="form-label">Maximum Investment ($)</label>
                                    <input type="number" step="0.01" class="form-control @error('max_investment') is-invalid @enderror" 
                                        id="max_investment" name="max_investment" value="{{ old('max_investment', $investor->max_investment) }}" required>
                                    @error('max_investment')
                                        <div class="invalid-feedback">{{ $message }}</div>
                                    @enderror
                                </div>
                            </div>
                        </div>

                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-primary">Update Investor</button>
                            <a href="{{ route('investors.index') }}" class="btn btn-secondary">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 