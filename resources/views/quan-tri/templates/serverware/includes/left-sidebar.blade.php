<!-- ========== Left Sidebar Start ========== -->
@php
if (!isset($pageInfo['page'])) {
    $page = "dashboard";
} else {
    $page = $pageInfo['page'];
}
@endphp
<div class="left side-menu">
    <div class="slimscroll-menu" id="remove-scroll">
        <!--- Sidemenu -->
        <div id="sidebar-menu">
            <!-- Left Menu Start -->
            <ul class="metismenu" id="side-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" class="waves-effect @if($page == 'dashboard') mm-active @endif">
                        <i class="icon-accelerator"></i> <span> Dashboard </span>
                    </a>
                </li>
                <li class="menu-title">Shop</li>
                <li>
                    <a href="{{ route('supplier.list') }}" class="waves-effect @if($page == 'supplier') mm-active @endif">
                        <i class="fas fa-parachute-box"></i> <span> Suppliers </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('customers.list') }}" class="waves-effect @if($page == 'customers') mm-active @endif">
                        <i class="fas fa-user"></i> <span> Customers </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('invoice.list') }}" class="waves-effect @if($page == 'invoice') mm-active @endif">
                        <i class="fa fa-file" aria-hidden="true"></i> <span> Invoices </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('goods-receipt.list') }}" class="waves-effect @if($page == 'goods-receipt') mm-active @endif">
                        <i class="fas fa-truck"></i> <span> Goods receipts </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('product-categories.list') }}" class="waves-effect @if($page == "product-categories") mm-active @endif">
                        <i class="fa fa-th-list" aria-hidden="true"></i> <span> Product's categories </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('configs.list') }}" class="waves-effect @if($page == 'configs') mm-active @endif">
                        <i class="fa fa-cogs" aria-hidden="true"></i> <span> Configs </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('accessory-category.list') }}" class="waves-effect @if($page == 'accessory-category') mm-active @endif">
                        <i class="fa fa-th-list" aria-hidden="true"></i> <span> Accessory's categories </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('product.list') }}" class="waves-effect @if($page == 'product') mm-active @endif">
                        <i class="fab fa-product-hunt"></i> <span> Products </span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('accessory.list') }}" class="waves-effect @if($page == 'accessory') mm-active @endif">
                        <i class="fa fa-puzzle-piece" aria-hidden="true"></i> <span> Accessories </span>
                    </a>
                </li>
                <!--<li class="menu-title">User</li>
                <li>
                    <a href="#" class="waves-effect @if($page == 'shop-invoices') mm-active @endif">
                        <i class="icon-mail-open"></i> <span> Administrators </span>
                    </a>
                </li> -->
                <li class="menu-title">statistic</li>
                <li>
                    <a href="{{ route('statistic.accessories-index') }}" class="waves-effect @if($page == 'accessories') mm-active @endif">
                        <i class="fas fa-cubes"></i> <span> Accessory Statistics </span>
                    </a>
                </li>
                <!--include notification message-->
                @include(config('template.cmsTemplateBladeURL') . 'includes.notification-message')
            </ul>
        </div>
        <!-- Sidebar -->
        <div class="clearfix"></div>
    </div>
    <!-- Sidebar -left -->
</div>
<!-- Left Sidebar End -->

