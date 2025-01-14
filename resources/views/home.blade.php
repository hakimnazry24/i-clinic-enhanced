{{-- <!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>I-Clinic</title>

    <!-- Fonts -->
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600&display=swap" rel="stylesheet" />

    <!-- Styles / Scripts -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])
   
</head> --}}

@extends('master.layout')

@section('content')
    <div class="bg-[#07a196]">
        <div class="px-32 grid grid-cols-2">
            <div class="col-span-1 pt-48">
                <h1 class="text-6xl font-semibold text-[#e8d34f] ">Commitment to Quality and Best Service<h1>
                        <h2 class="mt-20 text-white text-xl">Discover our dedication to providing exceptional healthcare
                            <br />
                            across all aspect of patient care
                        </h2>
            </div>
            <div>
                <img src={{ asset('images/doctor.png') }} alt="doctor" srcset="" class="w-full self-start h-full">
            </div>
        </div>
    </div>
@endsection

{{-- </html> --}}
