<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;
use Illuminate\Support\Facades\Log;

class NewsController
{
    /**
     * Display the form or list of announcements.
     */
    public function index()
    {
        $announcements = Announcement::all(); // Fetch all announcements
        return view('news.main', compact('announcements'));
    }

    /**
     * Handle the form submission and store the data.
     */
    public function store(Request $request)
    {
        // Validate the input data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:announcements,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:500',
        ]);

        try {
            // Save the data into the announcements table
            Announcement::create($validated);

            // Redirect back with a success message
            Log::info("Successfully create news", ["news_data" => $request->all()]);
            return redirect()->route('news')->with('success', 'Information submitted successfully!');
        } catch (\Exception $e) {
            Log::error("Failed to create news", ["news_data" => $$request->all(), "error" => $e->getMessage()]);
        }
    }

    public function news_form()
    {
        return view("news.news-form");
    }
}
