@extends('layouts.master')
@section('title', 'User')
@section('content')

<div class="hero-wrap" style="background-image: url('images/bg_1.jpg');">
    <div class="overlay"></div>
    <div class="container">
      <div class="row no-gutters slider-text d-flex align-itemd-end justify-content-center">
        <div class="col-md-9 ftco-animate text-center d-flex align-items-end justify-content-center">
          <div class="text">
            <p class="breadcrumbs mb-2"><span class="mr-2"><a href="index.html">Home</a></span> <span>About</span></p>
            <h1 class="mb-4 bread">About Us</h1>
          </div>
        </div>
      </div>
    </div>
  </div>


    <div class="container mt-3">
        <div class="row justify-content-md-center mt-4 my-3">
            <div class="col-lg-8 ">
            <form class="d-flex" method="GET" action="{{ route('book.reservation.PCustomer') }}">
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" id="search-user"
                        name="q" value="{{ request()->input('q') }}">
                    <button class="btn btn-outline-dark" type="submit">Search</button>
                </form>
            </div>
        </div>
        <div class="row justify-content-md-center">
            <div class="col-lg-12">
                @if (!empty(request()->input('q')))
                    <h4>Result for "{{ request()->input('q') }}"</h4>
                    <h4>Total Data: {{ $customersCount }}</h4>
                @endif
            </div>
        </div>
        <div class="row justify-content-md-center mt-3">
            <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                <div class="pagination-block">
                    {{ $customers->onEachSide(1)->links('template.paginationlinks') }}
                </div>
            </div>
        </div>
        <div class="row">
            @foreach ($customers as $customer)
                <div class="col-lg-3 col-md-4 col-sm-6 my-1">
                    <div class="card shadow-sm justify-content-start" style="min-height:350px; ">
                        <img class="myImages" src="{{ $customer->user->getAvatar() }}"
                            style="object-fit: cover; height:250px; border-top-right-radius: 0.5rem; border-top-left-radius: 0.5rem;">
                        <div class="card-body">
                            <div class="card-text">
                                <div class="row">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <h5 class="mt-0">{{ $customer->name }}
                                                </h5>
                                                <div class="table-responsive">
                                                    <table>
                                                        <tr>
                                                            <td><i class="fas fa-envelope"></i></td>
                                                            <td>
                                                                <span>
                                                                    {{ $customer->user->email }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fas fa-user-md"></i></td>
                                                            <td>
                                                                <span>
                                                                    {{ $customer->job }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fas fa-map-marker-alt"></i></td>
                                                            <td style="white-space:nowrap" class="overflow-hidden">
                                                                <span>
                                                                    {{ $customer->address }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fas fa-phone"></i></td>
                                                            <td>
                                                                <span>
                                                                    +6281233808395
                                                                </span>
                                                            </td>
                                                        </tr>
                                                        <tr>
                                                            <td><i class="fas fa-birthday-cake"></i></td>
                                                            <td>
                                                                <span>
                                                                    {{ $customer->birthdate }}
                                                                </span>
                                                            </td>
                                                        </tr>
                                                    </table>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <hr>
                            <div class="row">
                                <div class="col-lg-12">
                                    <div class="d-grid gap-2 col-6 mx-auto">
                                        <a href="{{ route('book.reservation.viewCountPerson', ['customer' => $customer->id]) }}"
                                            class="btn btn-primary">Choose</a>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
        </div>
        <div class="row justify-content-md-center mt-3">
            <div class="col-sm-10 d-flex mx-auto justify-content-md-center">
                <div class="pagination-block">
                    {{ $customers->onEachSide(1)->links('template.paginationlinks') }}
                </div>
            </div>
        </div>
    </div>
@endsection
