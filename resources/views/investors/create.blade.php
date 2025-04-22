@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card glass-card">
                <div class="card-header">
                    <h2 class="mb-0">Add New Investor</h2>
                </div>
                <div class="card-body">
                    <form action="{{ route('investors.store') }}" method="POST">
                        @csrf

                        <div class="mb-3">
                            <label for="name" class="form-label">Investor Name</label>
                            <input type="text" class="form-control @error('name') is-invalid @enderror" 
                                id="name" name="name" value="{{ old('name') }}" required>
                            @error('name')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="type" class="form-label">Investor Type</label>
                            <select class="form-select @error('type') is-invalid @enderror" 
                                id="type" name="type" required>
                                <option value="">Select Type</option>
                                <option value="angel" {{ old('type') == 'angel' ? 'selected' : '' }}>Angel Investor</option>
                                <option value="vc" {{ old('type') == 'vc' ? 'selected' : '' }}>Venture Capital</option>
                                <option value="pe" {{ old('type') == 'pe' ? 'selected' : '' }}>Private Equity</option>
                                <option value="corporate" {{ old('type') == 'corporate' ? 'selected' : '' }}>Corporate Investor</option>
                            </select>
                            @error('type')
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
                            <label for="contact_person" class="form-label">Contact Person</label>
                            <input type="text" class="form-control @error('contact_person') is-invalid @enderror" 
                                id="contact_person" name="contact_person" value="{{ old('contact_person') }}">
                            @error('contact_person')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="email" class="form-label">Email</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" 
                                id="email" name="email" value="{{ old('email') }}">
                            @error('email')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="phone" class="form-label">Phone</label>
                            <input type="tel" class="form-control @error('phone') is-invalid @enderror" 
                                id="phone" name="phone" value="{{ old('phone') }}">
                            @error('phone')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="investment_range" class="form-label">Investment Range</label>
                            <input type="text" class="form-control @error('investment_range') is-invalid @enderror" 
                                id="investment_range" name="investment_range" value="{{ old('investment_range') }}"
                                placeholder="e.g., ₹10L - ₹1Cr">
                            @error('investment_range')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="investment_focus" class="form-label">Investment Focus</label>
                            <textarea class="form-control @error('investment_focus') is-invalid @enderror" 
                                id="investment_focus" name="investment_focus" rows="3" required>{{ old('investment_focus') }}</textarea>
                            @error('investment_focus')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="mb-3">
                            <label for="website" class="form-label">Website</label>
                            <input type="url" class="form-control @error('website') is-invalid @enderror" 
                                id="website" name="website" value="{{ old('website') }}"
                                placeholder="https://example.com">
                            @error('website')
                                <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="d-grid">
                            <button type="submit" class="btn btn-primary glass-btn">Create Investor</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection 