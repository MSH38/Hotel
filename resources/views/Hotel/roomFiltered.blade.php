@extends('layouts.master')
@section('title', 'Hotel Rooms')
@section('content')
<div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>About</span></p>
	            <h1 class="mb-4 bread">Rooms</h1>
            </div>
          </div>
        </div>
      </div>
    </div>
    <section class="ftco-section bg-light">
    	<div class="container">
    		<div class="row">
	            <div class="col-lg-9">
		    		<div class="row">
					<?php $i=0;?>
					@foreach ($roomss as $room)
					<?php $i++?> 
								<div class="item col-sm col-md-6 col-lg-4 ftco-animate" data-item="item{{$i}}">
									<div class="room">
										<a name="roomImg" href="{{route('roomBooking',['roomBooking' =>$type->id]) }}" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/room-{{ $i }}.jpg);">
											<div class="icon d-flex justify-content-center align-items-center">
												<span class="icon-search2"></span>
											</div>
										</a>
										<div class="text p-3 text-center" name="Typename">
												<h3 class="mb-3">
													<a   value="{{ $room->type->id }}">{{ $room->type->name }}</a>
												</h3>
											<hr>
											<p class="pt-1"><a href="{{route('roomBooking',['roomBooking' =>$type->id]) }}" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
										</div>
									</div>
								</div>
					@endforeach
	      		
	            </div>
		    </div>
    	</div>
    </section>
    <section class="instagram pt-5">
      <div class="container-fluid">
        <div class="row no-gutters justify-content-center pb-5">
          <div class="col-md-7 text-center heading-section ftco-animate">
            <h2><span>Instagram</span></h2>
          </div>
        </div>
        <div class="row no-gutters">
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-1.jpg" class="insta-img image-popup" style="background-image: url(images/insta-1.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-2.jpg" class="insta-img image-popup" style="background-image: url(images/insta-2.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-3.jpg" class="insta-img image-popup" style="background-image: url(images/insta-3.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-4.jpg" class="insta-img image-popup" style="background-image: url(images/insta-4.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
          <div class="col-sm-12 col-md ftco-animate">
            <a href="images/insta-5.jpg" class="insta-img image-popup" style="background-image: url(images/insta-5.jpg);">
              <div class="icon d-flex justify-content-center">
                <span class="icon-instagram align-self-center"></span>
              </div>
            </a>
          </div>
        </div>
      </div>
    </section>

@endsection
