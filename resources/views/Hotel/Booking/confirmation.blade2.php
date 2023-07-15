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
    <link rel="stylesheet" href="{{ asset('style/css/progress-indication.css') }}">
    <style>
        .wrapper {
            max-width: 400px;
        }

        .demo-1 {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 3;
            -webkit-box-orient: vertical;
        }

    </style>
    
    <title>Choose Day Reservation</title>
    
</head>

<body>
    <header>
        @include('layouts.main-header')
    </header>
    
    <!-- content -->
    <div class="container mt-3">
        <div class="row justify-content-md-center">
            <div class="col-md-8 mt-2">
                <div class="card
                 shadow-sm border">
                    <div class="card-body p-4">
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="row mb-3">
                                    <label for="room_number" class="col-sm-2 col-form-label">Room</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_number" name="room_number"
                                            placeholder="col-form-label" value="{{ $room->number }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_type" class="col-sm-2 col-form-label">Type</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_type" name="room_type"
                                            placeholder="col-form-label" value="{{ $room->type->name }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_capacity" class="col-sm-2 col-form-label">Capacity</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_capacity" name="room_capacity"
                                            placeholder="col-form-label" value="{{ $room->capacity }} " readonly>
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <label for="room_price" class="col-sm-2 col-form-label">Price / Day</label>
                                    <div class="col-sm-10">
                                        <input type="text" class="form-control" id="room_price" name="room_price"
                                            placeholder="col-form-label"
                                            value="{{ Helper::convertToRupiah($room->price) }}" readonly>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="col-sm-12 mt-2">
                                <form method="POST"
                                    action="{{ route('book.reservation.payPayment', ['customer' => $customer->id, 'room' => $room->id]) }}">
                                    @csrf
                                    <div class="row mb-3">
                                        <label for="check_in" class="col-sm-2 col-form-label">Check In</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="check_in" name="check_in"
                                                placeholder="col-form-label" value="{{ $stayFrom }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="check_out" class="col-sm-2 col-form-label">Check Out</label>
                                        <div class="col-sm-10">
                                            <input type="date" class="form-control" id="check_out" name="check_out"
                                                placeholder="col-form-label" value="{{ $stayUntil }}" readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="how_long" class="col-sm-2 col-form-label">Total Day</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="how_long" name="how_long"
                                                placeholder="col-form-label"
                                                value="{{ $dayDifference }} {{ Helper::plural('Day', $dayDifference) }} "
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="total_price" class="col-sm-2 col-form-label">Total Price</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="total_price" name="total_price"
                                                placeholder="col-form-label"
                                                value="{{ Helper::convertToRupiah(Helper::getTotalPayment($dayDifference, $room->price)) }} "
                                                readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="minimum_dp" class="col-sm-2 col-form-label">Minimum DP</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control" id="minimum_dp" name="minimum_dp"
                                                placeholder="col-form-label"
                                                value="{{ Helper::convertToRupiah($downPayment) }} " readonly>
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <label for="downPayment" class="col-sm-2 col-form-label">Payment</label>
                                        <div class="col-sm-10">
                                            <input type="text"
                                                class="form-control @error('downPayment') is-invalid @enderror"
                                                id="downPayment" name="downPayment" placeholder="Input payment here"
                                                value="{{ old('downPayment') }}">
                                            @error('downPayment')
                                                <div class="text-danger mt-1">
                                                    {{ $message }}
                                                </div>
                                            @enderror
                                        </div>
                                    </div>
                                    <div class="row mb-3">
                                        <div class="col-sm-2"></div>
                                        <div class="col-sm-10" id="showPaymentType"></div>
                                    </div>
                                    <button type="submit" class="btn btn-primary float-end">Pay DownPayment</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-4 mt-2">
                <div class="card shadow-sm">
                    <img src="{{ $customer->user->getAvatar() }}"
                        style="border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem">
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









    <script>
        $('#downPayment').keyup(function() {
            $('#showPaymentType').text('Rp. ' + parseFloat($(this).val(), 10).toFixed(2).replace(
                    /(\d)(?=(\d{3})+\.)/g, "$1.")
                .toString());
        });
    </script>
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
