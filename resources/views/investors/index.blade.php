@extends('layouts.app')

@section('content')
<div class="container">
    <div class="d-flex justify-content-between align-items-center mb-4">
        <h1 class="glass-text">Investors</h1>
        <a href="{{ route('investors.create') }}" class="btn btn-primary glass-btn">
            <i class="fas fa-plus"></i> Add New Investor
        </a>
    </div>

    @if(session('success'))
        <div class="alert alert-success alert-dismissible fade show glass-alert" role="alert">
            {{ session('success') }}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    @endif

    <div class="row">
        @foreach($investors as $investor)
            <div class="col-md-4 mb-4">
                <div class="card glass-card h-100 investor-card">
                    <div class="card-body">
                        <div class="investor-icon mb-3">
                            <i class="fas fa-user-tie"></i>
                        </div>
                        <h5 class="card-title">{{ $investor->name }}</h5>
                        <p class="card-text">
                            <span class="badge bg-primary glass-badge">{{ $investor->type }}</span>
                        </p>
                        <div class="mb-3 investor-details">
                            @if($investor->contact_person)
                                <p class="mb-1"><i class="fas fa-user me-2"></i> {{ $investor->contact_person }}</p>
                            @endif
                            @if($investor->email)
                                <p class="mb-1"><i class="fas fa-envelope me-2"></i> {{ $investor->email }}</p>
                            @endif
                            @if($investor->phone)
                                <p class="mb-1"><i class="fas fa-phone me-2"></i> {{ $investor->phone }}</p>
                            @endif
                            <p class="mb-1"><i class="fas fa-map-marker-alt me-2"></i> {{ $investor->location }}</p>
                        </div>
                        <div class="mb-3">
                            <h6 class="text-muted">Investment Focus</h6>
                            <p>{{ $investor->investment_focus }}</p>
                        </div>
                        @if($investor->investment_range)
                            <div class="mb-3">
                                <h6 class="text-muted">Investment Range</h6>
                                <p>{{ $investor->investment_range }}</p>
                            </div>
                        @endif
                        <div class="mb-3">
                            <h6 class="text-muted">Portfolio Stats</h6>
                            <div class="d-flex justify-content-between">
                                <div>
                                    <small class="text-muted">Total Investment</small>
                                    <p class="mb-0">₹{{ number_format($investor->total_investment) }}</p>
                                </div>
                                <div>
                                    <small class="text-muted">Investments</small>
                                    <p class="mb-0">{{ $investor->number_of_investments }}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="card-footer bg-transparent border-0">
                        <div class="btn-group w-100">
                            <a href="{{ route('investors.show', $investor) }}" class="btn btn-outline-primary glass-btn">
                                <i class="fas fa-eye"></i> View
                            </a>
                            <a href="{{ route('investors.edit', $investor) }}" class="btn btn-outline-secondary glass-btn">
                                <i class="fas fa-edit"></i> Edit
                            </a>
                            <form action="{{ route('investors.destroy', $investor) }}" method="POST" class="d-inline">
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
        {{ $investors->links() }}
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
    
    .glass-badge {
        background: rgba(13, 110, 253, 0.3);
        backdrop-filter: blur(5px);
        border: 1px solid rgba(255, 255, 255, 0.2);
        transition: all 0.3s ease;
    }
    
    .glass-badge:hover {
        background: rgba(13, 110, 253, 0.5);
        transform: scale(1.05);
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
    
    .investor-card {
        transition: all 0.3s ease;
        overflow: hidden;
        position: relative;
    }
    
    .investor-card:hover {
        transform: translateY(-10px);
        box-shadow: 0 15px 30px rgba(0, 0, 0, 0.2);
    }
    
    .investor-card::before {
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
    
    .investor-icon {
        font-size: 2.5rem;
        color: rgba(255, 255, 255, 0.8);
        text-align: center;
        margin-bottom: 1rem;
        transition: all 0.3s ease;
    }
    
    .investor-card:hover .investor-icon {
        transform: scale(1.1);
        color: rgba(255, 255, 255, 1);
    }
    
    .investor-details p {
        transition: all 0.3s ease;
    }
    
    .investor-card:hover .investor-details p {
        transform: translateX(5px);
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