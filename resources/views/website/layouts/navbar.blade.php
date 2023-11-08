<div class="container-fluid mb-5">
    <div class="row border-top px-xl-5">
        <div class="col-lg-3 d-none d-lg-block">
            <a class="btn shadow-none d-flex align-items-center justify-content-between bg-primary text-white w-100" data-toggle="collapse" href="#navbar-vertical" style="height: 65px; margin-top: -1px; padding: 0 30px;">
                <h6 class="m-0">{{ __('website/navbar.books') }}</h6>
                <i class="fa fa-angle-down text-dark"></i>
            </a>
            <nav class="collapse navbar navbar-vertical navbar-light align-items-start p-0 border border-top-0 border-bottom-0" id="navbar-vertical">
                <div class="navbar-nav w-100 overflow-hidden">
                    <div class="nav-item dropdown">
                        <a href="{{ route('purchase.books') }}" class="nav-link">{{ __('website/navbar.purchasable_books') }}</a>
                    </div>
                    <div class="nav-item dropdown">
                        <a href="{{ route('download.books') }}" class="nav-link">{{ __('website/navbar.downloadable_books') }}</a>
                    </div>
                </div>
            </nav>
        </div>
        <div class="col-lg-9">
            <nav class="navbar navbar-expand-lg bg-light navbar-light py-3 py-lg-0 px-0">
                <a href="" class="text-decoration-none d-block d-lg-none">
                    <h1 class="m-0 display-5 font-weight-semi-bold"><span class="text-primary font-weight-bold border px-3 mr-1">E</span>Shopper</h1>
                </a>
                <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbarCollapse">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse justify-content-between" id="navbarCollapse">
                    <div class="navbar-nav mr-auto py-0">
                        <a href="{{ route('website')}}" class="nav-item nav-link active">{{ __('website/navbar.home') }}</a>
                        {{-- <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">Pages</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                <a href="cart.html" class="dropdown-item">Shopping Cart</a>
                                <a href="checkout.html" class="dropdown-item">Checkout</a>
                            </div>
                        </div> --}}
                        <a href="contact.html" class="nav-item nav-link">{{ __('website/navbar.contact') }}</a>
                        <div class="nav-item dropdown">
                            <a href="#" class="nav-link dropdown-toggle" data-toggle="dropdown">{{ LaravelLocalization::getCurrentLocaleNative() }}</a>
                            <div class="dropdown-menu rounded-0 m-0">
                                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                                    href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                                    {{ $properties['native'] }}
                                    </a>
                                @endforeach
                            </div>
                        </div>
                    </div>
                    <div class="n">
                        @if (Route::has('login'))
                        <div class="sm:fixed sm:top-0 sm:right-0 p-6 text-right z-10">
                            @auth
                            <div class="nav-item dropdown">
                                <a href="#" class="nav-link dropdown-toggle mr-3" data-toggle="dropdown">{{ Auth::user()->name}}</a>
                                <div class="dropdown-menu rounded-0 m-0">
                                    <a class="dropdown-item text-dark" href="{{ route('profile.edit') }}">{{ __('website/navbar.profile') }}</a>
                                    <form method="POST" action="{{ route('logout') }}">
                                        @csrf
                                        <a href="{{route('logout')}}" class="dropdown-item text-dark" >
                                            {{ __('website/navbar.logout') }}
                                        </a>
                                    </form>
                                </div>
                            </div>
                            @else
                            @if (Route::has('register'))
                            <a href="{{ route('register') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('website/navbar.register') }}</a>
                            <a href="{{ route('login') }}" class="ml-4 font-semibold text-gray-600 hover:text-gray-900 dark:text-gray-400 dark:hover:text-white focus:outline focus:outline-2 focus:rounded-sm focus:outline-red-500">{{ __('website/navbar.login') }}</a>

                            @endif
                            @endauth
                        </div>
                        @endif
         
                    </div>
                </div>
            </nav>
        </div>
    </div>
</div>
