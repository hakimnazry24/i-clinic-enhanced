@extends('master.layout')
@section('content')
    <!-- Appointment Section -->
    <section id="appointment" class="appointment section">

        <!-- Section Title -->
        <div class="container section-title" data-aos="fade-up">
            <h2>Appointment</h2>
            <p>Book your appointment with ease</p>
        </div><!-- End Section Title -->

        <div class="container" data-aos="fade-up" data-aos-delay="100">

          {{-- Appointment List (escaped) --}}
          @if(isset($appointments) && $appointments->isNotEmpty())
            <div class="appointment-list mb-5">
              <h3 class="mb-3">Your Appointments</h3>
              @foreach($appointments as $appt)
                <div class="card p-3 mb-2">
                  <p><strong>Name:</strong> {{ $appt->name }}</p>
                  <p><strong>Matric/Staff ID:</strong> {{ $appt->matric_id }}</p>
                  <p><strong>Email:</strong> {{ $appt->email }}</p>
                  <p><strong>Phone:</strong> {{ $appt->phone_no }}</p>
                  <p><strong>Date:</strong> {{ $appt->date }}</p>
                  <p><strong>Department:</strong> {{ $appt->department }}</p>
                  <p><strong>Doctor:</strong> {{ $appt->doctor }}</p>
                  <p><strong>Notes:</strong> {{ $appt->message }}</p>
                </div>
              @endforeach
            </div>
          @endif

          <form action="{{ route('appointment.store') }}" method="post" role="form">
            @csrf

            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif

            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
                <script>
                    alert("Your appointment has been submitted. Please check your mail for details");
                </script>
            @endif
            @if (session('error'))
            <div class="alert alert-warning">
                {{ session('error') }}
            </div>
        @endif

            <div class="row">
                <div class="col-md-12 form-group">
                    <input type="text" name="name" class="form-control" id="name" placeholder="Your Name" required value="{{ old('name') }}">
                    @error('name')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group">
                    <input type="number" name="matric_id" class="form-control" id="matric_id" placeholder="Your Staff ID/Matric No" required value="{{ old('matric_id') }}">
                    @error('matric_id')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="email" class="form-control" name="email" id="email" placeholder="Your Email" required value="{{ old('email') }}">
                    @error('email')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 form-group mt-3 mt-md-0">
                    <input type="tel" name="phone_no" class="form-control" id="phone" placeholder="Your Phone e.g. 0123456789" pattern="[0-9]+" oninput="this.value = this.value.replace(/[^0-9]/g, '')" required value="{{ old('phone_no') }}">
                    @error('phone_no')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="row">
                <div class="col-md-4 form-group mt-3">
                    <input type="datetime-local" name="date" class="form-control datepicker" id="date" required value="{{ old('date') }}">
                    @error('date')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 form-group mt-3">
                    <select name="department" id="department" class="form-select" required>
                        <option value="" selected>Select Department</option>
                        <option value="Department 1" {{ old('department') == 'Department 1' ? 'selected' : '' }}>Department 1</option>
                        <option value="Department 2" {{ old('department') == 'Department 2' ? 'selected' : '' }}>Department 2</option>
                        <option value="Department 3" {{ old('department') == 'Department 3' ? 'selected' : '' }}>Department 3</option>
                    </select>
                    @error('department')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
                <div class="col-md-4 form-group mt-3">
                    <select name="doctor" id="doctor" class="form-select" required>
                        <option value="" selected>Select Doctor</option>
                        <option value="Doctor 1" {{ old('doctor') == 'Doctor 1' ? 'selected' : '' }}>Doctor 1</option>
                        <option value="Doctor 2" {{ old('doctor') == 'Doctor 2' ? 'selected' : '' }}>Doctor 2</option>
                        <option value="Doctor 3" {{ old('doctor') == 'Doctor 3' ? 'selected' : '' }}>Doctor 3</option>
                    </select>
                    @error('doctor')
                        <small class="text-danger">{{ $message }}</small>
                    @enderror
                </div>
            </div>

            <div class="form-group mt-3">
                <textarea class="form-control" name="message" rows="5" placeholder="What is your symptoms?">{{ old('message') }}</textarea>
                @error('message')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>

            <div class="mt-3">
                <div class="text-center"><button type="submit">Make an Appointment</button></div>
            </div>
        </form>

        </div>

    </section><!-- /Appointment Section -->
@endsection