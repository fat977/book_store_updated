@extends('website.layouts.master')
@section('title',__('website/purchasable.book_detail') )
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


<!-- Shop Detail Start -->
<div class="container-fluid py-5">
    <div class="row px-xl-5">
        <div class="col-lg-5 pb-5">
            <img src="{{ asset('storage/purchasedBooks/'.$book->image) }}" style="width: 70%" alt="{{ $book->name }}">
        </div>

        <div class="col-lg-7 pb-5">
            <h3 class="font-weight-semi-bold">{{ $book->name }}</h3>
            <div class="d-flex mb-3">
                <div class="text-primary mr-2">
                    @php
                        $rate_num = number_format($rating_avg)
                    @endphp
                    @for ($i = 1; $i <= $rate_num; $i++) 
                        <i class="fa fa-star checked"></i>
                    @endfor
                    @for ($j = $rate_num; $j < 5; $j++) 
                        <i class="fa fa-star not-checked"></i>
                    @endfor
                </div>
                <small class="pt-1">
                    @if ($rating > 0)
                        <span>({{ $rating }} Reviews)</span>
                    @else
                        {{ __('website/purchasable.no_rating') }}
                    @endif
                </small>
            </div>
            <div class="d-flex justify-content-start">
                @php $getDiscountPrice = PurchasedBook::getDiscountPrice($book->id); @endphp
                @if ($getDiscountPrice > 0)
                    <h3 class="font-weight-semi-bold mb-4">${{ $getDiscountPrice }}</h3>
                    <h6 class="text-muted ml-2"><del>${{$book->price}}</del></h6>
                @else
                    <h6 class="font-weight-semi-bold mb-4">${{$book->price}}</h6>
                @endif
            </div>
            <div class="d-flex mb-3">
                <ul>
                    <li><b>{{ __('website/commons.category') }}</b> : {{ $book->category->name }}</li>
                    <li><b>{{ __('website/commons.author') }}</b> : {{ $book->author->name }}</li>
                    <li><b>{{ __('website/commons.publisher') }}</b> : {{ $book->publisher }}</li>
                    <li><b>{{ __('website/commons.released') }}</b> : {{ date('d-m-Y',strtotime($book->released_date)) }}</li>
                    @if ( $book->quantity > 0)
                    <li class="text-success"> {{ __('website/purchasable.in_stock') }} ({{ $book->quantity }} {{ __('website/purchasable.available') }})</li>
                    @else
                    <li class="text-danger">{{ __('website/purchasable.out_stock') }}</li>
                    @endif
                    </li>
                </ul>
            </div>
            <form action="{{ route('carts.store') }}" method="POST">
                @csrf
                <input type="hidden" name="purchased_book_id" value="{{ $book->id }}">
                <div class="d-flex align-items-center mb-4 pt-2">
                    <select class="form-control col-2 mr-2" name="quantity">
                        <option selected>{{ __('website/purchasable.qty') }}</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                        <option value="4">4</option>
                        <option value="5">5</option>
                    </select>
                    <br>
                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-shopping-cart mr-1"></i> {{ __('website/purchasable.add_cart') }}</button>
                </div>
            </form>
            <form action="{{ route('wishlists.store') }}" method="POST">
                @csrf
                <input type="hidden" name="purchased_book_id" value="{{ $book->id }}">
                <div class="d-flex align-items-center mb-4 pt-2">
                    <button type="submit" class="btn btn-primary px-3"><i class="fa fa-heart mr-1"></i> {{ __('website/purchasable.add_wishlist') }}</button>
                </div>
            </form>
            <div class="d-flex pt-2">
                <p class="text-dark font-weight-medium mb-0 mr-2">Share on:</p>
                <div class="d-inline-flex">
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-facebook-f"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-twitter"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-linkedin-in"></i>
                    </a>
                    <a class="text-dark px-2" href="">
                        <i class="fab fa-pinterest"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="nav nav-tabs justify-content-center border-secondary mb-4">
                <a class="nav-item nav-link active" data-toggle="tab" href="#tab-pane-1">{{ __('website/commons.description') }}</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-2">{{ __('website/commons.author') }}</a>
                <a class="nav-item nav-link" data-toggle="tab" href="#tab-pane-3">{{ __('website/purchasable.reviews') }} ({{ $reviews->count() }})</a>
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">{{ __('website/commons.description') }}</h4>
                    <p>Dolore magna est eirmod sanctus dolor, amet diam et eirmod et ipsum. Amet dolore tempor consetetur sed lorem dolor sit lorem tempor. Gubergren amet amet labore sadipscing clita clita diam clita. Sea amet et sed ipsum lorem elitr et, amet et labore voluptua sit rebum. Ea erat sed et diam takimata sed justo. Magna takimata justo et amet magna et.</p>
                    <p>{!! $book->desc !!}</p>
                </div>
                <div class="tab-pane fade" id="tab-pane-2">
                    <h4 class="mb-3">{{$book->author->name}}</h4>

                    <div class="row">
                        <div class="col-md-3">
                            <img src="{{ asset('storage/authors/'.$book->author->image) }}" style="width: 100%" alt="{{$book->author->image}}">
                        </div>
                        <div class="col-md-9">
                            <p>{!! $book->author->bio !!}</p>
                        </div>
                    </div>
                </div>
                <div class="tab-pane fade" id="tab-pane-3">
                    <div class="row">
                        <div class="col-md-6">
                            <h4 class="mb-4">{{ $reviews->count() }} review for "{{ $book->name }}"</h4>
                            @if (count($reviews) > 0)
                            @foreach ($book->user_reviews as $user)
                            <div class="media mb-4">
                                <div class="media-body">
                                    <h6 class="d-inline mr-3">
                                        {{-- @foreach ($book->user_reviews as $user) --}}
                                            {{ $user->name }}
                                        {{-- @endforeach --}}
                                        <small> - <i>{{ $user->pivot->created_at->format('d M Y') }}</i></small>
                                    </h6>
                                    @if ($user->id == Auth::id())
                                    <form action="{{ route('review.delete') }}" method="POST" class="d-inline">
                                        @csrf
                                        <input type="hidden" name="book_id" value="{{ $book->id }}">
                                        <a class="btn btn-primary" href="{{ route('review.edit',$book->id) }}">{{ __('website/purchasable.edit') }}</a>
                                        <button class="btn btn-danger">{{ __('website/purchasable.delete') }}</button>
                                    </form>
                                    @endif
                                    <div class="text-primary mb-2">
                                        @php
                                        $user_rated = $user->pivot->value
                                        @endphp
                                        @for ($i = 1; $i <= $user_rated; $i++) <i class="fas fa-star checked" style="margin-top:0"></i>
                                            @endfor
                                            @for ($j = $user_rated+1; $j <= 5; $j++) <i class="fas fa-star not-checked" style="margin-top:0"></i>
                                                @endfor
                                    </div>
                                    <p>{{ $user->pivot->review }}</p>
                                </div>
                            </div>
                            @endforeach
                            @else
                            <h5 class="text-danger">There is no reviews to show !</h5>
                            @endif

                        </div>
                        @auth
                        @if (! $user_rating)
                        <div class="col-md-6">
                            <h4 class="mb-4">{{ __('website/purchasable.leave_review') }}</h4>
                            <form action="{{ route('review.store') }}" method="POST">
                                @csrf
                                <input type="hidden" value="{{ $book->id }}" name="book_id">
                                <div class="d-flex my-3">
                                    <p class="mb-0 mr-2">{{ __('website/purchasable.rate') }} * :</p>
                                    <div class="text-primary rating-css">
                                        <input type="radio" value="1" name="book_rating" checked id="rating1">
                                        <label for="rating1" class="fa fa-star"></label>
                                        <input type="radio" value="2" name="book_rating" id="rating2">
                                        <label for="rating2" class="fa fa-star"></label>
                                        <input type="radio" value="3" name="book_rating" id="rating3">
                                        <label for="rating3" class="fa fa-star"></label>
                                        <input type="radio" value="4" name="book_rating" id="rating4">
                                        <label for="rating4" class="fa fa-star"></label>
                                        <input type="radio" value="5" name="book_rating" id="rating5">
                                        <label for="rating5" class="fa fa-star"></label>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label for="message">{{ __('website/purchasable.review') }} *</label>
                                    <textarea id="message" cols="30" rows="5" name="review" class="form-control"></textarea>
                                </div>

                                <div class="form-group mb-0">
                                    <input type="submit" value="Leave Your Review" class="btn btn-primary px-3">
                                </div>
                            </form>
                        </div>
                        @endif
                        @endauth
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">{{ __('website/commons.may_like') }}</span></h2>
    </div>
    <div class="row px-xl-5">
        <div class="col">
            <div class="owl-carousel related-carousel">
                @foreach ($similarBooks as $book)
                <div class="card product-item border-0">
                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                        <img class="img-fluid w-100" src="{{ asset('storage/purchasedBooks/'.$book->image) }}" style="height: 380px" alt="{{ $book->name }}">
                    </div>
                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                        <h6 class="text-truncate mb-3">{{ $book->name }}</h6>
                        <h6 class="text-truncate mb-3">{{ $book->author->name }}</h6>
                        <div class="d-flex justify-content-center">
                            @php $getDiscountPrice = PurchasedBook::getDiscountPrice($book->id); @endphp
                            @if ($getDiscountPrice > 0)
                                <h6>${{ $getDiscountPrice }}</h6>
                                <h6 class="text-muted ml-2"><del>${{$book->price}}</del></h6>
                            @else
                                <h6 class="text-muted ml-2">${{$book->price}}</h6>
                            @endif
                        </div>
                    </div>
                    <div class="card-footer d-flex justify-content-between bg-light border">
                        <a href="{{ route('purchase.book.details',$book->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>{{ __('website/commons.details') }}</a>
                        <a href="" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>{{ __('website/commons.add_cart') }}</a>
                    </div>
                </div>
                @endforeach

            </div>
        </div>
    </div>
</div>
<!-- Products End -->
@endsection
