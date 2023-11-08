@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.banner.edit'))

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.banners.update', $banner->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
            
                <div class="form-row">
                    <div class="col-12">
                        <label for="image">{{__('dashboard/sidebar.commons.image')}}</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4 mt-3">
                        <img src="{{ asset('storage/banners/' . $banner->image) }}" alt="{{ $banner->alt }}"
                            class="w-100">
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label>{{__('dashboard/sidebar.commons.title_en')}}</label>
                        @php $title_en = implode($banner->getTranslations('title',['en'])); @endphp
                        <input type="text" name="title_en" id="title_en" class="form-control" value="{{ $title_en }}">
                        @error('title_en')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label>{{__('dashboard/sidebar.commons.title_ar')}}</label>
                        @php $title_ar = implode($banner->getTranslations('title',['ar'])); @endphp
                        <input type="text" name="title_ar" id="title_ar" class="form-control" value="{{ $title_ar }}">
                        @error('title_ar')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-12">
                        <label for="Status">{{__('dashboard/sidebar.commons.status')}}</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $banner->status == 1 ? 'selected' : '' }} value="1">{{__('dashboard/sidebar.commons.active')}}</option>
                            <option {{ $banner->status == 0 ? 'selected' : '' }} value="0">{{__('dashboard/sidebar.commons.not_active')}}</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
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
