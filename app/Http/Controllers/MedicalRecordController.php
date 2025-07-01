<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Log;

class MedicalRecordController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $records = MedicalRecord::all(); // Retrieve all medical records
        return view('medical_records.index', ["records" => $records]);
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('medical_records.create'); // Return a view for creating a record
    }

    public function store(Request $request)
    {
        $validatedData = $request->validate([
            'full_name' => 'required|string|max:255',
            'age' => 'required|integer',
            'contact' => 'required|string|max:255',
            'medical_history' => 'required|string',
            'doctor' => 'nullable|string|max:255',
            'image' => 'nullable|file|mimes:jpeg,png,jpg,gif,pdf|max:2048', // Validate image
        ]);

        try {

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('secure_uploads', $fileName); // disimpan dalam storage/app/secure_uploads
                $validatedData['image'] = $fileName;
            }

            MedicalRecord::create($validatedData);

            Log::info("Successfully create medical record", ["medical_record_data" => $request->all()]);
            return redirect()->route('medical_records.index')->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            Log::error("Failed to create medical record", ["error" => $$e->getMessage(), "medical_record_data" => $request->all()]);
            return redirect()->back()->with("error", "Failed to create medical record");
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        $record = MedicalRecord::findOrFail($id); // Find the record by ID
        return view('medical_records.edit', compact('record'));
    }

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

        try {
            $record = MedicalRecord::findOrFail($id);

            if ($request->hasFile('image')) {
                // Delete old fileAdd commentMore actions
                if ($record->image && Storage::exists('secure_uploads/' . $record->image)) {
                    Storage::delete('secure_uploads/' . $record->image);
                }

                $file = $request->file('image');
                $fileName = Str::uuid() . '.' . $file->getClientOriginalExtension();
                $file->storeAs('secure_uploads', $fileName);
                $validatedData['image'] = $fileName;
            }

            $record->update($validatedData);

            Log::info("Successfully update medical record", ["medical_record_id" => $id, "medical_record_data" => $request->all()]);
            return redirect()->route('medical_records.index')->with('success', 'Record updated successfully!');
        } catch (\Exception $e) {
            Log::error("Failed to update medical record", ["error" => $e->getMessage(), "medical_record_data" => $request->all()]);
            return redirect()->back()->with("error", "Failed to update medical record");
        }
    }


    public function destroy($id)
    {

        try {
            $record = MedicalRecord::findOrFail($id);

            // Delete file if exists
            if ($record->image && Storage::exists('secure_uploads/' . $record->image)) {
                Storage::delete('secure_uploads/' . $record->image);
            }

            $record->delete();

            Log::info("Successfully delete medical record", ["medical_record_id" => $id]);
            return redirect()->route('medical_records.index')->with('success', 'Record deleted successfully!');
        } catch (\Exception $e) {
            Log::error("Failed to delete medical record", ["error" => $e->getMessage(), "medical_record_id" => $id]);
            return redirect()->back()->with("error", "Failed to delete medical record");
        }

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