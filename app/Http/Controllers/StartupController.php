<?php

namespace App\Http\Controllers;

use App\Models\Startup;
use Illuminate\Http\Request;

class StartupController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $startups = Startup::latest()->paginate(10);
        return view('startups.index', compact('startups'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('startups.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'founder_name' => 'required|string|max:255',
            'description' => 'required|string',
            'industry' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'stage' => 'required|string|max:50',
            'founded_date' => 'required|date',
            'website' => 'nullable|url|max:255',
            'total_funding' => 'required|numeric|min:0',
        ]);

        Startup::create($validated);

        return redirect()->route('startups.index')
            ->with('success', 'Startup created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Startup $startup)
    {
        $investments = $startup->investments()->with('investor')->get();
        $milestones = $startup->milestones()->orderBy('target_date')->get();
        $totalFunding = $startup->investments()->sum('investment_amount');
        $milestoneCompletion = $milestones->avg('completion_percentage') ?? 0;
        
        // Get recent activities (last 5)
        $recentActivities = collect();
        
        // Add investment activities
        foreach ($startup->investments()->with('investor')->latest()->take(5)->get() as $investment) {
            $recentActivities->push((object)[
                'description' => "New investment of ₹" . number_format($investment->investment_amount) . " from " . $investment->investor->name,
                'icon' => 'money-bill-wave',
                'color' => 'success',
                'created_at' => $investment->created_at
            ]);
        }
        
        // Add milestone activities
        foreach ($startup->milestones()->latest()->take(5)->get() as $milestone) {
            $recentActivities->push((object)[
                'description' => "Milestone '" . $milestone->title . "' " . $milestone->status,
                'icon' => $milestone->status == 'completed' ? 'check-circle' : ($milestone->status == 'in_progress' ? 'spinner' : 'clock'),
                'color' => $milestone->status == 'completed' ? 'success' : ($milestone->status == 'in_progress' ? 'primary' : 'warning'),
                'created_at' => $milestone->updated_at
            ]);
        }
        
        // Sort activities by date and take the 5 most recent
        $recentActivities = $recentActivities->sortByDesc('created_at')->take(5);
        
        return view('startups.show', compact(
            'startup',
            'investments',
            'milestones',
            'totalFunding',
            'milestoneCompletion',
            'recentActivities'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Startup $startup)
    {
        return view('startups.edit', compact('startup'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Startup $startup)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'founder_name' => 'required|string|max:255',
            'description' => 'required|string',
            'industry' => 'required|string|max:100',
            'location' => 'required|string|max:255',
            'stage' => 'required|string|max:50',
            'founded_date' => 'required|date',
            'website' => 'nullable|url|max:255',
            'total_funding' => 'required|numeric|min:0',
        ]);

        $startup->update($validated);

        return redirect()->route('startups.index')
            ->with('success', 'Startup updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Startup $startup)
    {
        $startup->delete();

        return redirect()->route('startups.index')
            ->with('success', 'Startup deleted successfully.');
    }
}
