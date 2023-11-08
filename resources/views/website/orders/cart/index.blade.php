@extends('website.layouts.master')
@section('title',__('website/cart.shopping_cart') )
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


<!-- Cart Start -->
<div class="container-fluid pt-5 load">
    <div class="row px-xl-5 CartItems">
        @if (count($carts) > 0)
            <div class="col-lg-8 table-responsive mb-5">
                <table class="table table-bordered mb-0">
                    <thead class="bg-secondary text-center text-dark">
                        <tr>
                            <th>{{ __('website/commons.books') }}</th>
                            <th>{{ __('website/commons.price') }}</th>
                            <th>{{ __('website/commons.quantity') }}</th>
                            <th>{{ __('website/commons.total') }}</th>
                            <th>{{ __('website/commons.remove') }}</th>
                        </tr>
                    </thead>
                    <tbody class=" book_data">
                        @php $total_price = 0 @endphp
                        @foreach ($user->books_carts as $book)
                            <tr class="book_data">
                                <input type="hidden" value="{{ $book->id }}" class="purchased_book_id">
                                <td class=""><img src="{{ asset('storage/purchasedBooks/'.$book->image)}}" alt="" style="width: 50px;" class="mr-2">{{ $book->name }}</td>
                                <td class="text-center align-middle">
                                    @php $getDiscountPrice = PurchasedBook::getDiscountPrice($book->id); @endphp
                                    @if ($getDiscountPrice > 0)
                                        <h6>${{ $getDiscountPrice }}</h6>
                                    @else
                                        <h6 class="text-muted ml-2">${{$book->price}}</h6>
                                    @endif
                                </td>
                                <td class="text-center align-middle">
                                    <div class="input-group quantity mx-auto" style="width: 100px;">
                                        <div class="input-group-btn change_quantity">
                                            <button class="btn btn-sm btn-primary btn-minus">
                                                <i class="fa fa-minus"></i>
                                            </button>
                                        </div>
                                        <input type="text" class="form-control form-control-sm bg-secondary text-center cart_quantity_input" value="{{ $book->pivot->quantity }}">
                                        <div class="input-group-btn change_quantity">
                                            <button class="btn btn-sm btn-primary btn-plus">
                                                <i class="fa fa-plus"></i>
                                            </button>
                                        </div>
                                    </div>
                                </td>
                                <td class="text-center align-middle">
                                
                                    @if ($getDiscountPrice > 0)
                                        <h6>${{ $getDiscountPrice * $book->pivot->quantity }}</h6>
                                    @else
                                        <h6 class="text-muted ml-2">${{$book->price * $book->pivot->quantity}}</h6>
                                    @endif
                                </td>
                                <td class="text-center align-middle"><button class="btn btn-sm btn-primary cart_delete" href=""><i class="fa fa-times"></i></button></td>
                            </tr>
                            @if ($getDiscountPrice > 0)
                                @php $total_price = $total_price +( $getDiscountPrice * $book->pivot->quantity) @endphp
                            @else
                                @php $total_price = $total_price +( $book->price * $book->pivot->quantity) @endphp
                            @endif
                        @endforeach
                    </tbody>
                </table>
            </div>
            <div class="col-lg-4">
                {{-- <form class="mb-5" action="">
                    <div class="input-group">
                        <input type="text" class="form-control p-4" placeholder="Coupon Code">
                        <div class="input-group-append">
                            <button class="btn btn-primary">Apply Coupon</button>
                        </div>
                    </div>
                </form> --}}
                <div class="card border-secondary mb-5">
                    <div class="card-header bg-secondary border-0">
                        <h4 class="font-weight-semi-bold m-0">{{ __('website/cart.summary') }}</h4>
                    </div>
                    <div class="card-body">
                        <div class="d-flex justify-content-between mb-3 pt-1">
                            <h6 class="font-weight-medium">{{ __('website/cart.subtotal') }}</h6>
                            <h6 class="font-weight-medium">${{ $total_price }}</h6>
                        </div>
                        <div class="d-flex justify-content-between">
                            <h6 class="font-weight-medium">{{ __('website/cart.shipping') }}</h6>
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
                        <a href="{{ route('order.checkout') }}" class="btn btn-block btn-primary my-3 py-3">{{ __('website/cart.checkout') }}</a>
                    </div>
                </div>
            </div>
        @else
            <div class="text-danger text-center">{{ __('website/cart.no_items') }}</div>
        @endif
    </div>
</div>
<!-- Cart End -->
@endsection
