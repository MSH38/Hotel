@extends('auth.auth')
@section('title', 'Register')
@section('content')
    <link href="{{ asset('style/css/stylelogin.css') }}" rel="stylesheet">
    <div class="wavestop">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0099ff" fill-opacity="1"
                d="M0,224L48,186.7C96,149,192,75,288,42.7C384,11,480,21,576,74.7C672,128,768,224,864,256C960,288,1056,256,1152,234.7C1248,213,1344,203,1392,197.3L1440,192L1440,0L1392,0C1344,0,1248,0,1152,0C1056,0,960,0,864,0C768,0,672,0,576,0C480,0,384,0,288,0C192,0,96,0,48,0L0,0Z">
            </path>
        </svg>
    </div>
    <div class="container">
        <div class="row">
            <div class="col-sm-9 col-md-7 col-lg-5 mx-auto">
                <div class="glassmorphism card-signin my-5">
                    <div class="card-body">
                        <div class="row mb-3">
                            <div class="col-lg-12">
                                <div class="d-flex justify-content-center">
                                    <img src="img/logo/sip.png" width="100" height="100" class="rounded-circle mx-auto"
                                        alt="logo" style="background-color: white;">
                                </div>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-12">
                                <h5 class="card-title text-center">Hotel Information System</h5>
                            </div>
                        </div>
                        <!-- <form class="form-signin" action="{{ route('register') }}" method="post" >
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">

                                    <div class="form-label-group">
                                        <input type="text" id="name" name="name" class="form-control" placeholder="Full Name"
                                            value="" required autofocus>
                                        <label for="name">Name</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                            value="" required autofocus>
                                        <label for="email">Email</label>
                                    </div>
                                  
                                    
                                    <div class="form-label-group">
                                        <input type="password" id="password" name="password" autocomplete="new-password"
                                            class="form-control" placeholder="Password" value="" required>
                                        <label for="password">Password</label>
                                    </div>
                                    <div class="form-label-group">
                                        <input type="password" id="password_confirm" name="password_confirm"
                                            class="form-control" placeholder="Repead Password" value="" required>
                                        <label for="password_confirm">confirm password</label>
                                    </div>
                                    


                                </div>
                            </div>
                            <div class="row">
                                <div class=" d-flex justify-content-center">
                                    <button id="btn_submit" class="w-100 btn btn-lg btn-primary text-white fw-bold p-2"
                                            type="submit" style="border-radius: 2rem;">Sign up
                                    </button>
                                </div>
                            </div>
                            <hr class="my-4">
                            <p class="text-center">Do you have an acount? <a href="/login">login</a></p>
                        </form> -->

                        <form method="POST" action="{{ route('register') }}">
                            @csrf
                            <div class="row">
                                <div class="col-lg-12">
                                    <!-- Name -->
                                    <div class="form-label-group">
                                        <x-text-input type="text" id="name" name="name" class="form-control" placeholder="Full Name"
                                        :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div>
                                    <!-- Email Address -->
                                    <div class="form-label-group">
                                        <x-text-input type="email" id="email" name="email" class="form-control" placeholder="Email"
                                        :value="old('email')" required autocomplete="username" />
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div>
                                    <!-- Password -->
                                    <div class="form-label-group">
                                        <x-text-input type="password" id="password" name="password" autocomplete="new-password"
                                            class="form-control" placeholder="password" required autocomplete="new-password" />
                                        <x-input-label for="password" :value="__('password')" />
                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div>
                                    <!-- Confirm Password -->
                                    <div class="form-label-group">
                                        <x-text-input  id="password_confirmation" class="form-control" placeholder="Repead Password" type="password"
                                            name="password_confirmation" required autocomplete="new-password" />
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div>

                                    <div class="flex items-center justify-end mt-4">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>
                                        <div class=" d-flex justify-content-center">
                                            <button id="btn_submit" class="w-100 btn btn-lg btn-primary text-white fw-bold p-2"
                                                    type="submit" style="border-radius: 2rem;">{{ __('Register') }}
                                            </button>
                                        </div>

                                    </div>

                                    <!-- Name -->
                                    <!-- <div>
                                        <x-input-label for="name" :value="__('Name')" />
                                        <x-text-input id="name" class="block mt-1 w-full" type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
                                        <x-input-error :messages="$errors->get('name')" class="mt-2" />
                                    </div> -->

                                    <!-- Email Address -->
                                    <!-- <div class="mt-4">
                                        <x-input-label for="email" :value="__('Email')" />
                                        <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autocomplete="username" />
                                        <x-input-error :messages="$errors->get('email')" class="mt-2" />
                                    </div> -->

                                    <!-- Password -->
                                    <!-- <div class="mt-4">
                                        <x-input-label for="password" :value="__('Password')" />

                                        <x-text-input id="password" class="block mt-1 w-full"
                                                        type="password"
                                                        name="password"
                                                        required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password')" class="mt-2" />
                                    </div> -->

                                    <!-- Confirm Password -->
                                    <!-- <div class="mt-4">
                                        <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

                                        <x-text-input id="password_confirmation" class="block mt-1 w-full"
                                                        type="password"
                                                        name="password_confirmation" required autocomplete="new-password" />

                                        <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
                                    </div> -->

                                    <!-- <div class="flex items-center justify-end mt-4">
                                        <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                                            {{ __('Already registered?') }}
                                        </a>

                                        <x-primary-button class="ml-4">
                                            {{ __('Register') }}
                                        </x-primary-button>
                                    </div> -->
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- <div class="form-label-group">
                                        <div class="form-group">
                                            <div class='input-group date' id='datetimepicker1'>
                                                <input type='text' class="form-control" placeholder='dd/mm/yyyy' />
                                                <span class="input-group-addon">
                                                    <span class="glyphicon glyphicon-calendar"></span>
                                                </span>
                                            </div>
                                        </div>
                                    </div> -->
                                    <!-- <div class="form-label-group">
                                        <div class="datepicker date input-group">
                                            <input type="text"  class="form-control" placeholder="Choose Date" id="fecha1">
                                                <span class="input-group-text"><i class="fa fa-calendar"></i></span>
                                        </div>
                                    </div> -->
                                    
                                <!-- <div class="form-label-group">
                                        <select class="form-select" >
                                            <option selected class="form-control">Gender</option>
                                            <option value="Male" class="form-control">Male</option>
                                            <option value="Female" class="form-control">Female</option>
                                        </select>
                                </div> -->
    <!-- <div class="wavesbottom">
        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
            <path fill="#0099ff" fill-opacity="1"
                d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,122.7C672,149,768,235,864,234.7C960,235,1056,149,1152,117.3C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
            </path>
        </svg>
    </div> -->
    
@endsection
<svg class="wavesbottom" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 1440 320">
    <path fill="#0099ff" fill-opacity="1"
        d="M0,224L48,213.3C96,203,192,181,288,154.7C384,128,480,96,576,122.7C672,149,768,235,864,234.7C960,235,1056,149,1152,117.3C1248,85,1344,107,1392,117.3L1440,128L1440,320L1392,320C1344,320,1248,320,1152,320C1056,320,960,320,864,320C768,320,672,320,576,320C480,320,384,320,288,320C192,320,96,320,48,320L0,320Z">
    </path>
</svg>

<!-- <script>
    
$(function () {
  $('.datepicker').datepicker({
    language: "es",
    autoclose: true,
    format: "dd/mm/yyyy"
  });
});
</script> -->