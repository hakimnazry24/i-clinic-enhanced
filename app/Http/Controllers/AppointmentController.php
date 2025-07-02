<?php

namespace App\Http\Controllers;

use App\Http\Requests\AppointmentRequest;
use Purifier;
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
        // pull all appointments in date order
        $appointments = Appointment::orderBy('date', 'asc')->get();

        // render the view with the data
        return view('appointment', compact('appointments'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // pull all appointments in date order to display above the form
        $appointments = Appointment::orderBy('date', 'asc')->get();

        // render the view with the form and list
        return view('appointment', compact('appointments'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AppointmentRequest $request)
    {

        try {
            // Only validated data is returned here
            $data = $request->validated();

            // sanitize the message field to prevent XSS
            $data['message'] = Purifier::clean($data['message'] ?? '');


            // mass-assign (Appointment::$fillable must include these fields)
            Appointment::create($data);

            Log::info('Successfully created appointment', ['data' => $data]);

            return redirect()
                   ->route('appointment.index')
                   ->with('success', 'Successfully created appointment');
        } catch (\Exception $e) {
            Log::error('Failed to create appointment', [
                'error' => $e->getMessage(),
                'data'  => $request->all(),
            ]);

            return redirect()
                   ->route('appointment.index')
                   ->with('error', 'Failed to create appointment');
        }
    }
}
