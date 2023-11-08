@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.admin.edit'))
@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <form action="{{ route('admin.admins.update',$admin->id) }}" method="POST">
                @csrf
                @method('PUT')
                <div class="col-6">
                    <label for="Status">{{__('dashboard/sidebar.commons.status')}}</label>
                    <select name="status" id="Status" class="form-control">
                        <option {{ $admin->status == 1 ? 'selected' : '' }} value="1">{{__('dashboard/sidebar.commons.active')}}</option>
                        <option {{ $admin->status == 0 ? 'selected' : '' }} value="0">{{__('dashboard/sidebar.commons.not_active')}}</option>
                    </select>
                    @error('status')
                        <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-row">
                    <div class="col-6">
                        <label for="type">{{__('dashboard/sidebar.commons.type')}}</label>
                        <select name="type" id="type" class="form-control">
                            <option {{ $admin->type == 'admin' ? 'selected' : '' }} value="admin">{{__('dashboard/sidebar.commons.admin')}}</option>
                            <option {{ $admin->type == 'super admin' ? 'selected' : '' }} value="super admin">{{__('dashboard/sidebar.commons.super_admin')}}</option>
                        </select>
                        @error('type')
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
