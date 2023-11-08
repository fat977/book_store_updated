@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.order.orders'))
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
                        <th>{{__('dashboard/sidebar.order.order_date')}}</th>
                        <th>{{__('dashboard/sidebar.order.delivered_date')}}</th>
                        <th>{{__('dashboard/sidebar.order.total_price')}}</th>
                        <th>{{__('dashboard/sidebar.commons.status')}}</th>
                        <th>{{__('dashboard/sidebar.commons.actions')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($orders as $order)
                        <tr>
                            <td>{{ date('d-m-Y',strtotime($order->created_at)) }}</td>
                            <td>{{ date('d-m-Y',strtotime($order->delivered_at)) }}</td>
                            <td>{{ $order->total_price }}</td>
                            <td> <span class="badge badge-{{$order->status == 0 ? 'danger' : 'success'}} text-center">{{$order->status == 0 ? __('dashboard/sidebar.order.not_delivered') : __('dashboard/sidebar.order.delivered')}}</span></td>
                            <td>
                                <a href="{{route('admin.orders.view',$order->id)}}" class="btn btn-success"><i class="fa fa-eye"></i></a>
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
