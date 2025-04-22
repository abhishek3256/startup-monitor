@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="glass-text">Startups</h1>
        <a href="{{ route('startups.create') }}" class="btn btn-primary glass-btn">
            <i class="fas fa-plus"></i> Add New Startup
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show glass-alert" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach($startups as $startup)
            <div class="col-md-4 mb-4">
                <div class="card glass-card h-100 startup-card">
                    <div class="card-body">
                        <div class="startup-icon mb-3">
                            <i class="fas fa-rocket"></i>
                        </div>
                        <h5 class="card-title">{{ $startup->name }}</h5>
                        <p class="card-text text-muted">{{ Str::limit($startup->description, 100) }}</p>
                        
                        <div class="mb-3">
                            <h6>Industry</h6>
                            <span class="badge industry-badge">
                                {{ $startup->industry }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <h6>Stage</h6>
                            <span class="badge stage-badge bg-{{ $startup->stage == 'seed' ? 'info' : ($startup->stage == 'series_a' ? 'primary' : 'success') }}">
                                {{ ucfirst(str_replace('_', ' ', $startup->stage)) }}
                            </span>
                        </div>

                        <div class="mb-3">
                            <h6>Founded Date</h6>
                            <p class="text-muted date-display">{{ $startup->founded_date->format('M d, Y') }}</p>
                        </div>

                        <div class="mb-3">
                            <h6>Location</h6>
                            <p class="text-muted location-display">{{ $startup->location }}</p>
                        </div>

                        <div class="mb-3">
                            <h6>Website</h6>
                            <a href="{{ $startup->website }}" target="_blank" class="website-link">
                                {{ $startup->website }}
                            </a>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <div class="btn-group w-100">
                            <a href="{{ route('startups.show', $startup) }}" class="btn btn-outline-primary glass-btn">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('startups.edit', $startup) }}" class="btn btn-outline-secondary glass-btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('startups.destroy', $startup) }}" method="POST" class="d-inline">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn-outline-danger glass-btn" onclick="return confirm('Are you sure?')">
                                    <i class="fas fa-trash"></i> Delete
                                </button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>

    <div class="d-flex justify-content-center mt-4">
        {{ $startups->links() }}
    </div>
</div>

<style>
    .glass-text {
        color: #fff;
        text-shadow: 0 0 10px rgba(255, 255, 255, 0.5);
    }
    
    .glass-alert {
        background: rgba(40, 167, 69, 0.2);
        backdrop-filter: blur(10px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        color: #fff;
    }
    
    .glass-btn {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    
    .glass-btn:hover {
        background: rgba(255, 255, 255, 0.2);
        transform: translateY(-2px);
        box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
    }
    
    .startup-card {
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    
    .startup-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .startup-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        width: 100%;
        height: 100%;
        background: linear-gradient(135deg, rgba(255, 255, 255, 0.1), rgba(255, 255, 255, 0));
        z-index: 1;
        pointer-events: none;
    }
    
    .startup-icon {
        font-size: 2.5rem;
        color: rgba(255, 255, 255, 0.8);
        text-align: center;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .startup-card:hover .startup-icon {
        transform: scale(1.1) rotate(5deg);
        color: rgba(255, 255, 255, 1);
    }
    
    .industry-badge, .stage-badge {
        background: rgba(255, 255, 255, 0.1);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
        padding: 0.5em 1em;
    }
    
    .startup-card:hover .industry-badge, 
    .startup-card:hover .stage-badge {
        transform: scale(1.05);
        box-shadow: 0 0 10px rgba(255, 255, 255, 0.3);
    }
    
    .date-display, .location-display {
        transition: all 0.3s ease;
    }
    
    .startup-card:hover .date-display, 
    .startup-card:hover .location-display {
        transform: translateX(5px);
        color: #fff !important;
    }
    
    .website-link {
        color: rgba(13, 110, 253, 0.8);
        text-decoration: none;
        transition: all 0.3s ease;
    }
    
    .website-link:hover {
        color: rgba(13, 110, 253, 1);
        text-decoration: underline;
    }
    
    .pagination {
        --bs-pagination-bg: rgba(255, 255, 255, 0.1);
        --bs-pagination-border-color: rgba(255, 255, 255, 0.2);
        --bs-pagination-color: #fff;
        --bs-pagination-hover-bg: rgba(255, 255, 255, 0.2);
        --bs-pagination-hover-color: #fff;
        --bs-pagination-focus-bg: rgba(255, 255, 255, 0.2);
        --bs-pagination-focus-color: #fff;
        --bs-pagination-active-bg: rgba(13, 110, 253, 0.5);
        --bs-pagination-active-border-color: rgba(255, 255, 255, 0.2);
    }
</style>
@endsection 