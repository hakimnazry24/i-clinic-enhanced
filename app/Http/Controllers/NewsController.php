<?php

namespace App\Http\Controllers;

use App\Models\Announcement;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class NewsController extends Controller
{
    public function index()
    {
        $announcements = Announcement::latest()->get(); // Fetch all announcements in descending order
        return view('home', compact('announcements'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'topic' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'message' => 'required|string',
        ]);

        $picturePath = null;
        if ($request->hasFile('picture')) {
            $picturePath = $request->file('picture')->store('announcements', 'public');
        }

        $announcement = Announcement::create([
            'topic' => $validated['topic'],
            'picture' => $picturePath,
            'message' => $validated['message'],
        ]);

        return redirect()->route('news.index')->with('success', 'Announcement added successfully!');
    }

    public function show(Announcement $announcement)
    {
        return view('news.show', compact('announcement'));
    }

    public function edit(Announcement $announcement)
    {
        return view('news.edit', compact('announcement'));
    }

    public function update(Request $request, Announcement $announcement)
    {
        $validated = $request->validate([
            'topic' => 'required|string|max:255',
            'picture' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
            'message' => 'required|string',
        ]);

        $picturePath = $announcement->picture; // Preserve existing path

        if ($request->hasFile('picture')) {
            Storage::delete($announcement->picture); // Delete previous image
            $picturePath = $request->file('picture')->store('announcements', 'public');
        }

        $announcement->update($validated);

        return redirect()->route('news.index')->with('success', 'Announcement updated successfully!');
    }

    public function destroy(Announcement $announcement)
    {
        if ($announcement->picture) {
            Storage::delete($announcement->picture);
        }

        $announcement->delete();

        return redirect()->route('news.index')->with('success', 'Announcement deleted successfully!');
    }
}
