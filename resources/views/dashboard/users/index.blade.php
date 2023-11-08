@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.user.users'))
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
                        <th>{{__('dashboard/sidebar.commons.email')}}</th>
                        <th>{{__('dashboard/sidebar.commons.status')}}</th>
                        <th>{{__('dashboard/sidebar.commons.created')}}</th>
                        <th>{{__('dashboard/sidebar.commons.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($users as $user)
                    <tr>
                        <td>{{$user->id}}</td>
                        <td>{{$user->name}}</td>
                        <td>{{$user->email}}</td>
                        <td> <span class="badge badge-{{$user->is_banned == 1 ? 'danger' : 'success'}} text-center">{{$user->is_banned == 1 ? __('dashboard/sidebar.commons.banned') : __('dashboard/sidebar.commons.active') }}</span></td>
                        <td>{{$user->created_at}}</td>
                        <td>
                            @if (!request()->has('trashed'))
                                <a href="{{route('admin.users.edit',$user->id)}}" class="btn btn-warning">{{__('dashboard/sidebar.commons.edit')}}</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#confirm-delete-{{ $user->id }}">
                                    {{__('dashboard/sidebar.commons.delete')}}
                                </button>
                                <div class="modal fade" id="confirm-delete-{{ $user->id }}">
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
                                                <form action="{{ route('admin.users.destroy', $user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">{{__('dashboard/sidebar.commons.yes')}}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @else
                                <a href="{{route('admin.users.restore',$user->id)}}" class="btn btn-primary">{{__('dashboard/sidebar.commons.restore')}}</a>
                                <button type="button" class="btn btn-danger" data-toggle="modal"
                                    data-target="#confirm-delete-permanently{{ $user->id }}">
                                    {{__('dashboard/sidebar.commons.delete')}}
                                </button>
                                <div class="modal fade" id="confirm-delete-permanently{{ $user->id }}">
                                    <div class="modal-dialog">
                                        <div class="modal-content">
                                            <div class="modal-header">
                                                <p class="modal-title">{{__('dashboard/sidebar.commons.confirm_delete')}}</p>
                                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                                    <span aria-hidden="true">&times;</span>
                                                </button>
                                            </div>
                                            <div class="modal-body text-left">
                                                <p>{{__('dashboard/sidebar.commons.sure_delete_permanently')}}</p>
                                            </div>
                                            <div class="modal-footer justify-content-between">
                                                <button type="button" class="btn btn-default btn-md" data-dismiss="modal">{{__('dashboard/sidebar.commons.close')}}</button>
                                                <form action="{{ route('admin.user.deletePermanently',$user->id) }}" method="POST">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" class="btn btn-dark btn-md">{{__('dashboard/sidebar.commons.yes')}}</button>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            @endif
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
