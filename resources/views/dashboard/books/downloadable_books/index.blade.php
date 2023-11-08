@extends('dashboard.layouts.master')

@section('title', __('dashboard/sidebar.downloadable.downloadable_books'))

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
                        <th>{{__('dashboard/sidebar.downloadable.category')}}</th>
                        <th>{{__('dashboard/sidebar.downloadable.author')}}</th>
                        <th>{{__('dashboard/sidebar.commons.status')}}</th>
                        <th>{{__('dashboard/sidebar.commons.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($downloadableBooks as $downloadableBook)
                    <tr>
                        <td>{{$downloadableBook->id}}</td>
                        <td>{{$downloadableBook->name}}</td>
                        <td>{{$downloadableBook->category->name}}</td>
                        <td>{{$downloadableBook->author->name}}</td>
                        <td> <span class="badge badge-{{$downloadableBook->status == 0 ? 'danger' : 'success'}} text-center">{{$downloadableBook->status == 0 ? __('dashboard/sidebar.commons.not_active') : __('dashboard/sidebar.commons.active') }}</span></td> 
                        <td>
                            <a href="{{route('admin.downloadable_books.show',$downloadableBook->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.downloadable_books.edit',$downloadableBook->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                           <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-{{ $downloadableBook->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $downloadableBook->id }}">
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
                                            <form action="{{ route('admin.downloadable_books.destroy', $downloadableBook->id) }}" method="POST">
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
