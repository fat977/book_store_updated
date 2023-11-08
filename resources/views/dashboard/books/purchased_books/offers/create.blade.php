@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.purchased.offer.add'))

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.offers.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label>{{__('dashboard/sidebar.commons.title_en')}}</label>
                        <input type="text" name="title_en" id="title_en" class="form-control" value="{{old('title_en')}}">
                        @error('title_en')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label>{{__('dashboard/sidebar.commons.title_ar')}}</label>
                        <input type="text" name="title_ar" id="title_ar" class="form-control" value="{{old('title_ar')}}">
                        @error('title_ar')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label>{{__('dashboard/sidebar.purchased.offer.start_at')}}</label>
                        <input type="datetime-local" name="start_at" class="form-control"
                            value="{{ old('start_at') }}">
                        @error('start_at')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label>{{__('dashboard/sidebar.purchased.offer.end_at')}}</label>
                        <input type="datetime-local" name="end_at" class="form-control"
                            value="{{ old('end_at') }}">
                        @error('end_at')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="col-6">
                    <label>{{__('dashboard/sidebar.purchased.offer.discount')}}</label>
                    <input type="text" name="discount" id="discount" class="form-control" value="{{old('discount')}}">
                    @error('discount')
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
