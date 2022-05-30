@extends('layouts.frontend.master')

@section('content')
    <!-- Start slides -->
    <div id="slides" class="cover-slides">
        <ul class="slides-container">
            <li class="text-center">
                <img src="{{ asset('frontend/images/slider-01.jpg') }}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Mie Jablay</strong></h1>
                            <p class="m-b-40">See how your users experience your website in realtime or view
                                <br>
                                trends to see any changes in performance over time.
                            </p>
                            <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="#">Reservation</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{ asset('frontend/images/slider-02.jpg') }}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Mie Jablay</strong></h1>
                            <p class="m-b-40">See how your users experience your website in realtime or view
                                <br>
                                trends to see any changes in performance over time.
                            </p>
                            <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="#">Reservation</a></p>
                        </div>
                    </div>
                </div>
            </li>
            <li class="text-center">
                <img src="{{ asset('frontend/images/slider-03.jpg') }}" alt="">
                <div class="container">
                    <div class="row">
                        <div class="col-md-12">
                            <h1 class="m-b-20"><strong>Welcome To <br> Mie Jablay</strong></h1>
                            <p class="m-b-40">See how your users experience your website in realtime or view
                                <br>
                                trends to see any changes in performance over time.
                            </p>
                            <p><a class="btn btn-lg btn-circle btn-outline-new-white" href="#">Reservation</a></p>
                        </div>
                    </div>
                </div>
            </li>
        </ul>
        <div class="slides-navigation">
            <a href="#" class="next"><i class="fa fa-angle-right" aria-hidden="true"></i></a>
            <a href="#" class="prev"><i class="fa fa-angle-left" aria-hidden="true"></i></a>
        </div>
    </div>
    <!-- End slides -->

    <!-- Start About -->
    <div class="about-section-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-6 col-sm-12">
                    <img src="{{ asset('frontend/images/about-img.jpg') }}" alt="" class="img-fluid">
                </div>
                <div class="col-lg-6 col-md-6 col-sm-12 text-center">
                    <div class="inner-column">
                        <h1>Welcome To <span>Mie Jablay</span></h1>
                        <h4>Little Story</h4>
                        <p>Lorem ipsum dolor sit amet, consectetur adipiscing elit. Pellentesque auctor suscipit
                            feugiat. Ut at pellentesque ante, sed convallis arcu. Nullam facilisis, eros in eleifend
                            luctus, odio ante sodales augue, eget lacinia lectus erat et sem. </p>
                        <p>Sed semper orci sit amet porta placerat. Etiam quis finibus eros. Sed aliquam metus lorem, a
                            pellentesque tellus pretium a. Nulla placerat elit in justo vestibulum, et maximus sem
                            pulvinar.</p>
                        <a class="btn btn-lg btn-circle btn-outline-new-white" href="#">Reservation</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- End About -->

    <!-- Start QT -->
    <div class="qt-box qt-background">
        <div class="container">
            <div class="row">
                <div class="col-md-8 ml-auto mr-auto text-left">
                    <p class="lead ">
                        " If you're not the one cooking, stay out of the way and compliment the chef. "
                    </p>
                    <span class="lead">Michael Strahan</span>
                </div>
            </div>
        </div>
    </div>
    <!-- End QT -->

    <!-- Start Menu -->
    <div class="menu-box">
        <div class="container">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-title text-center">
                        <h2>Special Menu</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-lg-12">
                    <div class="special-menu text-center">
                        <div class="button-group filter-button-group">
                            <button class="active" data-filter="*">All</button>
                            @foreach ($categories as $category)
                                <button data-filter=".{{ $category->id }}">{{ $category->nama }}</button>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>

            <div class="row special-list">
                @foreach ($products as $product)
                    <div class="col-lg-4 col-md-6 special-grid {{ $product->category->id }}">
                        <div class="gallery-single fix">
                            <img src="{{ $product->photo }}" class="img-fluid" alt="Image">
                            <div class="why-text">
                                <h4>{{ Str::limit($product->nama, 22, '...') }}</h4>
                                <p>{{ Str::limit($product->keterangan, 30, '...') }}</p>
                                <h5>Rp. {{ numberFormat($product->harga) }}</h5>
                                <a href="{{ route('customer.cart.store', Crypt::encrypt($product->id)) }}"
                                    class="btn btn-primary">Add To Cart</a>
                            </div>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
    <!-- End Menu -->

    <!-- Start Gallery -->
    <div class="gallery-box">
        <div class="container-fluid">
            <div class="row">
                <div class="col-lg-12">
                    <div class="heading-title text-center">
                        <h2>Gallery</h2>
                        <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
                    </div>
                </div>
            </div>
            <div class="tz-gallery">
                <div class="row">
                    @foreach ($products as $product)
                        <div class="col-sm-12 col-md-4 col-lg-4">
                            <a class="lightbox" href="{{ $product->photo }}">
                                <img class="img-fluid" src="{{ $product->photo }}" alt="{{ $product->nama }}">
                            </a>
                        </div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
    <!-- End Gallery -->
@endsection
@include('layouts.includes.toastr')
