@extends('dashboard.layouts.master')
@section('title',__('dashboard/sidebar.order.show'))
@section('content')
<div class="content-wrapper">
    <div class="row p-4">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">{{__('dashboard/sidebar.order.book_details')}}</h3>
                    <tr>
                        <th colspan="2">{{__('dashboard/sidebar.order.book')}}</th>
                        <th>{{__('dashboard/sidebar.order.price')}}</th>
                        <th>{{__('dashboard/sidebar.order.quantity')}}</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->books as $book)
                        <tr>
                            <td><img src="{{ asset('storage/purchasedBooks/'.$book->image) }}" style="height: 100px; width:100px" alt="{{ $book->name }}"></td>
                            <td>{{ $book->name }}</td>
                            <td>{{ $book->pivot->price }}</td>
                            <td>{{ $book->pivot->quantity }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row p-4">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">{{__('dashboard/sidebar.order.order_details')}}</h3>
                </thead>
                <tbody>
                    <tr>
                        <th>{{__('dashboard/sidebar.order.order_date')}}</th>
                        <td>{{ date('d-m-Y',strtotime($order->created_at)) }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.order.delivered_date')}}</th>
                        <td>{{ date('d-m-Y',strtotime($order->delivered_at)) }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.order.payment')}}</th>
                        <td>{{ $order->payment_method }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.order.total_price')}}</th>
                        <td>{{ $order->total_price }}</td>
                    </tr>   
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.status')}}</th>
                        <td>
                            <form action="{{ route('admin.orders.update',$order->id) }}" method="POST">
                                @csrf
                                <select class="form-control" name="status">
                                    <option {{ $order->status == '0'?'selected':''}} value="0">{{__('dashboard/sidebar.order.not_delivered')}}</option>
                                    <option {{ $order->status == '1'?'selected':''}} value="1">{{__('dashboard/sidebar.order.delivered')}}</option>
                                </select>
                                <button type="submit" class="btn btn-primary mt-4">{{__('dashboard/sidebar.commons.update')}}</button>
                            </form>
                        </td>
                    </tr>   
                </tbody>
            </table>
        </div>
    </div>
    <div class="row p-4">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">{{__('dashboard/sidebar.order.user_details')}}</h3>
                </thead>
                <tbody>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.name')}}</th>
                        <td>{{ $order->address->user->name }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.email')}}</th>
                        <td>{{ $order->address->user->email }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.address.city')}}</th>
                        <td>{{ $order->address->region->city->name }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.address.region')}}</th>
                        <td>{{ $order->address->region->name }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.address.street')}}</th>
                        <td>{{ $order->address->street }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.address.building')}}</th>
                        <td>{{ $order->address->building }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.address.floor')}}</th>
                        <td>{{ $order->address->floor }}</td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection

