@extends('website.layouts.master')
@section('title',__('website/wishlist.wishlist') )
@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">@yield('title')</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">{{ __('website/commons.home') }}</a></p>
            <p class="m-0 px-2">@yield('title')</p>
            <p class="m-0"></p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Cart Start -->
<div class="container-fluid pt-5 load">
    <div class="row px-xl-5 WishlistItems">
        <div class="col-lg-12 table-responsive mb-5">
            @if (count($wishlists) > 0)
            <table class="table table-bordered mb-0">
                <thead class="bg-secondary text-center text-dark">
                    <tr>
                        <th>{{ __('website/wishlist.book') }}</th>
                        <th>{{ __('website/commons.remove') }}</th>
                        <th>{{ __('website/commons.add_cart') }}</th>
                    </tr>
                </thead>
                <tbody class=" book_data">
                    @foreach ($user->books_wishlists as $book)
                    <tr>
                        <input type="hidden" value="{{ $book->id }}" class="purchased_book_id">
                        <td><img src="{{ asset('storage/purchasedBooks/'.$book->image)}}" alt="" style="width: 50px;" class="mr-2">{{ $book->name }}</td>
                        <td class="align-middle text-center"><button class="btn btn-sm btn-primary wishlist_delete" href=""><i class="fa fa-times"></i></button></td>
                        <td class="align-middle text-center"><a href="{{ route('carts.store_directly',$book->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a></td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
            @else
                <div class="text-danger text-center">{{ __('website/wishlist.no_items') }}</div>
            @endif
            
        </div>
    </div>
</div>
<!-- Cart End -->
@endsection
