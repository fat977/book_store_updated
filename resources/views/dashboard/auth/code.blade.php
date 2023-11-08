@extends('dashboard.layouts.auth')
@section('title','Code')
@section('form')
<div class="login-box">
    <!-- /.login-logo -->
    <div class="card card-outline card-primary">
        <div class="card-header text-center">
            <p class="h1"><b>Admin</b>LTE</p>
        </div>
        <div class="card-body">
            <p class="login-box-msg">Enter the code.</p>
            
            <form action="{{ route('admin.checkCode') }}" method="post">
                @csrf
                <div class="input-group mb-3">
                    <input type="text" class="form-control @error('code') is-invalid @enderror" name="code" placeholder="Code">
                    <div class="input-group-append">
                        
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <button type="submit" class="btn btn-primary btn-block">Request new password</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>
            <p class="mt-3 mb-1">
                <a href="login.html">Login</a>
            </p>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
</div>
<!-- /.login-box -->
@endsection
