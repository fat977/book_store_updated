@extends('dashboard.layouts.master')

@section('title', __('dashboard/sidebar.purchased.purchased_books'))

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
                        <th>{{__('dashboard/sidebar.purchased.category')}}</th>
                        <th>{{__('dashboard/sidebar.purchased.author')}}</th>
                        <th>{{__('dashboard/sidebar.purchased.price')}}</th>
                        <th>{{__('dashboard/sidebar.purchased.quantity')}}</th>
                        <th>{{__('dashboard/sidebar.commons.status')}}</th>
                        <th>{{__('dashboard/sidebar.commons.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($purchasedBooks as $purchasedBook)
                    <tr>
                        <td>{{$purchasedBook->id}}</td>
                        <td>{{$purchasedBook->name}}</td>
                        <td>{{$purchasedBook->category->name}}</td>
                        <td>{{$purchasedBook->author->name}}</td>
                        <td>{{$purchasedBook->price}}</td>
                        <td>{{$purchasedBook->quantity}}</td>
                        <td> <span class="badge badge-{{$purchasedBook->status == 0 ? 'danger' : 'success'}} text-center">{{$purchasedBook->status == 0 ? __('dashboard/sidebar.commons.not_active') : __('dashboard/sidebar.commons.active')}}</span></td> 
                        <td>
                            <a href="{{route('admin.purchased_books.show',$purchasedBook->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
                            <a href="{{route('admin.purchased_books.edit',$purchasedBook->id)}}" class="btn btn-warning"><i class="fa-solid fa-pen-to-square"></i></a>
                            <a href="{{route('admin.offer.create',$purchasedBook->id)}}" title="add offers to purchasedBook" class="btn btn-primary"><i class="fa-solid fa-square-plus"></i></a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-{{ $purchasedBook->id }}">
                                <i class="fa-solid fa-trash"></i>
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $purchasedBook->id }}">
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
                                            <form action="{{ route('admin.purchased_books.destroy', $purchasedBook->id) }}" method="POST">
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
