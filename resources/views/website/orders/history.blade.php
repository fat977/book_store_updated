@extends('website.layouts.master')
@section('title','Orders History')
@section('content')
<!-- Page Header Start -->
<div class="container-fluid bg-secondary mb-5">
    <div class="d-flex flex-column align-items-center justify-content-center" style="min-height: 300px">
        <h1 class="font-weight-semi-bold text-uppercase mb-3">@yield('title')</h1>
        <div class="d-inline-flex">
            <p class="m-0"><a href="">Home</a></p>
            <p class="m-0 px-2">-</p>
            <p class="m-0">@yield('title')</p>
        </div>
    </div>
</div>

<div id="customer-orders" class="container-fluid col-lg-9">
    <div class="box">
        <h1>My orders</h1>
        <p class="lead">Your orders on one place.</p>
        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
        <hr>
        <div class="table-responsive">
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th>Date</th>
                        <th>Delivered at</th>
                        <th>Total</th>
                        <th>Status</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($orders as $order)
                    <tr>
                        <th>{{ date('d-m-Y',strtotime($order->created_at)) }}</th>
                        <td>{{ date('d-m-Y',strtotime($order->delivered_at)) }}</td>
                        <td>$ {{ $order->total_price }}</td>
                        <td><span class="badge badge-{{$order->status == 0 ? 'warning' : 'success'}} text-center">{{$order->status == 0 ? 'On Hold' : 'Delivered'}}</span></td>
                        <td><a href="{{ route('order.details',$order->id) }}" class="btn btn-primary btn-sm">View</a></td>
                    </tr>
                    @empty
                        <div class="text-danger"> No items !</div>
                    @endforelse
                    
                </tbody>
            </table>
        </div>
    </div>
</div>
<?php Session::forget('payment'); ?>
@endsection
