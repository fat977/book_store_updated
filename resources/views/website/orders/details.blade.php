@extends('website.layouts.master')
@section('title','Orders Details')
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
        <h1>Order #1735</h1>
        <p class="lead">Order #1735 was placed on <strong>{{ date('d/m/Y',strtotime($order->created_at)) }}</strong> and is currently <strong>Being prepared</strong>.</p>
        <p class="text-muted">If you have any questions, please feel free to <a href="contact.html">contact us</a>, our customer service center is working for you 24/7.</p>
        <hr>
        <div class="table-responsive mb-4">
            <table class="table">
                <thead>
                    <tr>
                        <th colspan="2">Book</th>
                        <th>Unit price</th>
                        <th>Quantity</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($order->books as $book)
                    <tr>
                        <td><img src="{{ asset('storage/purchasedBooks/'.$book->image) }}" style="height: 100px; width:100px" alt="{{ $book->name}}"></td>
                        <td>{{ $book->name }}</td>
                        <td>{{ $book->pivot->price }}</td>
                        <td>{{ $book->pivot->quantity }}</td>
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th colspan="5" class="text-right">Order subtotal</th>
                        <th>${{ $book->pivot->price * $book->pivot->quantity}}</th>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right">Shipping and handling</th>
                        <th>{{ $order->address->region->city->shipping }}</th>
                    </tr>
                    <tr>
                        <th colspan="5" class="text-right">Total</th>
                        <th>${{ ($book->pivot->price) + $order->address->region->city->shipping }}.00</th>
                    </tr>
                </tfoot>
            </table>
        </div>
        <!-- /.table-responsive-->
        <div class="row addresses">
            
            <div class="col-lg-12">
                <h2>Shipping address</h2>
                <p>{{ $order->address->user->name }}<br>City: {{ $order->address->region->city->name }}<br>Region: {{ $order->address->region->name }}<br>Street: {{ $order->address->street }}<br>Building: {{ $order->address->building }}<br>Floor: {{ $order->address->floor }}<br></p>
            </div>
            
        </div>
    </div>
</div>
@endsection
