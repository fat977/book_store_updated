<div class="container-fluid">
    <div class="row align-items-center py-3 px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a href="" class="text-decoration-none">
                <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">Book</span>Store</h1>
            </a>
        </div>
        <div class="col-lg-6 col-6 text-left">
            {{-- <form action="{{ route('download.search') }}" method="POST">
                @csrf
                <div class="input-group search_box">
                    <input type="text" id="search_book" name="name" class="form-control" placeholder="Search for books" required>
                    <div class="input-group-append">
                        <span class="input-group-text bg-transparent text-primary">
                            <i class="fa fa-search"></i>
                        </span>
                    </div>
                </div>
            </form> --}}
        </div>
        @auth
        <div class="col-lg-3 col-6 text-right">
            <a href="{{ route('wishlists.index') }}" class="btn border">
                <i class="fas fa-heart text-primary"></i>
                <span class="badge wishlist-count">0</span>
            </a>
            <a href="{{ route('carts.index') }}" class="btn border">
                <i class="fas fa-shopping-cart text-primary"></i>
                <span class="badge cart-count">0</span>
            </a>
        </div>
        @endauth
    </div>
</div>