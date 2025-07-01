<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AppointmentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true; // set to false if you add role-based checks
    }

    public function rules(): array
    {
        return [
            'name'       => 'required|string|max:255',
            'matric_id'  => ['required', 'regex:/^[0-9]+$/', 'max:50'],
            'email'      => 'required|email|max:255',
            'phone_no'   => ['required', 'regex:/^[0-9]+$/', 'max:20'],
            'date'       => 'required|date|after_or_equal:today',
            'department' => 'required|string|max:100',
            'doctor'     => 'required|string|max:255',
            'message'    => 'nullable|string|max:1000',
        ];
    }

    public function messages(): array
    {
        return [
            'matric_id.regex'  => 'Staff ID / Matric No may only contain digits.',
            'phone_no.regex'   => 'Phone number may only contain digits.',
            'date.after_or_equal' => 'The appointment date must be today or in the future.',
        ];
    }
}
