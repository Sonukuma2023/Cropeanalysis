<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Disease;
use Illuminate\Http\Request;
use Inertia\Inertia;

class DiseaseController extends Controller
{
    public function index(Request $request)
    {
        $query = Disease::query();

        if ($request->has('search')) {
            $search = $request->input('search');
            $query->where(function($q) use ($search) {
                $q->where('crop_name', 'like', "%{$search}%")
                  ->orWhere('disease_name', 'like', "%{$search}%")
                  ->orWhere('symptoms', 'like', "%{$search}%");
            });
        }

        $diseases = $query->latest()->get();

        return Inertia::render('Admin/Diseases', [
            'diseases' => $diseases,
            'filters' => $request->only(['search'])
        ]);
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'crop_name' => 'required|string|max:255',
            'disease_name' => 'required|string|max:255',
            'symptoms' => 'required|string',
            'pesticide' => 'required|string',
            'organic_solution' => 'required|string',
            'prevention' => 'required|string',
        ]);

        Disease::create($validated);

        return redirect()->back()->with('success', 'Disease created successfully.');
    }

    public function update(Request $request, Disease $disease)
    {
        $validated = $request->validate([
            'crop_name' => 'required|string|max:255',
            'disease_name' => 'required|string|max:255',
            'symptoms' => 'required|string',
            'pesticide' => 'required|string',
            'organic_solution' => 'required|string',
            'prevention' => 'required|string',
        ]);

        $disease->update($validated);

        return redirect()->back()->with('success', 'Disease updated successfully.');
    }

    public function destroy(Disease $disease)
    {
        $disease->delete();

        return redirect()->back()->with('success', 'Disease deleted successfully.');
    }
}
