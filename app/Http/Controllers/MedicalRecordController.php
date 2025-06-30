<?php

namespace App\Http\Controllers;

use App\Models\MedicalRecord;
use Illuminate\Http\Request;
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Validate image
        ]);

        try {

            if ($request->hasFile('image')) {
                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'local'); // Save in public/uploads
                $validatedData['image'] = $filePath; // Save the file path
            }

            MedicalRecord::create($validatedData);

            Log::info("Successfully create medical record", ["medical_record_data" => $request->all()]);
            return redirect()->route('medical_records.index')->with('success', 'Record added successfully!');
        } catch (\Exception $e) {
            Log::error("Failed to create medical record", ["error" => $$e->getMessage(), "medical_record_data" => $request->all()]);
            return redirect()->back()->with("error", "Failed to create medical record");
        }
    }

    public function show(MedicalRecord $medicalRecord)
    {
        //
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
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        try {
            $record = MedicalRecord::findOrFail($id);

            if ($request->hasFile('image')) {
                // Delete old image if it exists
                if ($record->image && file_exists(public_path('storage/' . $record->image))) {
                    unlink(public_path('storage/' . $record->image));
                }

                $file = $request->file('image');
                $fileName = time() . '_' . $file->getClientOriginalName();
                $filePath = $file->storeAs('uploads', $fileName, 'public');
                $validatedData['image'] = $filePath;
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
            $record->delete();

            Log::info("Successfully delete medical record", ["medical_record_id" => $id]);
            return redirect()->route('medical_records.index')->with('success', 'Record deleted successfully!');
        } catch (\Exception $e) {
            Log::error("Failed to delete medical record", ["error" => $e->getMessage(), "medical_record_id" => $id]);
            return redirect()->back()->with("error", "Failed to delete medical record");
        }

    }

}