@extends('website.layouts.master')
@section('title','Offer Books')
@section('content')
{{-- <?php use App\Models\PurchasedBook; ?> --}}
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">Our Store</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">@yield('title')</p>
        </div>
    </div>
</div>
<!-- Page Header End -->


<!-- Shop Start -->
<div class="container-fluid pt-5">
    <div class="row px-xl-5">
       
        <!-- Shop Product Start -->
        <div class="col-lg-12 col-md-12">
            <div class="row pb-3">
                {{-- <div class="col-12 pb-1">
                    <div class="d-flex align-items-center justify-content-between mb-4">
                        <form action="{{ route('purchase.search') }}" method="POST">
                            @csrf
                            <div class="input-group search_box">
                                <input type="text" id="search_purchased" name="name" class="form-control" placeholder="Search for books" required>
                                <div class="input-group-append">
                                    <span class="input-group-text bg-transparent text-primary">
                                        <i class="fa fa-search"></i>
                                    </span>
                                </div>
                            </div>
                        </form>
                        <div class="form-group">
                            <select name="sort" class="form-control" id="purchased_sort">
                                <option selected="" value="">Select</option>
                                <option value="book_oldest">Oldest Book </option>
                                <option value="book_newest">Newest Book</option>
                                <option value="price_highest">Highest Price</option>
                                <option value="price_lowest">Lowest Price</option>
                                <option value="name_a_z">Name_A_Z</option>
                                <option value="name_z_a">Name_Z_A</option>                  
                            </select>
                        </div>
                    </div>
                </div> --}}
                <div class="row col-lg-12 px-5">
                    <div class="row search_result">
                        <div class="row content">
                            @forelse ($offerBooks as $book)
                            <div class=" pb-1">
                                <div class="card product-item border-0 mb-4">
                                    <div class="card-header product-img position-relative overflow-hidden bg-transparent border p-0">
                                        <img class="img-fluid w-100" src="{{ asset('storage/purchasedBooks/'.$book->image) }}" style="height: 380px" alt="{{ $book->name }}">
                                    </div>
                                    <div class="card-body border-left border-right text-center p-0 pt-4 pb-3">
                                        <h6 class="text-truncate mb-3">{{ $book->name }}</h6>
                                        <h6 class="text-truncate mb-3">{{ $book->author->name }}</h6>
                                        <div class="d-flex justify-content-center">
                                            <h6 class="text-muted ml-2"><del>${{$book->price}}</del></h6>
                                            <h6 class="text-muted ml-2">${{$book->price_after_discount}}</h6>
                                        </div>
                                    </div>
                                    <div class="card-footer d-flex justify-content-between bg-light border">
                                        <a href="{{ route('purchase.book.details',$book->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-eye text-primary mr-1"></i>View Detail</a>
                                        <a href="{{ route('carts.store_directly',$book->id)}}" class="btn btn-sm text-dark p-0"><i class="fas fa-shopping-cart text-primary mr-1"></i>Add To Cart</a>
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
                            {{ $offerBooks->links() }}
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
