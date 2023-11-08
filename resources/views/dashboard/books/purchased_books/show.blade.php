@extends('dashboard.layouts.master')
@section('title', __('dashboard/sidebar.purchased.show'))
@section('content')
<div class="content-wrapper p-4">
    <div class="row">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">{{__('dashboard/sidebar.purchased.details')}}</h3>
                </thead>
                <tbody>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.id')}}</th>
                        <td>{{ $purchasedBook->id }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.name')}}</th>
                        <td>{{ $purchasedBook->name }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.purchased.category')}}</th>
                        <td>{{ $purchasedBook->category->name }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.purchased.author')}}</th>
                        <td>{{ $purchasedBook->author->name }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.purchased.released')}}</th>
                        <td>{{$purchasedBook->released_date}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.purchased.publisher')}}</th>
                        <td>{{$purchasedBook->publisher}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.purchased.price')}}</th>
                        <td>{{$purchasedBook->price}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.purchased.quantity')}}</th>
                        <td>{{$purchasedBook->quantity}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.status')}}</th>
                        <td> <span class="badge badge-{{$purchasedBook->status == 0 ? 'danger' : 'success'}} text-center">{{$purchasedBook->status == 0 ? __('dashboard/sidebar.commons.not_active') : __('dashboard/sidebar.commons.active')}}</span></td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.created')}}</th>
                        <td>{{$purchasedBook->created_at}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.image')}}</th>
                        <td><img src="{{ asset('storage/purchasedBooks/' . $purchasedBook->image) }}" alt="{{ $purchasedBook->name }}" style="width: 40%"></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
    <div class="row">

        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">{{__('dashboard/sidebar.purchased.book_offer')}}</h3>
                </thead>
                <tbody>
                    @forelse ($purchasedBook->offers as $offer)
                    <tr>
                        <th>{{ $offer->title}}</th>
                        <td><b>Discount: </b>{{$offer->discount}}</td>
                        <td><b>Purchased Book price: </b>{{$offer->pivot->price}}</td>
                        <td>
                            <a href="{{route('admin.offer.edit',[$offer->pivot->purchased_book_id,$offer->pivot->offer_id])}}" class="btn btn-warning">{{__('dashboard/sidebar.commons.edit')}}</a>
                            <button type="button" class="btn btn-danger" data-toggle="modal" data-target="#confirm-delete-{{ $offer->pivot->purchased_book_id }}">
                                {{__('dashboard/sidebar.commons.delete')}}
                            </button>
                            <div class="modal fade" id="confirm-delete-{{ $offer->pivot->purchased_book_id }}">
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
                                            <form action="{{ route('admin.offer.delete',[$offer->pivot->purchased_book_id,$offer->pivot->offer_id]) }}" method="POST">
                                                @csrf
                                                <button type="submit" class="btn btn-dark btn-md">{{__('dashboard/sidebar.commons.yes')}}</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </td>
                    </tr>
                    @empty
                    <p class="text-center">{{__('dashboard/sidebar.purchased.no_offers')}}</p>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
