<h3>{{ __('website/navbar.update_password') }}</h3>
<form method="post" action="{{ route('password.update') }}" class="mt-6 space-y-6">
    @csrf
    @method('put')
    <div class="form-group">
        <label for="current_password">{{ __('website/navbar.current') }}</label>
        <input id="current_password" type="password" name="current_password" class="form-control">
        @error('current_password')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="password">{{ __('website/navbar.new') }}</label>
        <input id="password" type="password"  name="password" class="form-control">
        @error('password')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="password_confirmation">{{ __('website/navbar.confirm') }}</label>
        <input id="password_confirmation" type="password"  name="password_confirmation" class="form-control">
        @error('password_confirmation')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">{{ __('website/navbar.update') }}</button>
    </div>
</form>
