<?php

namespace App\Http\Controllers;

use App\Models\Milestone;
use App\Models\Startup;
use Illuminate\Http\Request;

class MilestoneController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $milestones = Milestone::with('startup')->latest()->paginate(10);
        return view('milestones.index', compact('milestones'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $startups = Startup::all();
        return view('milestones.create', compact('startups'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'startup_id' => 'required|exists:startups,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_date' => 'required|date',
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'priority' => 'required|in:low,medium,high',
            'completion_percentage' => 'required|integer|min:0|max:100',
            'category' => 'required|string|max:50',
        ]);

        Milestone::create($validated);

        return redirect()->route('milestones.index')
            ->with('success', 'Milestone created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Milestone $milestone)
    {
        return view('milestones.show', compact('milestone'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Milestone $milestone)
    {
        $startups = Startup::all();
        return view('milestones.edit', compact('milestone', 'startups'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Milestone $milestone)
    {
        $validated = $request->validate([
            'startup_id' => 'required|exists:startups,id',
            'title' => 'required|string|max:255',
            'description' => 'required|string',
            'target_date' => 'required|date',
            'status' => 'required|in:pending,in_progress,completed,delayed',
            'priority' => 'required|in:low,medium,high',
            'completion_percentage' => 'required|integer|min:0|max:100',
            'category' => 'required|string|max:50',
        ]);

        $milestone->update($validated);

        return redirect()->route('milestones.index')
            ->with('success', 'Milestone updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Milestone $milestone)
    {
        $milestone->delete();

        return redirect()->route('milestones.index')
            ->with('success', 'Milestone deleted successfully.');
    }
}
