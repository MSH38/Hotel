@extends('layouts.master')
@section('title', 'Complete Customer Details')
@section('content')
<div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
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

    <section class="ftco-section ftco-counter img" id="section-counter" style="background-image: url(images/bg_2.jpg);">

        <div class="container">
            <div class="row justify-content-center">
                <div class="form-group col-lg-12 ">
                    <div class="card shadow-sm border">
                        <div class="card-header text-center">
                            <h2>Complete Customer Details</h2>
                        </div>
                        <div class="form-group p-3">
                            <form class="row g-3" method="POST" action="{{ route('book.reservation.SCustomer') }}"
                                enctype="multipart/form-data">
                                @csrf
                                <div class="form-group col-md-12">
                                    <label for="name" class="form-label">Name</label>
                                    <input type="text" class="form-control " id="name" name="name"  value="{{ old('name', auth()->user()->name) }}" >
                                    <!-- <input type="text" class="form-control " id="name" name="name"  value="{{ old('name', auth()->user()->name) }}" disabled> -->
                                    @error('name')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="email" class="form-label">Email</label>
                                    <input type="email" class="form-control @error('email') is-invalid @enderror"  id=" email"
                                        name="email" value="{{ old('email', auth()->user()->email) }}" >
                                    @error('email')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="birthdate" class="form-label">Date of birth</label>
                                    <input type="date" class="form-control @error('birthdate') is-invalid @enderror"
                                        id="birthdate" name="birthdate" value="{{ old('birthdate') }}">
                                    @error('birthdate')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select @error('gender') is-invalid @enderror" id="gender" name="gender" aria-label="Default select example">
                                        {{-- <option selected hidden>Select</option> --}}
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                    </select>
                                    @error('gender')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="job" class="form-label">Job</label>
                                    <input type="text" class="form-control @error('job') is-invalid @enderror" id="job"
                                        name="job" value="{{ old('job') }}">
                                    @error('job')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-md-12">
                                    <label for="address" class="form-label">Address</label>
                                    <textarea class="form-control" id="address" name="address"
                                        rows="3">{{ old('address') }}</textarea>
                                    @error('address')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-mg-12">
                                    <label for="avatar" class="form-label">Profile Picture</label>
                                    <input class="form-control" type="file" name="avatar" id="avatar">
                                    @error('avatar')
                                        <div class="text-danger mt-1">
                                            {{ $message }}
                                        </div>
                                    @enderror
                                </div>
                                <div class="col-12">
                                    <button type="submit" class="btn myBtn shadow-sm border float-end">Save</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

@endsection
