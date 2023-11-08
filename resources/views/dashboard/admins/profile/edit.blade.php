@extends('dashboard.layouts.master')
@section('title',__('dashboard/navbar.profile'))
@section('content')
<div class="content-wrapper">
    <div id="logins-part" class="content p-3" role="tabpanel" aria-labelledby="logins-part-trigger">
        <h3>{{__('dashboard/navbar.profile_information')}}</h3>
        <form action="{{ route('admin.profile.updatePersonalData',$admin->id) }}" method="post" enctype="multipart/form-data">
            @csrf
            <div class="col-4 offset-4">
                @if (empty($admin->image))
                    <img src="{{ asset('storage/avatars/default.png') }}" alt="User Image" id="image" width="50%" class=" rounded-circle" style="cursor: pointer;">
                @else
                    <img src="{{ asset('storage/avatars/'.$admin->image) }}" alt="User Image" id="image" width="50%" class="rounded-circle" style="cursor: pointer;">
                @endif
                <input type="file" name="image" id="file" class="d-none">
            </div>
            <div class="form-group">
                <label for="name">{{__('dashboard/navbar.name')}}</label>
                <input type="text" class="form-control" value="{{ $admin->name }}" name="name" id="name" placeholder="Name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">{{__('dashboard/navbar.email')}}</label>
                <input type="email" class="form-control" value="{{ $admin->email }}" name="email" id="exampleInputEmail1" placeholder="Enter email">
            </div>
            <button class="btn btn-dark">{{__('dashboard/navbar.save')}}</button>
        </form>
    </div>

    <div id="logins-part" class="content p-3" role="tabpanel" aria-labelledby="logins-part-trigger">
        <h3>{{__('dashboard/navbar.update_password')}}</h3>
        <form action="{{ route('admin.profile.updatePassword',$admin->id) }}" method="post">
            @csrf
            <div class="form-group">
                <label for="name">{{__('dashboard/navbar.current')}}</label>
                <input type="password" class="form-control  @error('current_password') is-invalid @enderror" name="current_password">
                @error('current_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">{{__('dashboard/navbar.new')}}</label>
                <input type="password" class="form-control  @error('new_password') is-invalid @enderror" name="new_password">
                @error('new_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
            <div class="form-group">
                <label for="name">{{__('dashboard/navbar.confirm')}}</label>
                <input type="password" class="form-control  @error('confirm_password') is-invalid @enderror" name="confirm_password">
                @error('confirm_password')
                    <small class="text-danger">{{ $message }}</small>
                @enderror
            </div>
           
            <button class="btn btn-dark">{{__('dashboard/navbar.save')}}</button>
        </form>
    </div>
</div>

@endsection
@section('js')
    <script src="{{ asset('assets/plugins/jquery-1.12.0.min.js') }}"></script>
    <script>
        $('#image').on('click', function() {
            $('#file').click();
        });
    </script>
@endsection
