<nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
        <li class="nav-item">
            <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="index3.html" class="nav-link">{{ __('dashboard/navbar.home') }}</a>
        </li>
        <li class="nav-item d-none d-sm-inline-block">
            <a href="#" class="nav-link">{{ __('dashboard/navbar.contact') }}</a>
        </li>
        <div class="dropdown">
            <button class="btn dropdown-toggle" type="button" data-toggle="dropdown" aria-expanded="false">
                <span class="hidden-md-down">{{ LaravelLocalization::getCurrentLocaleNative() }}</span>
            </button>
            <div class="dropdown-menu">
                @foreach (LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                <a class="dropdown-item" rel="alternate" hreflang="{{ $localeCode }}"
                href="{{ LaravelLocalization::getLocalizedURL($localeCode, null, [], true) }}">
                {{ $properties['native'] }}
                </a>
                @endforeach
            </div>
        </div>          
    </ul>

    <!-- SEARCH FORM -->
    <form class="form-inline ml-3">
        <div class="input-group input-group-sm">
            <input class="form-control form-control-navbar" type="search" placeholder="{{ __('dashboard/navbar.search') }}" aria-label="Search">
            <div class="input-group-append">
                <button class="btn btn-navbar" type="submit">
                    <i class="fas fa-search"></i>
                </button>
            </div>
        </div>
    </form>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
        <!-- Messages Dropdown Menu -->
        <li class="nav-item dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-comments"></i>
                <span class="badge badge-danger navbar-badge">3</span>
            </a>
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right">
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('assets/dashboard/dist/img/user1-128x128.jpg') }}" alt="User Avatar" class="img-size-50 mr-3 img-circle">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Brad Diesel
                                <span class="float-right text-sm text-danger"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">Call me whenever you can...</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('assets/dashboard/dist/img/user8-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                John Pierce
                                <span class="float-right text-sm text-muted"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">I got your message bro</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item">
                    <!-- Message Start -->
                    <div class="media">
                        <img src="{{ asset('assets/dashboard/dist/img/user3-128x128.jpg') }}" alt="User Avatar" class="img-size-50 img-circle mr-3">
                        <div class="media-body">
                            <h3 class="dropdown-item-title">
                                Nora Silvester
                                <span class="float-right text-sm text-warning"><i class="fas fa-star"></i></span>
                            </h3>
                            <p class="text-sm">The subject goes here</p>
                            <p class="text-sm text-muted"><i class="far fa-clock mr-1"></i> 4 Hours Ago</p>
                        </div>
                    </div>
                    <!-- Message End -->
                </a>
                <div class="dropdown-divider"></div>
                <a href="#" class="dropdown-item dropdown-footer">{{ __('dashboard/navbar.see_notifications') }}</a>
            </div>
        </li>
        <!-- Notifications Dropdown Menu -->
        <li class="nav-item dropdown notification-dropdown">
            <a class="nav-link" data-toggle="dropdown" href="#">
                <i class="far fa-bell"></i>
                @foreach (Auth::guard('admin')->user()->unreadNotifications as $notification)
                    @if (Auth::guard('admin')->user()->unreadNotifications->count() > 0)
                        @if (Auth::guard('admin')->user()->id == $notification->notifiable_id)
                            <span class="badge badge-warning navbar-badge notification-badge">{{ Auth::guard('admin')->user()->unreadNotifications->count() }}</span> 
                        @endif
                    @endif
                @endforeach
                
            </a>
    
            <div class="dropdown-menu dropdown-menu-lg dropdown-menu-right notification-count">
                @if (Auth::guard('admin')->user()->unreadNotifications ->count() > 0)
                    <span class="dropdown-item dropdown-header notification-count">{{ Auth::guard('admin')->user()->unreadNotifications->count() }} Notifications</span>
                @else
                    <span class="dropdown-item dropdown-header notification-count">{{ __('dashboard/navbar.no_notifications') }}</span>
                @endif
                <div class="dropdown-divider"></div>
                @if (Auth::guard('admin')->user()->unreadNotifications->count() > 0)
                    @foreach (Auth::guard('admin')->user()->unreadNotifications as $notification)
                        <a href="{{ route('admin.users.index'/* ,$notification->data['id'] */) }}" class="dropdown-item">
                            <i class="fas fa-file mr-2"></i>{{ $notification->data['title'] }}
                            <br> from {{ $notification->data['user'] }}
                            <span class="float-right text-muted text-sm">{{ $notification->created_at/* ->format('d M Y') */ }}</span>
                        </a>
                    @endforeach
                    <div class="dropdown-divider"></div>
                    <a href="{{ route('admin.MarkAsRead_all') }}" class="dropdown-item dropdown-footer">{{ __('dashboard/navbar.see_notifications') }}</a>
                @endif
                
            </div>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="fullscreen" href="#" role="button">
                <i class="fas fa-expand-arrows-alt"></i>
            </a>
        </li>
        <li class="nav-item">
            <a class="nav-link" data-widget="control-sidebar" data-slide="true" href="#" role="button">
                <i class="fas fa-th-large"></i>
            </a>
        </li>
        <li>
            @auth
            <div class="dropdown">
                <button class="btn dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                    {{ Auth::user()->name}}
                </button>
                <div class="dropdown-menu bg-dark" aria-labelledby="dropdownMenuButton">
                    <a class=" btn btn-secondary d-block w-100" href="{{ route('admin.profile.index') }}">{{ __('dashboard/navbar.profile') }}</a>
                    <form method="POST" action="{{ route('admin.logout') }}">
                        @csrf
                        <button class="btn btn-secondary d-block w-100">{{ __('dashboard/navbar.logout') }}</button>
                    </form>
                </div>
            </div>
            @endauth
        </li>
    </ul>
</nav>
 <!-- Content Header (Page header) -->
 <div class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1 class="m-0">Dashboard</h1>
            </div><!-- /.col -->
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="#">{{ __('dashboard/navbar.home') }}</a></li>
                    <li class="breadcrumb-item active">{{ __('dashboard/navbar.dashboard') }}</li>
                </ol>
            </div><!-- /.col -->
        </div><!-- /.row -->
    </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->
