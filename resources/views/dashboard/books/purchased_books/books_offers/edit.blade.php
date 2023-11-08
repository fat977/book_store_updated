@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.purchased.book_offer.edit'))

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.offer.update',[$data->purchased_book_id,$data->offer_id]) }}" method="POST">
                @csrf
                <div class="col-6">
                    <label for="value">{{__('dashboard/sidebar.commons.id')}}</label>
                    <input type="text" name="purchased_book_id" class="form-control" value="{{ $data->purchased_book_id }}">
                    @error('purchased_book_id')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-6">
                    <label for="name_en">{{__('dashboard/sidebar.purchased.book_offer.offer')}}</label>
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
                    <label>{{__('dashboard/sidebar.purchased.price')}}</label>
                    <input type="text" name="price" class="form-control" value="{{ $data->price}}">
                    @error('price')
                        <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-primary w-100" value="index"> {{__('dashboard/sidebar.commons.update')}} </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
