<div class="row">
    <div class="col-lg-12">
        <h1>{{ __('website/navbar.address_information') }}</h1>
        <hr>
        <form action="{{ route('profile.updateAddress') }}" method="post">
            
            @csrf
            <input type="hidden" name="user_id" value="{{ Auth::user()->id }}">
            <div class="form-row">
                <label for="city">{{ __('website/navbar.city') }}</label>
                <select name="city_id" id="city_id" class="form-control">
                    @foreach ($regions as $region)
                        <option
                        @if (!empty($user->addresses[0]->region->city->id)) {{ $user->addresses[0]->region->city->id == $region->city_id ? 'selected' : '' }} @endif value="{{ $region->city_id }}">
                            {{ $region->city->name }}</option>
                    @endforeach
                   
                </select>
                @error('city_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-group">
                <label for="region">{{ __('website/navbar.region') }}</label>
                <select name="region_id" id="region_id" class="form-control">
                    @foreach ($regions as $region)
                       
                        <option  @if (!empty($user->addresses[0]->region_id)) {{ $user->addresses[0]->region_id == $region->id ? 'selected' : '' }}  @endif value="{{ $region->id }}">
                            {{ $region->name }}</option>
                       
                   
                    @endforeach
                </select>
                @error('region_id')
                <p class="text-danger">{{ $message }}</p>
                @enderror
            </div>
            <div class="form-row">
                <div class="col-4">
                    <label for="name">{{ __('website/navbar.street') }}</label>
                    <input id="name" type="text" name="street" class="form-control"
                        @if (!empty($user->addresses[0]->street))
                            value="{{ $user->addresses[0]->street }}"
                        @endif>
                    @error('street')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="name">{{ __('website/navbar.building') }}</label>
                    <input id="name" type="text" name="building" class="form-control"
                        @if (!empty($user->addresses[0]->building))
                            value="{{ $user->addresses[0]->building }}"
                        @endif>
                    @error('building')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
                <div class="col-4">
                    <label for="name">{{ __('website/navbar.floor') }}</label>
                    <input id="name" type="text" name="floor" class="form-control"
                        @if (!empty($user->addresses[0]->floor))
                            value="{{ $user->addresses[0]->floor }}"
                        @endif>
                    @error('floor')
                    <p class="text-danger">{{ $message }}</p>
                    @enderror
                </div>
            </div>
            <div class="form-group mt-3">
                <label for="note">{{ __('website/navbar.notes') }}</label>
                <input id="note" type="text" name="note" class="form-control">
            </div>
            <div class="text-center">
                <button type="submit" class="btn btn-primary">{{ __('website/navbar.update') }}</button>
            </div>
        </form>
    </div>
</div>