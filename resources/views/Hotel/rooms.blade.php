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
					@foreach ($types as $type)
					<?php $i++?> 
								<div class="item col-sm col-md-6 col-lg-4 ftco-animate" data-item="item{{$i}}">
									<div class="room">
										<a name="roomImg" href="" class="img d-flex justify-content-center align-items-center" style="background-image: url(images/room-{{ $i }}.jpg);">
											<!-- <div class="icon d-flex justify-content-center align-items-center">
												<span class="icon-search2"></span>
											</div> -->
										</a>
										<div class="text p-3 text-center" name="Typename">
												<h3 class="mb-3">

													<a   value="{{ $type->id }}">{{ $type->name }}</a>
												</h3>
											<hr>
											<p class="pt-1"><a href="{{ route('book.reservation.vCountPerson', ['customer' => $customer->id]) }}" class="btn-custom">Book Now <span class="icon-long-arrow-right"></span></a></p>
										</div>
									</div>
								</div>
					@endforeach

		    		</div>
		    	</div>
		    	<div class="col-lg-3 sidebar">
	      		<div class="sidebar-wrap bg-light ftco-animate">
	      			<h3 class="heading mb-4">Advanced Search</h3>
	      				<div class="fields">
						  	<form id="search-form" method="get" action="{{ route('roomFiltering') }}">
						  <!-- <form id="search-form"> -->

								<div class="form-group">
									<input type="text" id="checkin_date"  name="check_in_date" class="form-control checkin_date" placeholder="Check In Date" required>
								</div>
								<div class="form-group">
									<input type="text" id="checkout_date" name="check_out_date" class="form-control checkout_date" placeholder="Check Out Date" required>
								</div>
								<div class="form-group">
								<div class="select-wrap one-third">
									<div class="icon"><span class="ion-ios-arrow-down"></span></div>
										<select name="" id="" class="form-control">
											<option value="" selected disabled>Room Type</option>
											@foreach ($types as $type)
												<option value="{{ $type->id }}">{{ $type->name }}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="form-group">
									<div class="select-wrap one-third">
										<div class="icon"><span class="ion-ios-arrow-down"></span></div>
											<select name="Capacity" id="" class="form-control">
												<option value=""  disabled>Person</option>
											<option value="1">1 Person</option>
											<option value="2">2 Person</option>
											<option value="3">3 Person</option>
											<option value="4">4 Person</option>
											<option value="5">5 Person</option>
											</select>
										</div>
									</div>
								</div>

								<div class="form-group">
									<div class="range-slider">
										<span>
											<input type="number"   value="0" min="0" max="210000"/>	-
											<input type="number"  value="210000" min="0" max="210000"/>
										</span>
										
											<input  min="0" value="0" start="500"  name="max_price" id="max_price"  max="1000000" step="500" type="range"/>
											<input  min="0" name="min_price" id="min_price"  max="1000000" step="500" type="range"/>
										</svg>
									</div>
								</div>
								<div class="form-group">
									<input type="submit" value="Search" class="btn btn-primary py-3 px-5">
								</div>`
							</form>
		            	</div>
	      		</div>
	      		<!-- <div class="sidebar-wrap bg-light ftco-animate">
	      			<h3 class="heading mb-4">Star Rating</h3>
	      			<form method="post" class="star-rating">
							  <div class="form-check">
									<input type="checkbox" class="form-check-input" id="exampleCheck1">
									<label class="form-check-label" for="exampleCheck1">
										<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i></span></p>
									</label>
							  </div>
							  <div class="form-check">
						      <input type="checkbox" class="form-check-input" id="exampleCheck1">
						      <label class="form-check-label" for="exampleCheck1">
						    	   <p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i></span></p>
						      </label>
							  </div>
							  <div class="form-check">
						      <input type="checkbox" class="form-check-input" id="exampleCheck1">
						      <label class="form-check-label" for="exampleCheck1">
						      	<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
						     </label>
							  </div>
							  <div class="form-check">
							    <input type="checkbox" class="form-check-input" id="exampleCheck1">
						      <label class="form-check-label" for="exampleCheck1">
						      	<p class="rate"><span><i class="icon-star"></i><i class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
						      </label>
							  </div>
							  <div class="form-check">
						      <input type="checkbox" class="form-check-input" id="exampleCheck1">
						      <label class="form-check-label" for="exampleCheck1">
						      	<p class="rate"><span><i class="icon-star"></i><i class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i><i class="icon-star-o"></i></span></p>
							    </label>
							  </div>
					</form>
	      		</div> -->
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
<!-- <SCript>
	const searchForm = document.getElementById('search-form');
	const searchResults = document.getElementById('search-results');

	searchForm.addEventListener('submit', (event) => {
    event.preventDefault();

    const checkInDate = document.getElementById('check_in_date').value;
    const checkOutDate = document.getElementById('check_out_date').value;

    fetch(`/search?check_in_date=${checkInDate}&check_out_date=${checkOutDate}`)
        .then(response => response.json())
        .then(data => {
            let html = '<ul>';

            if (data.length === 0) {
                html += '<li>No rooms available for the selected dates.</li>';
            } else {
                data.forEach(room => {
                    html += `<li>Room ${room.room_number} - ${room.room_type} - $${room.price}/night</li>`;
                });
            }

            html += '</ul>';

            searchResults.innerHTML = html;
        })
        .catch(error => {
            console.error(error);
            searchResults.innerHTML = '<p>Something went wrong. Please try again later.</p>';
        });
	});
</SCript>
<script>
	var selectedItem;
	document.querySelectorAll(".item").forEach(function(item) {
		item.addEventListener("click", function() {
			selectedItem = item.getAttribute("data-item");
		});
	});
</script> -->