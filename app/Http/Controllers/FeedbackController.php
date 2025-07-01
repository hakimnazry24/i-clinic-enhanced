<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Feedback;
use Illuminate\Support\Facades\Log;

class FeedbackController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        return view("feedback.index");
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            "name" => "required|string|max:60",
            "email" => "required|string|max:60",
            "phone_number" => "required|string|max:20",
            "message" => "required|string|max:500",
        ]);

        try {
            Feedback::create($validated);
            Log::info("Successfully create feedback", ["feedback_details" => $request->all()]);
            return redirect()->back()->with("success", "Thank you for your feedback!");
        } catch (\Exception $e) {
            Log::error("Failed to create feedback", ["error" => $e->getMessage(), "feedback_details" => $request->all()]);
            return redirect()->back()->with("error", "Failed to create feedback");
        }
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
