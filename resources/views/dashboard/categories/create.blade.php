@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.category.add'))

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.categories.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="name_en">{{__('dashboard/sidebar.commons.name_en')}}</label>
                        <input type="text" name="name_en" id="name_en" class="form-control" value="{{old('name_en')}}">
                        @error('name_en')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                    <div class="col-6">
                        <label for="name_ar">{{__('dashboard/sidebar.commons.name_ar')}}</label>
                        <input type="text" name="name_ar" id="name_ar" class="form-control" value="{{old('name_ar')}}">
                        @error('name_ar')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="Status">{{__('dashboard/sidebar.commons.status')}}</label>
                        <select name="status" id="Status" class="form-control">
                            <option {{old('status') == 1 ? 'selected':''}} value="1">{{__('dashboard/sidebar.commons.active')}}</option>
                            <option {{old('status') == 0 ? 'selected':''}} value="0">{{__('dashboard/sidebar.commons.not_active')}}</option>
                        </select>
                        @error('status')
                            <p class="text-danger">{{ $message }}</p>
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
