@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.purchased.offer.offers'))
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
                        <th>{{__('dashboard/sidebar.commons.title')}}</th>
                        <th>{{__('dashboard/sidebar.purchased.offer.discount')}}</th>
                        <th>{{__('dashboard/sidebar.purchased.offer.start_at')}}</th>
                        <th>{{__('dashboard/sidebar.purchased.offer.end_at')}}</th>
                        <th>{{__('dashboard/sidebar.commons.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($offers as $offer)
                    <tr>
                        <td>{{$offer->id}}</td>
                        <td>{{$offer->title}}</td>
                        <td>{{$offer->discount}}</td>
                        <td>{{$offer->start_at}}</td>
                        <td>{{$offer->end_at}}</td>
                        <td>
                            <a href="{{route('admin.offers.edit',$offer->id)}}" class="btn btn-warning">{{__('dashboard/sidebar.commons.edit')}}</a>
                             <button type="button" class="btn btn-danger" data-toggle="modal"
                                data-target="#confirm-delete-{{ $offer->id }}">
                                {{__('dashboard/sidebar.commons.delete')}}
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $offer->id }}">
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
                                            <form action="{{ route('admin.offers.destroy', $offer->id) }}" method="POST">
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
