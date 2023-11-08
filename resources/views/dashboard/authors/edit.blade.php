@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.author.edit'))
@section('css')
<!-- ckeditor -->
@include('dashboard.includes.ckeditor.css')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.authors.update', $author->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        @php $author_name = implode($author->getTranslations('name',['en'])); @endphp
                        <label for="name_en">{{__('dashboard/sidebar.commons.name_en')}}</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $author_name }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        @php $author_name = implode($author->getTranslations('name',['ar'])); @endphp
                        <label for="name_ar">{{__('dashboard/sidebar.commons.name_ar')}}</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $author_name }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        @php $author_bio = implode($author->getTranslations('bio',['en'])); @endphp
                        <label for="bio_en">{{__('dashboard/sidebar.author.bio_en')}}</label>
                        <textarea name="bio_en" id="bio_en" class="form-control ckeditor">{!! $author_bio !!}</textarea>
                    </div>
                    <div class="col-6">
                        @php $author_bio = implode($author->getTranslations('bio',['ar'])); @endphp
                        <label for="bio_en">{{__('dashboard/sidebar.author.bio_ar')}}</label>
                        <textarea name="bio_ar" id="bio_ar" class="form-control ckeditor">{!! $author_bio !!}</textarea>
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="image">{{__('dashboard/sidebar.commons.image')}}</label>
                        <input type="file" name="image" id="image" class="form-control">
                        <img src="{{ asset('storage/authors/' . $author->image) }}" alt="{{ $author->name }}">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="Status">{{__('dashboard/sidebar.commons.status')}}</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $author->status == 1 ? 'selected' : '' }} value="1">{{__('dashboard/sidebar.commons.active')}}</option>
                            <option {{ $author->status == 0 ? 'selected' : '' }} value="0">{{__('dashboard/sidebar.commons.not_active')}}</option>
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
@section('js')
<!-- ckeditor  & Plugins -->
@include('dashboard.includes.ckeditor.js')
@endsection
