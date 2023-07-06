@extends('layouts.master')
@section('title', 'Contact us')
@section('content')
<div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
      <div class="overlay"></div>
      <div class="container">
        <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
          <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          	<div class="text">
	            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>Contact</span></p>
	            <h1 class="mb-4 bread">Contact Us</h1>
            </div>
          </div>
        </div>
      </div>
    </div>


    <section class="ftco-section contact-section bg-light">
    @if(Session::has('success'))
            <div class="alert alert-success">
                {{Session::get('success')}}
            </div>
    @endif
      <div class="container">
        <div class="row d-flex mb-5 contact-info">
          <div class="col-md-12 mb-4">
            <h2 class="h3">Contact Information</h2>
          </div>
          <div class="w-100"></div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Address:</span> 198 West 21th Street, Suite 721 New York NY 10016</p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Phone:</span> <a href="tel://1234567920">+ 1235 2355 98</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Email:</span> <a href="mailto:info@yoursite.com">info@yoursite.com</a></p>
	          </div>
          </div>
          <div class="col-md-3 d-flex">
          	<div class="info bg-white p-4">
	            <p><span>Website</span> <a href="#">yoursite.com</a></p>
	          </div>
          </div>
        </div>
        <div class="row block-9">
          <div class="col-md-6 order-md-last d-flex">
            <form action="{{route('contact.submit')}}" method="post" class="bg-white p-5 contact-form">
              @csrf
              <div class="form-group">
                <input type="text" id="name" name="name" class="form-control" placeholder="Your Name">
                <!-- Error -->
                @if ($errors->has('name'))
                <div class="error">
                    {{ $errors->first('name') }}
                </div>
                @endif
              </div>
              
              <div class="form-group">
                <input type="email" id="email" name="email" class="form-control" placeholder="Your Email">
                @if ($errors->has('email'))
                <div class="error">
                    {{ $errors->first('email') }}
                </div>
                @endif
              </div>
              <div class="form-group">
                <input type="text" id="phone" name="phone" class="form-control" placeholder="phone number">
                @if ($errors->has('phone'))
                <div class="error">
                    {{ $errors->first('phone') }}
                </div>
                @endif
              </div>
              <div class="form-group">
                <input type="text" id="subject" name="subject" class="form-control" placeholder="Subject">
                @if ($errors->has('subject'))
                <div class="error">
                    {{ $errors->first('subject') }}
                </div>
                @endif
              </div>
              <div class="form-group">
                <textarea  id="message"  name="message" cols="30" rows="7" class="form-control" placeholder="Message"></textarea>
                @if ($errors->has('message'))
                <div class="error">
                    {{ $errors->first('message') }}
                </div>
                @endif
              </div>
              <div class="form-group">
                <input type="submit" name="send" value="Send Message" class="btn btn-primary py-3 px-5">
              </div>
            </form>
          


          
          </div>

          <div class="col-md-6 d-flex">
          	<div id="map" class="bg-white"></div>
          </div>
        </div>
      </div>
    </section>
    
@endsection
