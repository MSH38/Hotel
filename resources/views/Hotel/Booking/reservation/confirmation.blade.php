@extends('layouts.master')
@section('title', 'Choose Day Reservation')
@section('content')
<div class="hero-wrap" style="background-image: url('{{asset('images/bg_1.jpg')}}');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
        <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          <div class="text">
            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="/">Home</a></span> <span>About</span></p>
            <h1 class="mb-4 bread">Complete Customer Details</h1>
          </div>
        </div>
      </div>
    </div>
</div>

    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url({asset('images/bg_2.jpg')}});">
        <div class="container mt-3">
            <div class="row justify-content-md-center">
                <div class="col-md-8 mt-2">
                    <div class="card shadow-sm border">
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
                                @if (Session::has('success'))
                                    <div class="alert alert-success text-center">
                                        <a href="#" class="close" data-dismiss="alert" aria-label="close">×</a>
                                        <p>{{ Session::get('success') }}</p>
                                    </div>
                                @endif
                                <div class="col-sm-12 mt-2">

                                    <form method="POST"
                                        action="{{ route('book.reservation.payPayment', ['customer' => $customer->id, 'room' => $room->id]) }}"
                                        class="require-validation"  data-cc-on-file="false" data-stripe-publishable-key="{{ env('STRIPE_KEY') }}" id="payment-form">
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
                                        <!-- <div class="row mb-3">
                                            <label for="total_price" class="col-sm-2 col-form-label btn-lg">Total Price</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="total_price" name="total_price"
                                                    placeholder="col-form-label"
                                                    value="{{ Helper::convertToRupiah(Helper::getTotalPayment($dayDifference, $room->price)) }} "
                                                    readonly>
                                            </div>
                                        </div> -->
                                        <!-- <div class="row mb-3">
                                            <label for="minimum_dp" class="col-sm-2 col-form-label">Minimum DP</label>
                                            <div class="col-sm-10">
                                                <input type="text" class="form-control" id="minimum_dp" name="minimum_dp"
                                                    placeholder="col-form-label"
                                                    value="{{ Helper::convertToRupiah($downPayment) }} " readonly>
                                            </div>
                                        </div> -->
                                        <!-- <div class="row mb-3">
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
                                        </div> -->
                                    <hr>
                                    <div class="text-center ">
                                        <h5> Payment Card Information </h5>
                                    </div>
                                    <div class="row mb-3 required mt-3">
                                        <label for="downPayment" class="col-sm-2 col-form-label">Name on Card</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('downPayment') is-invalid @enderror"
                                                    placeholder="Input payment Card user Name" >
                                        </div>
                                    </div>
                                    <div class="row mb-3 required">
                                        <label for="downPayment" class="col-sm-2 col-form-label">Card Number</label>
                                        <div class="col-sm-10">
                                            <input type="text" class="form-control @error('downPayment') is-invalid @enderror"
                                                    placeholder="Input payment Card number" value="{{ old('CardNumber')}}" autocomplete='off' size='16' >
                                        </div>
                                    </div>
                                    <div class='form-row row'>
                                        <div class='col-xs-12 col-md-4 form-group cvc required'>
                                            <label class='control-label'>CVC</label> <input autocomplete='off'
                                                class='form-control card-cvc' placeholder='ex. 311' size='4'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Month</label> <input
                                                class='form-control card-expiry-month' placeholder='MM' size='2'
                                                type='text'>
                                        </div>
                                        <div class='col-xs-12 col-md-4 form-group expiration required'>
                                            <label class='control-label'>Expiration Year</label> <input
                                                class='form-control card-expiry-year' placeholder='YYYY' size='4'
                                                type='text'>
                                        </div>
                                    </div>
            
                                
            
                                    <div class="row">
                                        <button class="btn btn-success btn-lg btn-block" name="Total_price" disabled type="">
                                            Price: {{ Helper::convertToRupiah(Helper::getTotalPayment($dayDifference, $room->price)) }} 
                                        </button><br>
                                    </div>
                                    <!-- <div class="row">Total_price
                                        <div class="col-xs-12">
                                            <button class="btn btn-primary btn-lg btn-block" type="submit">Pay </button>
                                        </div>
                                    </div> -->
                                        <div class="row mb-3">
                                            <div class="col-sm-2"></div>
                                            <div class="col-sm-10" id="showPaymentType"></div>
                                        </div>
                                        <div class="d-flex justify-content-center">
                                            <button type="submit" class="btn btn-primary float-end">Pay DownPayment</button>
                                        </div>
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
    </section>

@endsection
@section('footer')
<script type="text/javascript" src="https://js.stripe.com/v2/"></script>
  
<script type="text/javascript">
$(function() {
   
    var $form = $(".require-validation");
   
    $('form.require-validation').bind('submit', function(e) {
        var $form         = $(".require-validation"),
        inputSelector = ['input[type=email]', 'input[type=password]',
                         'input[type=text]', 'input[type=file]',
                         'textarea'].join(', '),
        $inputs       = $form.find('.required').find(inputSelector),
        $errorMessage = $form.find('div.error'),
        valid         = true;
        $errorMessage.addClass('hide');
  
        $('.has-error').removeClass('has-error');
        $inputs.each(function(i, el) {
          var $input = $(el);
          if ($input.val() === '') {
            $input.parent().addClass('has-error');
            $errorMessage.removeClass('hide');
            e.preventDefault();
          }
        });
   
        if (!$form.data('cc-on-file')) {
          e.preventDefault();
          Stripe.setPublishableKey($form.data('stripe-publishable-key'));
          Stripe.createToken({
            number: $('.card-number').val(),
            cvc: $('.card-cvc').val(),
            exp_month: $('.card-expiry-month').val(),
            exp_year: $('.card-expiry-year').val()
          }, stripeResponseHandler);
        }
  
  });
  
  function stripeResponseHandler(status, response) {
        if (response.error) {
            $('.error')
                .removeClass('hide')
                .find('.alert')
                .text(response.error.message);
        } else {
            /* token contains id, last4, and card type */
            var token = response['id'];
               
            $form.find('input[type=text]').empty();
            $form.append("<input type='hidden' name='stripeToken' value='" + token + "'/>");
            $form.get(0).submit();
        }
    }
   
});
</script>
<script>
    $('#downPayment').keyup(function() {
        $('#showPaymentType').text('USD. ' + parseFloat($(this).val(), 10).toFixed(2).replace(
                /(\d)(?=(\d{3})+\.)/g, "$1.")
            .toString());
    });
</script>
@endsection
