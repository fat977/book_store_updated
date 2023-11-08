@extends('website.layouts.master')
@section('title',__('website/checkout.checkout') )
@section('content')
<?php use App\Models\PurchasedBook; ?>
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">@yield('title')</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">{{ __('website/commons.home') }}</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">@yield('title')</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Checkout Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <div class="col-lg-8">
            <div class="mb-4">
                <h4 class="font-weight-semi-bold mb-4">{{ __('website/checkout.shipping_information') }}</h4>
                <div class="row">
                    <div class="col-md-6 form-group">
                        <label>{{ __('website/checkout.name') }}</label>
                        <input class="form-control" type="text" value="{{ $user->name }}" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('website/checkout.email') }}</label>
                        <input class="form-control" type="text" value="{{ $user->email }}" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('website/checkout.mobile') }}</label>
                        <input class="form-control" type="text" value="{{ $user->phone }}" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('website/checkout.city') }}</label>
                        <input class="form-control" type="text" value="{{ $user->addresses[0]->region->city->name }}" readonly>
                    </div>
                    <div class="col-md-6 form-group">
                        <label>{{ __('website/checkout.region') }}</label>
                        <input class="form-control" type="text" value="{{ $user->addresses[0]->region->name }}" readonly>
                    </div>
                    <div class="col-12 form-row mb-3">
                        <div class="col-4">
                            <label>{{ __('website/checkout.street') }}</label>
                            <input class="form-control" type="text" value="{{ $user->addresses[0]->street }}" readonly>
                        </div>
                        <div class="col-4">
                            <label>{{ __('website/checkout.building') }}</label>
                            <input class="form-control" type="text" value="{{ $user->addresses[0]->building }}" readonly>
                        </div>
                        <div class="col-4">
                            <label>{{ __('website/checkout.floor') }}</label>
                            <input class="form-control" type="text" value="{{ $user->addresses[0]->floor }}" readonly>
                        </div>
                    </div>
                    <div class="col-md-12 form-group">
                        <div>
                            <a href="{{ route('profile.edit') }}" class="btn btn-primary text-white d-block w-100">Edit</a>  
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="col-lg-4">
            @if (count($carts) > 0)
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">{{ __('website/checkout.order_total') }}</h4>
                    </div>
                    <div class="card-body">
                        <h5 class="font-weight-medium mb-3">Books</h5>
                        @php $total_price = 0 @endphp
                        @foreach ($user->books_carts as $book)
                            <div class="d-flex justify-content-between">
                                <p>{{ $book->name }} x {{ $book->pivot->quantity }}</p>
                                <p>
                                    @php $getDiscountPrice = PurchasedBook::getDiscountPrice($book->id); @endphp
                                    @if ($getDiscountPrice > 0)
                                        <h6>${{ $getDiscountPrice }}</h6>
                                    @else
                                        <h6 class="text-muted ml-2">${{$book->price}}</h6>
                                    @endif
                                </p>
                            </div>
                            @if ($getDiscountPrice > 0)
                                @php $total_price = $total_price +( $getDiscountPrice * $book->pivot->quantity) @endphp
                            @else
                                @php $total_price = $total_price +( $book->price * $book->pivot->quantity) @endphp
                            @endif
                        @endforeach
                        <hr class="mt-0">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">{{ __('website/checkout.subtotal') }}</h6>
                            <h6 class="font-weight-medium">${{ $total_price }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">{{ __('website/checkout.shipping') }}</h6>
                            <h6 class="font-weight-medium">${{ $user->addresses[0]->region->city->shipping }}</h6>
                        </div>
                    </div>
                    <div class="card-footer border-secondary bg-transparent">
                        <div class="d-flex justify-content-between mt-2">
                            <h5 class="font-weight-bold">{{ __('website/commons.total') }}</h5>
                            <h5 class="font-weight-bold">
                                @php
                                    $total = ( $total_price + $user->addresses[0]->region->city->shipping)
                                @endphp
                                ${{ $total }}
                            </h5>
                        </div>
                    </div>
                </div>
                <form action="{{ route('order.placeOrder') }}" method="POST">
                    @csrf
                    <div class="card border-secondary mb-5">
                        <div class="card-header bg-secondary border-0">
                            <h4 class="font-weight-semi-bold m-0">{{ __('website/checkout.payment') }}</h4>
                        </div>
                        <div class="card-body">
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="PayPal" name="payment_method" id="paypal">
                                    <label class="custom-control-label" for="paypal">{{ __('website/checkout.paypal') }}</label>
                                </div>
                            </div>
                            <div class="form-group">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" value="COD" name="payment_method" id="directcheck">
                                    <label class="custom-control-label" for="directcheck">{{ __('website/checkout.cod') }}</label>
                                </div>
                            </div>
                            {{-- <div class="">
                                <div class="custom-control custom-radio">
                                    <input type="radio" class="custom-control-input" name="payment" id="banktransfer">
                                    <label class="custom-control-label" for="banktransfer">Bank Transfer</label>
                                </div>
                            </div> --}}
                        </div>
                        <div class="card-footer border-secondary bg-transparent">
                            <button class="btn btn-lg btn-block btn-primary font-weight-bold my-3 py-3">{{ __('website/checkout.place_order') }}</button>
                        </div>
                    </div>
                </form>
            @endif
        </div>
    </div>
</div>
<!-- Checkout End -->
@endsection
