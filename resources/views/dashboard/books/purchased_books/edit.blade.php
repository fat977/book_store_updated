@extends('dashboard.layouts.master')
@section('title', __('dashboard/sidebar.purchased.edit'))
@section('css')
<!-- ckeditor -->
@include('dashboard.includes.ckeditor.css')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
        </div>
        <div class="col-12">
            <form action="{{ route('admin.purchased_books.update', $purchasedBook->id) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">{{__('dashboard/sidebar.commons.name_en')}}</label>
                        @php $name = implode($purchasedBook->getTranslations('name',['en'])); @endphp
                        <input type="text" name="name_en" id="name_en" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $name }}">
                        @error('name_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">{{__('dashboard/sidebar.commons.name_ar')}}</label>
                        @php $name = implode($purchasedBook->getTranslations('name',['ar'])); @endphp
                        <input type="text" name="name_ar" id="name_ar" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $name }}">
                        @error('name_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="Price">{{__('dashboard/sidebar.purchased.price')}}</label>
                        <input type="number" name="price" id="price" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $purchasedBook->price }}">
                        @error('price')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    
                    <div class="col-4">
                        <label for="Quantity">{{__('dashboard/sidebar.purchased.quantity')}}</label>
                        <input type="number" name="quantity" id="Quantity" class="form-control" placeholder=""
                            aria-describedby="helpId" value="{{ $purchasedBook->quantity }}">
                        @error('quantity')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-4">
                        <label for="Status">{{__('dashboard/sidebar.commons.status')}}</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{ $purchasedBook->status == 1 ? 'selected' : '' }} value="1">{{__('dashboard/sidebar.commons.active')}}</option>
                            <option {{ $purchasedBook->status == 0 ? 'selected' : '' }} value="0">{{__('dashboard/sidebar.commons.not_active')}}</option>
                        </select>
                        @error('status')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="author_id">{{__('dashboard/sidebar.purchased.author')}}</label>
                        <select name="author_id" id="author_id" class="form-control">
                            @foreach ($authors as $author)
                                <option {{ $purchasedBook->author_id == $author->id ? 'selected' : '' }}
                                    value="{{ $author->id }}">
                                    {{ $author->name }}</option>
                            @endforeach
                        </select>
                        @error('author_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <label for="category_id">{{__('dashboard/sidebar.purchased.category')}}</label>
                        <select name="category_id" id="category_id" class="form-control">
                            @foreach ($categories as $category)
                                <option {{ $purchasedBook->category_id == $category->id ? 'selected' : '' }}
                                    value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                        @error('category_id')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="desc_en">{{__('dashboard/sidebar.purchased.desc_en')}}</label>
                        @php $desc = implode($purchasedBook->getTranslations('desc',['en'])); @endphp
                        <textarea name="desc_en" id="desc_en" class="form-control ckeditor">{!! $desc !!}</textarea>
                        @error('desc_en')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="desc_ar">{{__('dashboard/sidebar.purchased.desc_ar')}}</label>
                        @php $desc = implode($purchasedBook->getTranslations('desc',['ar'])); @endphp
                        <textarea name="desc_ar" id="desc_ar" class="form-control ckeditor">{!! $desc !!}</textarea>
                        @error('desc_ar')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="desc_ar">{{__('dashboard/sidebar.purchased.publisher_en')}}</label>
                        @php $publisher = implode($purchasedBook->getTranslations('publisher',['en'])); @endphp
                        <input type="text" name="publisher_en" id="publisher_en" class="form-control"  value="{{ $publisher }}">
                        @error('publisher_en')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="desc_ar">{{__('dashboard/sidebar.purchased.publisher_ar')}}</label>
                        @php $publisher = implode($purchasedBook->getTranslations('publisher',['ar'])); @endphp
                        <input type="text" name="publisher_ar" id="publisher_ar" class="form-control"  value="{{ $publisher }}">
                        @error('publisher_ar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="released_date">{{__('dashboard/sidebar.purchased.released')}}</label>
                        <input type="datetime-local" name="released_date" class="form-control"
                        value="{{ old('released_date',$purchasedBook->released_date) }}">                    
                    </div>
                    @error('released_date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <label for="image">{{__('dashboard/sidebar.commons.image')}}</label>
                        {{-- <input type="file" name="image" id="image" class="form-control"> --}}
                        <input type="file" name="image" id="file" class="d-none">
                        @error('image')
                            <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>
                    <div class="col-4">
                        <img src="{{ asset('storage/purchasedBooks/' . $purchasedBook->image) }}" alt="{{ $purchasedBook->name_en }}"
                            class="w-100" id="image" name="click" style="cursor: pointer;">
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-warning w-100" name="page" value="index"> {{__('dashboard/sidebar.commons.update')}} </button>
                    </div>
                    <div class="col-2">
                        <button class="btn btn-dark w-100 " name="page" value="back"> {{__('dashboard/sidebar.commons.return')}} </button>
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

    <script src="{{ asset('assets/plugins/jquery-1.12.0.min.js') }}"></script>
    <script>
        $('#image').on('click', function() {
            $('#file').click();
        });
    </script>
@endsection

