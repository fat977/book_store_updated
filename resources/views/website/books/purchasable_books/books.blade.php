@extends('website.layouts.master')
@section('title', __('website/commons.purchasable_books') )
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


<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
        <!-- Shop Sidebar Start -->
        <div class="col-lg-3 col-md-12">
            <!-- Price Start -->
            <div class="border-bottom mb-4 pb-4">
                <h5 class="font-weight-semi-bold mb-4">Filter by price</h5>
                <form>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" checked id="price-all">
                        <label class="custom-control-label" for="price-all">All Price</label>
                        <span class="badge border font-weight-normal">1000</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-1">
                        <label class="custom-control-label" for="price-1">$0 - $100</label>
                        <span class="badge border font-weight-normal">150</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-2">
                        <label class="custom-control-label" for="price-2">$100 - $200</label>
                        <span class="badge border font-weight-normal">295</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-3">
                        <label class="custom-control-label" for="price-3">$200 - $300</label>
                        <span class="badge border font-weight-normal">246</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between mb-3">
                        <input type="checkbox" class="custom-control-input" id="price-4">
                        <label class="custom-control-label" for="price-4">$300 - $400</label>
                        <span class="badge border font-weight-normal">145</span>
                    </div>
                    <div class="custom-control custom-checkbox d-flex align-items-center justify-content-between">
                        <input type="checkbox" class="custom-control-input" id="price-5">
                        <label class="custom-control-label" for="price-5">$400 - $500</label>
                        <span class="badge border font-weight-normal">168</span>
                    </div>
                </form>
            </div>
            <!-- Price End -->
        </div>
        <!-- Shop Sidebar End -->


        <!-- Shop Product Start -->
        <div class="col-lg-9 col-md-12">
            <div class="row pb-3">
                <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="{{ route('purchase.search') }}" method="POST">
                            @csrf
                            <div class="input-group search_box">
                                <input type="text" id="search_purchased" name="name" class="form-control" placeholder="{{ __('website/commons.search') }}" required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="form-group">
                            <select name="sort" class="form-control" id="purchased_sort">
                                <option value="book_oldest">{{ __('website/commons.oldest') }} </option>
                                <option value="book_newest">{{ __('website/commons.newest') }}</option>
                                <option value="price_highest">{{ __('website/commons.highest') }}</option>
                                <option value="price_lowest">{{ __('website/commons.lowest') }}</option>
                                <option value="name_a_z">{{ __('website/commons.a_z') }}</option>
                                <option value="name_z_a">{{ __('website/commons.z_a') }}</option>                  
                            </select>
                        </div>
                    </div>
                </div>
                <div class="row col-lg-12 px-5">
                    <div class="row search_result">
                        <div class="row content">
                            @forelse ($books as $book)
                            <div class="col-lg-4 col-md-6 col-sm-12 pb-1">
                                <div class="card product-item border-0 mb-4">
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
                                        <a href="{{ route('carts.store_directly',$book->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>{{ __('website/purchasable.add_cart') }}</a>
                                    </div>
                                </div>
                            </div>
                            @empty
                            <div class="text-danger">There are no books yet !</div>
                            @endforelse
                        </div>
                    </div>
                </div>
                <div class="col-12 pb-1">
                    <nav aria-label="Page navigation">
                        <ul class="pagination justify-content-center mb-3">
                            {{ $books->links() }}
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
        <!-- Shop Product End -->
    </div>
</div>
<!-- Shop End -->
@endsection
