<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    {{-- Icon --}}
    <link rel="icon" href="{{ asset('img/logo/sip.png') }}">
    {{-- style --}}
    @vite('resources/sass/app.scss')
    
    <title>Count customer</title>
    
</head>

<body>
    <header>
        @include('layouts.main-header')
    </header>
    <main class="my-3">
        <!-- Modal -->
        <!-- <div class="modal fade" id="main-modal" tabindex="-1" aria-labelledby="main-modalLabel" aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="exampleModalLabel"></h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                    </div>
                    <div class="modal-footer">
                        <button id="btn-modal-close" type="button" class="btn btn-secondary"
                            data-bs-dismiss="modal">Close</button>
                        <button id="btn-modal-save" type="button" class="btn btn-primary text-white">Save</button>
                    </div>
                </div>
            </div>
        </div> -->
            <!-- Page Content -->
            <div id="page-content-wrapper">
                <div class="">
                    <div class="container-fluid">
                    <!-- Content -->
                    <div class="container mt-3">
                        <div class="row justify-content-md-center">
                            <div class="col-md-8 mt-2">
                                <div class="card shadow-sm border">
                                    <div class="card-body p-3">
                                        <div class="card">
                                            <div class="card-body">
                                                <form class="row g-3" method="GET"
                                                    action="{{ route('book.reservation.CRoom', ['customer' => $customer->id]) }}">
                                                    <div class="col-md-12">
                                                        <label for="count_person" class="form-label">
                                                            How many person?
                                                        </label>
                                                        <input type="text" class="form-control @error('count_person') is-invalid @enderror"
                                                            id="
                                                                count_person" name="count_person" value="{{ old('count_person') }}">
                                                        @error('count_person')
                                                            <div class="text-danger mt-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <label for="check_in" class="form-label">
                                                            From
                                                        </label>
                                                        <input type="date" class="form-control @error('check_in') is-invalid @enderror" id="
                                                                check_in" name="check_in" value="{{ old('check_in') }}">
                                                        @error('check_in')
                                                            <div class="text-danger mt-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                        <label for="check_out" class="form-label">
                                                            Until
                                                        </label>
                                                        <input type="date" class="form-control @error('check_out') is-invalid @enderror" id="
                                                                check_out" name="check_out" value="{{ old('check_out') }}">
                                                        @error('check_out')
                                                            <div class="text-danger mt-1">
                                                                {{ $message }}
                                                            </div>
                                                        @enderror
                                                    </div>
                                                    <div class="col-12">
                                                        <button type="submit" class="btn myBtn shadow-sm border float-end">Next</button>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4 mt-2">
                                <div class="card  shadow-sm ">
                                    <img src="{{ $customer->user->getAvatar() }}"
                                        style="border-top-right-radius: 0.4rem; border-top-left-radius: 0.5rem">
                                    <div class="card-body">
                                        <table>
                                            <tr>
                                                <td style="text-align: center; width:50px">
                                                    <span>
                                                        <i class="fas {{ $customer->gender == 'Male' ? 'fa-male' : 'fa-female' }}">
                                                        </i>
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $customer->name }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; ">
                                                    <span>
                                                        <i class="fas fa-user-md"></i>
                                                    </span>
                                                </td>
                                                <td>{{ $customer->job }}</td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; ">
                                                    <span>
                                                        <i class="fas fa-birthday-cake"></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $customer->birthdate }}
                                                </td>
                                            </tr>
                                            <tr>
                                                <td style="text-align: center; ">
                                                    <span>
                                                        <i class="fas fa-map-marker-alt"></i>
                                                    </span>
                                                </td>
                                                <td>
                                                    {{ $customer->address }}
                                                </td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>


                    </div>
                </div>

            <!-- /#page-content-wrapper -->

        </div>
    </main>
    <!-- <footer class="footer mt-auto py-2 shadow-sm border-top mt-3" style="background: #f8f9fa; height:55px">
    </footer> -->
    <!-- <footer class="ftco-footer ftco-bg-dark ftco-section">
        <div class="container">
            <div class="row mb-5">
                <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Deluxe Hotel</h2>
                    <p>Far far away, behind the word mountains, far from the countries Vokalia and Consonantia, there live the blind texts.</p>
                    <ul class="ftco-footer-social list-unstyled float-md-left float-lft mt-5">
                    <li class="ftco-animate"><a href="#"><span class="icon-twitter"></span></a></li>
                    <li class="ftco-animate"><a href="#"><span class="icon-facebook"></span></a></li>
                    <li class="ftco-animate"><a href="#"><span class="icon-instagram"></span></a></li>
                    </ul>
                </div>
                </div>
                <div class="col-md">
                <div class="ftco-footer-widget mb-4 ml-md-5">
                    <h2 class="ftco-heading-2">Useful Links</h2>
                    <ul class="list-unstyled">
                    <li><a href="#" class="py-2 d-block">Blog</a></li>
                    <li><a href="#" class="py-2 d-block">Rooms</a></li>
                    <li><a href="#" class="py-2 d-block">Amenities</a></li>
                    <li><a href="#" class="py-2 d-block">Gift Card</a></li>
                    </ul>
                </div>
                </div>
                <div class="col-md">
                    <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Privacy</h2>
                    <ul class="list-unstyled">
                    <li><a href="#" class="py-2 d-block">Career</a></li>
                    <li><a href="#" class="py-2 d-block">About Us</a></li>
                    <li><a href="#" class="py-2 d-block">Contact Us</a></li>
                    <li><a href="#" class="py-2 d-block">Services</a></li>
                    </ul>
                </div>
                </div>
                <div class="col-md">
                <div class="ftco-footer-widget mb-4">
                    <h2 class="ftco-heading-2">Have a Questions?</h2>
                    <div class="block-23 mb-3">
                        <ul>
                        <li><span class="icon icon-map-marker"></span><span class="text">203 Fake St. Mountain View, San Francisco, California, USA</span></li>
                        <li><a href="#"><span class="icon icon-phone"></span><span class="text">+2 392 3929 210</span></a></li>
                        <li><a href="#"><span class="icon icon-envelope"></span><span class="text">info@yourdomain.com</span></a></li>
                        </ul>
                    </div>
                </div>
                </div>
            </div>
            <div class="row">
                <div class="col-md-12 text-center">
                </div>
            </div>
        </div>
    </footer> -->
    
  

  <!-- loader -->
  <!-- <div id="ftco-loader" class="show fullscreen"><svg class="circular" width="48px" height="48px"><circle class="path-bg" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke="#eeeeee"/><circle class="path" cx="24" cy="24" r="22" fill="none" stroke-width="4" stroke-miterlimit="10" stroke="#F96D00"/></svg></div> -->




    <script src="js/jquery.min.js"></script>
<script src="js/jquery-migrate-3.0.1.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/jquery.easing.1.3.js"></script>
<script src="js/jquery.waypoints.min.js"></script>
<script src="js/jquery.stellar.min.js"></script>
<script src="js/owl.carousel.min.js"></script>
<script src="js/jquery.magnific-popup.min.js"></script>
<script src="js/aos.js"></script>
<script src="js/jquery.animateNumber.min.js"></script>
<script src="js/bootstrap-datepicker.js"></script>
<script src="js/jquery.timepicker.min.js"></script>
<script src="js/scrollax.min.js"></script>
<script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyBVWaKrjvy3MaE7SQ74_uJiULgl1JY0H2s&sensor=false"></script>
<script src="js/google-map.js"></script>
<script src="js/main.js"></script>

</body>

</html>





