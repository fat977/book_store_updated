<aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="index3.html" class="brand-link">
        <img src="{{ asset('assets/dashboard/dist/img/AdminLTELogo.png') }}" alt="AdminLTE Logo" class="brand-image img-circle elevation-3" style="opacity: .8">
        <span class="brand-text font-weight-light">{{  __('dashboard/sidebar.name') }}</span>
    </a>

    <!-- Sidebar -->
    <div class="sidebar my-3">
        <!-- Sidebar user panel (optional) -->
        <div class="user-panel mt-3 pb-3 mb-3 d-flex">
            <div class="image">
                @if (empty(Auth::guard('admin')->user()->image))
                    <img src="{{ asset('storage/avatars/default.png') }}"alt="User Image" class="img-circle elevation-2">
                @else
                    <img src="{{ asset('storage/avatars/'.Auth::guard('admin')->user()->image) }}"alt="User Image" class="img-circle elevation-2">
                @endif
            </div>
            <div class="info">
                <a href="#" class="d-block">{{ Auth::guard('admin')->user()->name}}</a>
            </div>
        </div>

        <!-- SidebarSearch Form -->
        {{-- <div class="form-inline">
            <div class="input-group" data-widget="sidebar-search">
                <input class="form-control form-control-sidebar" type="search" placeholder="Search" aria-label="Search">
                <div class="input-group-append">
                    <button class="btn btn-sidebar">
                        <i class="fas fa-search fa-fw"></i>
                    </button>
                </div>
            </div>
        </div> --}}

        <!-- Sidebar Menu -->
        <nav class="mt-2">
            <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
                
                <li class="nav-item">
                    <a href="{{ route('admin.dashboard') }}" class="nav-link {{ Route::is('admin.dashboard')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-tachometer-alt"></i>
                        <p>
                            {{__('dashboard/sidebar.dashboard')}}
                        </p>
                    </a>
                </li>
                
                <li class="nav-item {{ Route::is('admin.banners.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.banners.*')  ? 'active' : '' }}">
                        <i class="nav-icon fa-regular fa-image"></i>
                        <p>
                            {{__('dashboard/sidebar.banner.banners')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.banners.index') }}" class="nav-link {{ Route::is('admin.banners.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.banner.show')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.banners.create') }}" class="nav-link {{ Route::is('admin.banners.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.banner.add')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                @can('viewAny',App\Models\Admin::class)
                <li class="nav-item {{ Route::is('admin.admins.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.admins.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            {{__('dashboard/sidebar.admin.admins')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.admins.index') }}" class="nav-link {{ Route::is('admin.admins.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.admin.show')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.admins.create') }}" class="nav-link {{ Route::is('admin.admins.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.admin.add')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
                @endcan
                
                <li class="nav-item {{ Route::is('admin.users.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.users.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-user-circle"></i>
                        <p>
                            {{__('dashboard/sidebar.user.users')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.users.index') }}" class="nav-link {{ Route::is('admin.users.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.user.show')}}</p>
                            </a>
                        </li>
                        <li class="nav-item @if (Route::is('admin.users.index') && request()->has('trashed')) ? 'active' : '' bg-primary @endif">
                            <a class="nav-link" href="{{ url('/dashboard/users?trashed') }}">
                                <i class="fa-solid fa-trash-can-arrow-up nav-icon"></i>
                                <p>{{__('dashboard/sidebar.user.deleted')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('admin.cities.*') || Route::is('admin.regions.*') ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.cities.*') || Route::is('admin.regions.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{__('dashboard/sidebar.address.addresses')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.cities.index') }}" class="nav-link {{ Route::is('admin.cities.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.address.cities')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.regions.index') }}" class="nav-link {{ Route::is('admin.regions.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.address.regions')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>
               
                <li class="nav-item {{ Route::is('admin.orders.index') || Route::is('admin.orders.view')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.orders.index') || Route::is('admin.orders.view')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{__('dashboard/sidebar.order.orders')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.orders.index') }}" class="nav-link {{ !request()->has('history') && Route::is('admin.orders.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.order.show')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ url('/dashboard/orders?history') }}" class="nav-link @if (Route::is('admin.orders.index') && request()->has('history')) ? 'active' : '' bg-white @endif">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.order.history')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                 <li class="nav-item {{ Route::is('admin.authors.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.authors.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{__('dashboard/sidebar.author.authors')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.authors.index') }}" class="nav-link {{ Route::is('admin.authors.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.author.show')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.authors.create') }}" class="nav-link {{ Route::is('admin.authors.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.author.add')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('admin.categories.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.categories.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{__('dashboard/sidebar.category.categories')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.index') }}" class="nav-link {{ Route::is('admin.categories.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.category.show')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.categories.create') }}" class="nav-link {{ Route::is('admin.categories.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.category.add')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

                <li class="nav-item {{ Route::is('admin.purchased_books.*') || Route::is('admin.offers.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.purchased_books.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{__('dashboard/sidebar.purchased.purchased_books')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.purchased_books.index') }}" class="nav-link {{ Route::is('admin.purchased_books.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.purchased.show')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.purchased_books.create') }}" class="nav-link {{ Route::is('admin.purchased_books.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.purchased.add')}}</p>
                            </a>
                        </li>

                        <li class="nav-item {{ Route::is('admin.offers.*')  ? 'menu-open' : '' }}">
                            <a href="#" class="nav-link {{ Route::is('admin.offers.*')  ? 'active' : '' }}">
                                <i class="nav-icon fas fa-copy"></i>
                                <p>
                                    {{__('dashboard/sidebar.purchased.offer.offers')}}
                                    <i class="fas fa-angle-left right"></i>
                                </p>
                            </a>
                            <ul class="nav nav-treeview">
                                <li class="nav-item">
                                    <a href="{{ route('admin.offers.index') }}" class="nav-link {{ Route::is('admin.offers.index')  ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('dashboard/sidebar.purchased.offer.show')}}</p>
                                    </a>
                                </li>
                                <li class="nav-item">
                                    <a href="{{ route('admin.offers.create') }}" class="nav-link {{ Route::is('admin.offers.create')  ? 'active' : '' }}">
                                        <i class="far fa-circle nav-icon"></i>
                                        <p>{{__('dashboard/sidebar.purchased.offer.add')}}</p>
                                    </a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                    
                    
                </li>

                <li class="nav-item {{ Route::is('admin.downloadable_books.*')  ? 'menu-open' : '' }}">
                    <a href="#" class="nav-link {{ Route::is('admin.downloadable_books.*')  ? 'active' : '' }}">
                        <i class="nav-icon fas fa-copy"></i>
                        <p>
                            {{__('dashboard/sidebar.downloadable.downloadable_books')}}
                            <i class="fas fa-angle-left right"></i>
                        </p>
                    </a>
                    <ul class="nav nav-treeview">
                        <li class="nav-item">
                            <a href="{{ route('admin.downloadable_books.index') }}" class="nav-link {{ Route::is('admin.downloadable_books.index')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.downloadable.show')}}</p>
                            </a>
                        </li>
                        <li class="nav-item">
                            <a href="{{ route('admin.downloadable_books.create') }}" class="nav-link {{ Route::is('admin.downloadable_books.create')  ? 'active' : '' }}">
                                <i class="far fa-circle nav-icon"></i>
                                <p>{{__('dashboard/sidebar.downloadable.add')}}</p>
                            </a>
                        </li>
                    </ul>
                </li>

            </ul>
        </nav>
        <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
</aside>