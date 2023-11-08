@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.purchased.book_offer.add'))

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.offer.store',$book->id) }}" method="POST">
                @csrf
                <div class="col-6">
                    <label for="value">{{__('dashboard/sidebar.commons.id')}}</label>
                    <input type="text" name="purchased_book_id" id="value" class="form-control" value="{{ $book->id }}">
                    @error('purchased_book_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label>{{__('dashboard/sidebar.purchased.book_offer.offer')}}</label>
                    <select class="form-control" data-placeholder="choose offer" name="offer_id"
                        style="width: 100%;">
                        @foreach ($offers as $offer)
                            <option value="{{ $offer->id }}"
                                {{ collect(old('offer_id'))->contains($offer->id) ? 'selected' : '' }}>
                                {{ $offer->title }}
                            </option>
                        @endforeach
                    </select>
                </div>
                <div class="col-6">
                    <label for="price">{{__('dashboard/sidebar.purchased.price')}}</label>
                    <input type="text" name="price" id="price" class="form-control" value="{{ $book->price }}">
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-primary w-100" name="page" value="index"> {{__('dashboard/sidebar.commons.create')}} </button>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-dark w-100" name="page" value="back"> {{__('dashboard/sidebar.commons.return')}} </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
