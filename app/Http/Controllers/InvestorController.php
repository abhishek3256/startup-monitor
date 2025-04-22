<?php

namespace App\Http\Controllers;

use App\Models\Investor;
use App\Models\Startup;
use Illuminate\Http\Request;

class InvestorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $investors = Investor::latest()->paginate(10);
        return view('investors.index', compact('investors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('investors.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'contact_person' => 'nullable|string|max:255',
            'email' => 'nullable|email|max:255',
            'phone' => 'nullable|string|max:20',
            'website' => 'nullable|url|max:255',
            'investment_focus' => 'required|string',
            'investment_range' => 'nullable|string|max:255',
            'total_investment' => 'nullable|numeric|min:0',
            'number_of_investments' => 'nullable|integer|min:0'
        ]);

        // Set default values for nullable fields
        $validated['total_investment'] = $validated['total_investment'] ?? 0;
        $validated['number_of_investments'] = $validated['number_of_investments'] ?? 0;

        Investor::create($validated);

        return redirect()->route('investors.index')
            ->with('success', 'Investor created successfully.');
    }

    /**
     * Display the specified resource.
     */
    public function show(Investor $investor)
    {
        $investments = $investor->financials()->with('startup')->get();
        $totalInvestment = $investments->sum('investment_amount');
        $averageOwnership = $investments->avg('equity_offered');
        $availableStartups = Startup::whereNotIn('id', $investments->pluck('startup_id'))->get();

        return view('investors.show', compact(
            'investor',
            'investments',
            'totalInvestment',
            'averageOwnership',
            'availableStartups'
        ));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Investor $investor)
    {
        return view('investors.edit', compact('investor'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Investor $investor)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'type' => 'required|string|max:50',
            'location' => 'required|string|max:255',
            'contact_person' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:20',
            'website' => 'nullable|url|max:255',
            'investment_focus' => 'required|string',
            'min_investment' => 'required|numeric|min:0',
            'max_investment' => 'required|numeric|min:0',
        ]);

        $investor->update($validated);

        return redirect()->route('investors.index')
            ->with('success', 'Investor updated successfully.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Investor $investor)
    {
        $investor->delete();

        return redirect()->route('investors.index')
            ->with('success', 'Investor deleted successfully.');
    }
}
