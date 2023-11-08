@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.address.cities'))
@section('css')
<!-- DataTables -->
@include('dashboard.includes.data_tables.css')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <a href="{{ route('admin.cities.create') }}" class="btn btn-dark">{{__('dashboard/sidebar.address.add_city')}}</a>
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.id')}}</th>
                        <th>{{__('dashboard/sidebar.commons.name')}}</th>
                        <th>{{__('dashboard/sidebar.commons.status')}}</th>
                        <th>{{__('dashboard/sidebar.address.shipping')}}</th>
                        <th>{{__('dashboard/sidebar.commons.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($cities as $city)
                    <tr>
                        <td>{{$city->id}}</td>
                        <td>{{$city->name}}</td>
                        <td> <span class="badge badge-{{$city->status == 0 ? 'danger' : 'success'}} text-center">{{$city->status == 0 ? __('dashboard/sidebar.commons.not_active') : __('dashboard/sidebar.commons.active')}}</span></td>
                        <td>{{$city->shipping}}</td>
                        <td>
                            <a href="{{route('admin.cities.edit',$city->id)}}" class="btn btn-warning">{{__('dashboard/sidebar.commons.edit')}}</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-delete-{{ $city->id }}">
                                {{__('dashboard/sidebar.commons.delete')}}
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $city->id }}">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <p class="modal-title">{{__('dashboard/sidebar.commons.confirm_delete')}}</p>
                                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                <span aria-hidden="true">&times;</span>
                                            </button>
                                        </div>
                                        <div class="modal-body text-left">
                                            <p>{{__('dashboard/sidebar.commons.sure_delete')}}</p>
                                        </div>
                                        <div class="modal-footer justify-content-between">
                                            <button type="button" class="btn btn-default btn-md" data-dismiss="modal">{{__('dashboard/sidebar.commons.close')}}</button>
                                            <form action="{{ route('admin.cities.destroy', $city->id) }}" method="POST">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-dark btn-md">{{__('dashboard/sidebar.commons.yes')}}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
@section('js')
<!-- DataTables  & Plugins -->
@include('dashboard.includes.data_tables.js')
@endsection
