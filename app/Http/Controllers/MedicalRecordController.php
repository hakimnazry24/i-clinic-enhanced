<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class MedicalRecordController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = MedicalRecord::all();
        return view('medical_records.index', ["records" => $records]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medical_records.create');
    }

    /**
     * Store a newly created record in storage.
     */
    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'contact' => 'required|string|max:255',
            'medical_history' => 'required|string',
            'doctor' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        if ($request->hasFile('image')) {
            $file = $request->file('image');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('secure_uploads', $fileName); // disimpan dalam storage/app/secure_uploads
            $validatedData['image'] = $fileName;
        }

        MedicalRecord::create($validatedData);

        return redirect()->route('medical_records.index')->with('success', 'Record added successfully!');
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = MedicalRecord::findOrFail($id);
        return view('medical_records.edit', compact('record'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, $id)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'contact' => 'required|string|max:255',
            'medical_history' => 'required|string',
            'doctor' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048',
        ]);

        $record = MedicalRecord::findOrFail($id);

        if ($request->hasFile('image')) {
            // Delete old file
            if ($record->image && Storage::exists('secure_uploads/' . $record->image)) {
                Storage::delete('secure_uploads/' . $record->image);
            }

            $file = $request->file('image');
            $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
            $file->storeAs('secure_uploads', $fileName);
            $validatedData['image'] = $fileName;
        }

        $record->update($validatedData);

        return redirect()->route('medical_records.index')->with('success', 'Record updated successfully!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $record = MedicalRecord::findOrFail($id);

        // Delete file if exists
        if ($record->image && Storage::exists('secure_uploads/' . $record->image)) {
            Storage::delete('secure_uploads/' . $record->image);
        }

        $record->delete();

        return redirect()->route('medical_records.index')->with('success', 'Record deleted successfully!');
    }

    /**
     * Secure download method
     */
    public function download($filename)
    {
        $path = storage_path('app/secure_uploads/' . $filename);

        if (!file_exists($path)) {
            abort(404);
        }

        return response()->download($path);
    }
}
