<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Announcement;

class NewsController extends Controller
{
    public function submitForm(Request $request)
    {
        // Validate user input
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255|unique:announcements,email',
            'phone' => 'required|string|max:15',
            'address' => 'required|string|max:500',
        ]);

        // Save the data to the announcements table
        Announcement::create($validatedData);

        // Redirect back to the news page with a success message
        return redirect()->route('news')->with('success', 'Your details have been submitted successfully!');
    }
}
