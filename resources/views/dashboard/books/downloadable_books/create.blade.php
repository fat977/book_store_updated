@extends('dashboard.layouts.master')
@section('title', __('dashboard/sidebar.downloadable.add'))
@section('css')
<!-- ckeditor -->
@include('dashboard.includes.ckeditor.css')
@endsection
@section('content')
<div class="content-wrapper p-4">
    <div class="row">
        <div class="col-12">
            <form action="{{ route('admin.downloadable_books.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">{{__('dashboard/sidebar.commons.name_en')}}</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('name_en')}}">
                        @error('name_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">{{__('dashboard/sidebar.commons.name_ar')}}</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('name_ar')}}">
                        @error('name_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="file">{{__('dashboard/sidebar.downloadable.file')}}</label>
                        <input type="file" name="file" id="file" class="form-control" placeholder="">
                        @error('file')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="size">{{__('dashboard/sidebar.downloadable.size')}} </label>
                        <input type="text" name="size" id="size" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('size')}}">
                        @error('size')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="no_pages">{{__('dashboard/sidebar.downloadable.no_pages')}}</label>
                        <input type="number" name="no_pages" class="form-control"
                        value="{{ old('no_pages') }}">                    
                        @error('no_pages')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                   
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="Status">{{__('dashboard/sidebar.commons.status')}}</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{old('status') == 1 ? 'selected':''}} value="1">{{__('dashboard/sidebar.commons.active')}}</option>
                            <option {{old('status') == 0 ? 'selected':''}} value="0">{{__('dashboard/sidebar.commons.no_active')}}</option>
                        </select>
                        @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="author_id">{{__('dashboard/sidebar.downloadable.author')}}</label>
                        <select name="author_id" id="author_id" class="form-control">
                            @foreach ($authors as $author)
                            <option {{ old('author_id')== $author->id ? 'selected' : '' }} value="{{ $author->id }}">{{ $author->name }}</option>
                            @endforeach
                        </select>
                        @error('author_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="category_id">{{__('dashboard/sidebar.downloadable.category')}}</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $category)
                            <option {{ old('category_id') == $category->id ? 'selected' : ''}} value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="desc_en">{{__('dashboard/sidebar.downloadable.desc_en')}}</label>
                        <textarea name="desc_en" id="desc_en" class="form-control ckeditor">{{ old('desc_en') }}</textarea>
                        @error('desc_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="desc_ar">{{__('dashboard/sidebar.downloadable.desc_ar')}}</label>
                        <textarea name="desc_ar" id="desc_ar" class="form-control ckeditor">{{ old('desc_ar') }}</textarea>
                        @error('desc_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="desc_ar">{{__('dashboard/sidebar.downloadable.publisher_en')}}</label>
                        <input type="text" name="publisher_en" id="publisher_en" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('publisher_en')}}">
                        @error('publiser_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="desc_ar">{{__('dashboard/sidebar.downloadable.publisher_ar')}}</label>
                        <input type="text" name="publisher_ar" id="publisher_ar" class="form-control" placeholder="" aria-describedby="helpId" value="{{old('publisher_ar')}}">
                        @error('publisher_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="image">{{__('dashboard/sidebar.commons.image')}}</label>
                        <input type="file" name="image" id="image" class="form-control">
                        @error('image')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="released_date">{{__('dashboard/sidebar.downloadable.released')}}</label>
                        <input type="datetime-local" name="released_date" class="form-control"
                        value="{{ old('released_date') }}">                    
                        @error('released_date')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
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
@section('js')
<!-- ckeditor  & Plugins -->
@include('dashboard.includes.ckeditor.js')
@endsection
