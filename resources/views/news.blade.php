@extends('layouts.app')

@section('content')

    <div class="breadcrumbs">
        <div class="container">
            <h2>Upcoming Events</h2>
            <p>Check out our upcoming events and join us!</p>
        </div>
    </div><section id="upcoming-events" class="upcoming-events section-bg">
        <div class="container" data-aos="fade-up">

            <div class="row gy-4">

                <div class="col-lg-4" data-aos="fade-up" data-aos-delay="100">
                    <div class="event-item">
                        <img src="assets/img/event-1.jpg" class="img-fluid" alt="">
                        <h3>World Kidney Day 2024 Celebration</h3>
                        <div class="price">
                            <p><span>Date:</span> 27 December 2024</p>
                            <p><span>Time:</span> 9:00 AM</p>
                            <p><span>Place:</span> ICC HUM</p>
                        </div>
                        <div class="social">
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div><div class="col-lg-4" data-aos="fade-up" data-aos-delay="200">
                    <div class="event-item">
                        <img src="assets/img/event-2.jpg" class="img-fluid" alt="">
                        <h3>Blood Donation</h3>
                        <div class="price">
                            <p><span>Date:</span> 2-6 January 2025</p>
                            <p><span>Time:</span> 2:00 AM - 4:00 PM</p>
                            <p><span>Place:</span> SHAS MOSQUE</p>
                        </div>
                        <div class="social">
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi bi-instagram"></i></a>
                        </div>
                    </div>
                </div><div class="col-lg-4" data-aos="fade-up" data-aos-delay="300">
                    <div class="event-item">
                        <img src="assets/img/event-3.jpg" class="img-fluid" alt="">
                        <h3>Parentcraft Class</h3>
                        <div class="price">
                            <p><span>Date:</span> 10 January 2025</p>
                            <p><span>Time:</span> 9:00 AM - 12:30 PM</p>
                        </div>
                        <div class="social">
                            <a href="#"><i class="bi bi-twitter"></i></a>
                            <a href="#"><i class="bi bi-facebook"></i></a>
                            <a href="#"><i class="bi-instagram"></i></a>
                        </div>
                    </div>
                </div></div>

        </div>
    </section>@endsection
