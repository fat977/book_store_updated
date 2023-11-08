@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.admin.admins'))
@section('css')
<!-- DataTables -->
@include('dashboard.includes.data_tables.css')
@endsection
@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.id')}}</th>
                        <th>{{__('dashboard/sidebar.commons.name')}}</th>
                        <th>{{__('dashboard/sidebar.commons.status')}}</th>
                        <th>{{__('dashboard/sidebar.commons.type')}}</th>
                        <th>{{__('dashboard/sidebar.commons.created')}}</th>
                        <th>{{__('dashboard/sidebar.commons.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($admins as $admin)
                    <tr>
                        <td>{{$admin->id}}</td>
                        <td>{{$admin->name}}</td>
                        <td> <span class="badge badge-{{$admin->status == 0 ? 'danger' : 'success'}} text-center">{{$admin->status == 0 ? __('dashboard/sidebar.commons.not_active') : __('dashboard/sidebar.commons.active') }}</span></td>
                        <td>{{ $admin->type }}</td>
                        <td>{{$admin->created_at}}</td>
                        <td>
                            <a href="{{route('admin.admins.edit',$admin->id)}}" class="btn btn-warning">{{__('dashboard/sidebar.commons.edit')}}</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-delete-{{ $admin->id }}">
                                {{__('dashboard/sidebar.commons.delete')}}
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $admin->id }}">
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
                                            <form action="{{ route('admin.admins.destroy', $admin->id) }}" method="POST">
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
