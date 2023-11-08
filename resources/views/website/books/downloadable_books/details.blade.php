@extends('website.layouts.master')
@section('title',__('website/downloadable.book_detail') )
@section('content')
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
            <img src="{{ asset('storage/downloadedBook/images/'.$book->image) }}" style="width: 70%" alt="{{ $book->name }}">
        </div>

        <div class="col-lg-7 pb-5 book_data">
            <p id="download-success"></p>
            <h3 class="font-weight-semi-bold">{{ $book->name }}</h3>
            <div class="d-flex mb-3">
                <ul>
                    <li><b>{{ __('website/commons.category') }}</b> : {{ $book->category->name }}</li>
                    <li><b>{{ __('website/commons.author') }}</b> : {{ $book->author->name }}</li>
                    <li><b>{{ __('website/commons.publisher') }}</b> : {{ $book->publisher }}</li>
                    <li><b>{{ __('website/downloadable.size') }}</b> : {{ $book->size }}</li>
                    <li><b>{{ __('website/downloadable.no_pages') }}</b> : {{ $book->no_pages }}</li>
                    <li><b>{{ __('website/commons.released') }}</b> : {{ date('d-m-Y',strtotime($book->released_date)) }}</li>
                    <li><b>{{ __('website/downloadable.no_downloads') }}</b> : {{ $downloads_count }}</li>
                </ul>
            </div>

            @if (Auth::id())
            <tr>
                <input type="hidden" value="{{ $book->id }}" class="book_id">

                <td><button type="button" class="btn btn-success addToDownloads">
                    {{ __('website/downloadable.download') }}
                    </button>
                <td>
            </tr>
            <tr>
                <input type="hidden" value="{{ $book->id }}" class="book_id">
                <td>
                    <div class="card-body pt-5">
                        <div id="countdown"></div>
                    </div>
                    <button type="button" class="btn btn-success new_link" style="display: none">
                        <a href="{{ route('download.file',$book->file) }}" style="text-decoration: none; color:aliceblue;">Get Link</a>
                    </button>
                <td>
            </tr>
            @else
                <div class="alert alert-danger d-block w-100">You need to login to download !</div>
            @endif

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
            </div>
            <div class="tab-content">
                <div class="tab-pane fade show active" id="tab-pane-1">
                    <h4 class="mb-3">{{ __('website/commons.description') }}</h4>
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

            </div>
        </div>
    </div>
</div>
<!-- Shop Detail End -->


<!-- Products Start -->
@if (count($similarBooks) > 0)
<div class="container-fluid py-5">
    <div class="text-center mb-4">
        <h2 class="section-title px-5"><span class="px-2">You May Also Like</span></h2>
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
                            <h6>{{ $book->price }}</h6>
                            <h6 class="text-muted ml-2"><del>$123.00</del></h6>
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
@endif

<!-- Products End -->
@endsection
