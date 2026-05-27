<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Upload;
use App\Models\Disease;
use Inertia\Inertia;

class AnalysisController extends Controller
{
    public function index()
    {
        return Inertia::render('Analysis/Upload');
    }

    public function upload(Request $request)
    {
        $request->validate([
            'image' => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $file = $request->file('image');
        $filename = strtolower($file->getClientOriginalName());
        $path = $file->store('uploads', 'public');

        // Intelligent AI Classification Simulation
        // We match filename keywords to diseases, fallback to random
        $matchedDisease = null;
        $diseases = Disease::all();
        
        foreach ($diseases as $disease) {
            $cropKeyword = strtolower($disease->crop_name);
            $diseaseKeyword = strtolower($disease->disease_name);
            
            // If filename has crop and disease keyword
            if (str_contains($filename, $cropKeyword) || str_contains($filename, str_replace(' ', '', $cropKeyword))) {
                $matchedDisease = $disease;
                if (str_contains($filename, $diseaseKeyword) || str_contains($filename, str_replace(' ', '', $diseaseKeyword))) {
                    break; // Perfect match
                }
            }
        }

        // Fallback to random if no keyword match
        if (!$matchedDisease) {
            $matchedDisease = Disease::inRandomOrder()->first();
        }

        // Generate accuracy float between 85.00 and 99.50
        $accuracy = mt_rand(8500, 9950) / 100;

        $upload = Upload::create([
            'user_id' => auth()->id() ?? 1,
            'image_path' => $path,
            'disease_id' => $matchedDisease ? $matchedDisease->id : null,
            'accuracy' => $accuracy
        ]);

        return redirect()->route('analysis.result', $upload->id);
    }

    public function result($id)
    {
        $upload = Upload::with('disease')->findOrFail($id);

        return Inertia::render('Analysis/Result', [
            'upload' => $upload
        ]);
    }

    public function history()
    {
        $uploads = Upload::where('user_id', auth()->id())
            ->with('disease')
            ->latest()
            ->paginate(6);

        return Inertia::render('Analysis/History', [
            'uploads' => $uploads
        ]);
    }

    public function testing(){
        
        echo "hello worlds";
    }
}
