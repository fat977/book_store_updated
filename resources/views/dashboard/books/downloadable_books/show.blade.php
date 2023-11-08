@extends('dashboard.layouts.master')
@section('title', __('dashboard/sidebar.downloadable.show'))
@section('content')
<div class="content-wrapper p-4">
    <div class="row">
        <div class="col-12">
            <table id="example1" class="table table-bordered table-striped">
                <thead>
                    <h3 class="text-center">{{__('dashboard/sidebar.downloadable.details')}}</h3>
                </thead>
                <tbody>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.id')}}</th>
                        <td>{{ $downloadableBook->id }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.name')}}</th>
                        <td>{{ $downloadableBook->name }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.downloadable.category')}}</th>
                        <td>{{ $downloadableBook->category->name }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.downloadable.author')}}</th>
                        <td>{{ $downloadableBook->author->name }}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.downloadable.size')}}</th>
                        <td>{{$downloadableBook->size}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.downloadable.file')}}</th>
                        <td>{{$downloadableBook->file}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.downloadable.released')}}</th>
                        <td>{{$downloadableBook->released_date}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.downloadable.publisher')}}</th>
                        <td>{{$downloadableBook->publisher}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.status')}}</th>
                        <td> <span class="badge badge-{{$downloadableBook->status == 0 ? 'danger' : 'success'}} text-center">{{$downloadableBook->status == 0 ? __('dashboard/sidebar.commons.not_active') : __('dashboard/sidebar.commons.active') }}</span></td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.created')}}</th>
                        <td>{{$downloadableBook->created_at}}</td>
                    </tr>
                    <tr>
                        <th>{{__('dashboard/sidebar.commons.image')}}</th>
                        <td><img src="{{ asset('storage/downloadedBook/images/' . $downloadableBook->image) }}" alt="{{ $downloadableBook->name }}" style="width: 40%"></td>
                    </tr>

                </tbody>
            </table>
        </div>
    </div>
</div>
@endsection
