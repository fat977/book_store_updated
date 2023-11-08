<h3>{{ __('website/navbar.update_information') }}</h3>
<form action="{{ route('profile.update')}}" method="post">
    @method('patch')
    @csrf
    <div class="form-group">
        <label for="name">{{ __('website/navbar.name') }}</label>
        <input id="name" type="text" value="{{ Auth::user()->name }}" name="name" class="form-control">
        @error('name')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="email">{{ __('website/navbar.email') }}</label>
        <input id="email" type="email" value="{{ Auth::user()->email }}" name="email" class="form-control">
        @error('email')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="form-group">
        <label for="phone">{{ __('website/navbar.mobile') }}</label>
        <input id="phone" type="number" value="{{ Auth::user()->phone }}" name="phone" class="form-control">
        @error('phone')
        <p class="text-danger">{{ $message }}</p>
        @enderror
    </div>
    <div class="text-center">
        <button type="submit" class="btn btn-primary">{{ __('website/navbar.update') }}</button>
    </div>
</form>