<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\DB;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;
use App\Models\Appointment;
use Illuminate\Support\Facades\Log;

class AppointmentController
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $appointments = DB::table('appointments')->orderBy('date', 'asc')->get();

        return view('appointment', compact('appointments'));
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

        try {
            $appointment = new Appointment();
            $appointment->name = $request->name;
            $appointment->matric_id = $request->matric_id;
            $appointment->email = $request->email;
            $appointment->phone_no = $request->phone_no;
            $appointment->date = $request->date;
            $appointment->department = $request->department;
            $appointment->doctor = $request->doctor;
            $appointment->message = $request->message;

            $appointment->created_at = today();
            $appointment->updated_at = today();
            $appointment->save();

            Log::info("Successfully create appointment", ["appointment_data" => $request->all()]);
            return redirect('appointment')->with("success", "Successfully create appointment");
        } catch (\Exception $e) {
            Log::error("Failed to create appointment", ["errors" => $e->getMessage(), "appointment_data" => $request->all()]);
            return redirect("appointment")->with("error", "Failed to create appointment");
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
