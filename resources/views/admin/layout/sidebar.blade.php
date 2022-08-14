<div id="left-sidebar" class="sidebar">
    <div class="">
        <div class="user-account">

            <div class="dropdown">
                <span>Welcome,</span>
                <a href="javascript:void(0);" class="user-name" data-toggle="dropdown"><strong>Administrator</strong></a>
            </div>
            <hr>
            <ul class="row list-unstyled">
                <li class="col-4">
                    <small>Orders</small>
                    <h6>{{ App\Models\Order::all()->count() }}</h6>
                </li>
                <li class="col-4">
                    <small>Profit</small>
                    <h6>£ 0.00</h6>
                </li>
            </ul>
        </div>

        <nav id="left-sidebar-nav" class="sidebar-nav">
            <ul id="main-menu" class="metismenu">
                <li class="{{ Route::is('admin.dashboard') ? 'active' : '' }}">
                    <a href="{{ route('admin.dashboard') }}" class=""><i class="icon-home"></i>
                        <span>Dashboard</span></a>
                </li>
                <li class="{{ Route::is('admin.orders.*') ? 'active' : '' }}">
                    <a href="#" class="has-arrow"><i class="icon-grid"></i> <span>Sales</span></a>
                    <ul>
                        <li class="{{ Route::is('admin.orders.index') ? 'active' : '' }}"><a href="{{ route('admin.orders.index') }}">Orders</a></li>
                        <li class="{{ Route::is('admin.orders.bespoke') ? 'active' : '' }}"><a href="{{ route('admin.orders.bespoke') }}">Bespoke Orders</a></li>
                        <li class="{{ Route::is('admin.orders.bridal') ? 'active' : '' }}"><a href="{{ route('admin.orders.bridal') }}">Bridal Orders</a></li>
                    </ul>
                </li>
                <li class="{{ Route::is('admin.category.*') ? 'active' : '' }}">
                    <a href="#" class="has-arrow"><i class="icon-folder"></i> <span>Catalog</span></a>
                    <ul>
                        <li><a href="{{ route('admin.products.index') }}">Products</a></li>
                        <li><a href="{{ route('admin.category.index') }}">Categories</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow"><i class="icon-globe"></i> <span>Customers</span></a>
                    <ul>
                        <li><a href="{{ route('admin.user.index') }}">List</a></li>
                        <li><a href="blog-list.html">Newsletter Subscriptions</a></li>
                    </ul>
                </li>
                <li>
                    <a href="#" class="has-arrow"><i class="icon-diamond"></i> <span>Settings</span></a>
                    <ul>
                        <li><a href="ui-typography.html">Locales</a></li>
                        <li><a href="{{ route('admin.settings.currency.index') }}">Currency Settings</a></li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>
