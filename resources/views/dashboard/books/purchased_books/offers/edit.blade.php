@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.purchased.offer.edit'))

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.offers.update', $offer->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="title_en">{{__('dashboard/sidebar.commons.title_en')}}</label>
                        @php $title = implode($offer->getTranslations('title',['en'])); @endphp
                        <input type="text" name="title_en" id="title_en" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $title }}">
                        @error('title_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="title_ar">{{__('dashboard/sidebar.commons.title_ar')}}</label>
                        @php $title = implode($offer->getTranslations('title',['ar'])); @endphp
                        <input type="text" name="title_ar" id="title_ar" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $title }}">
                        @error('title_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label>{{__('dashboard/sidebar.purchased.offer.start_at')}}</label>
                        <input type="datetime-local" name="start_at" class="form-control"
                            value="{{ old('start_at', $offer->start_at) }}">
                        @error('start_at')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="end_at">{{__('dashboard/sidebar.purchased.offer.end_at')}}</label>
                        <input type="datetime-local" name="end_at" class="form-control"
                            value="{{ old('end_at', $offer->end_at) }}">
                        @error('end_at')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <label for="discount">{{__('dashboard/sidebar.purchased.offer.discount')}}</label>
                    <input type="text" name="discount" id="discount" class="form-control" placeholder="" aria-describedby="helpId" value="{{ $offer->discount }}">
                    @error('discount')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-primary w-100"> {{__('dashboard/sidebar.commons.update')}} </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
