@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.admin.add'))

@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.admins.store') }}" method="POST">
                @csrf
                <div class="form-row">
                    <div class="col-6">
                        <label for="name">{{__('dashboard/sidebar.commons.name')}}</label>
                        <input type="text" name="name" id="name" class="form-control" value="{{old('name')}}">
                        @error('name')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="email">{{__('dashboard/sidebar.commons.email')}}</label>
                        <input type="text" name="email" id="email" class="form-control" value="{{old('email')}}">
                        @error('email')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="password">{{__('dashboard/sidebar.commons.password')}}</label>
                        <input type="password" name="password" id="password" class="form-control" value="{{old('password')}}">
                        @error('password')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="password">{{__('dashboard/sidebar.commons.confirm_password')}}</label>
                        <input type="password" name="password_confirmation" id="password" class="form-control" value="{{old('password')}}">
                        @error('password_confirmation')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="type">{{__('dashboard/sidebar.commons.type')}}</label>
                        <select name="type" id="type" class="form-control">
                            <option {{old('type') == 'admin' ? 'selected':''}} value="admin">{{__('dashboard/sidebar.commons.admin')}}</option>
                            <option {{old('type') == 'super admin' ? 'selected':''}} value="super admin">{{__('dashboard/sidebar.commons.super_admin')}}</option>
                        </select>
                        @error('type')
                            <p class="text-danger">{{ $message }}</p>
                        @enderror
                    </div>
                </div>
                <div class="form-row my-3">
                    <div class="col-2">
                        <button class="btn btn-primary w-100" name="page" value="index"> {{__('dashboard/sidebar.commons.create')}} </button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
@endsection
