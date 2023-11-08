@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.category.edit'))

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.categories.update', $category->id) }}" method="post">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">{{__('dashboard/sidebar.commons.name_en')}}</label>
                        @php $name = implode($category->getTranslations('name',['en'])); @endphp
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $name }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">{{__('dashboard/sidebar.commons.name_ar')}}</label>
                        @php $name = implode($category->getTranslations('name',['ar'])); @endphp
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $name }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="Status">{{__('dashboard/sidebar.commons.status')}}</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $category->status == 1 ? 'selected' : '' }} value="1">{{__('dashboard/sidebar.commons.active')}}</option>
                            <option {{ $category->status == 0 ? 'selected' : '' }} value="0">{{__('dashboard/sidebar.commons.not_active')}}</option>
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
