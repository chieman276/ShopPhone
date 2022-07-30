<div id="layoutSidenav_nav">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Core</div>
                <a class="nav-link" href="{{ route('backend.home')}}">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Trang chủ
                </a>
                @if(Auth::user()->hasPermission('Category_viewAny'))
                <div class="sb-sidenav-menu-heading">Interface</div>
                <a class="nav-link collapsed" href="{{ route('categories.index')}}">
                    <div class="sb-nav-link-icon"></div>
                    Danh Mục Sản Phẩm
                    <div class="sb-sidenav-collapse-arrow"></div>
                </a>
                @endif
                @if(Auth::user()->hasPermission('Product_viewAny'))
                <a class="nav-link collapsed" href="{{ route('products.index')}}">
                    <div class="sb-nav-link-icon"></div>
                    Danh Sách Sản Phẩm
                    <div class="sb-sidenav-collapse-arrow"></div>
                </a>
                @endif
                <a class="nav-link collapsed" href="{{ route('customers.index')}}">
                    <div class="sb-nav-link-icon"></div>
                    Danh Sách Khách Hàng
                    <div class="sb-sidenav-collapse-arrow"></div>
                </a>
                @if(Auth::user()->hasPermission('User_viewAny'))
                <a class="nav-link collapsed" href="{{ route('users.index')}}">
                    <div class="sb-nav-link-icon"></div>
                    Danh Sách Người Dùng
                    <div class="sb-sidenav-collapse-arrow"></div>
                </a>
                @endif
                @if(Auth::user()->hasPermission('UserGroup_viewAny'))
                <a class="nav-link collapsed" href="{{ route('userGroups.index')}}">
                    <div class="sb-nav-link-icon"></div>
                    Chức Vụ
                    <div class="sb-sidenav-collapse-arrow"></div>
                </a>
                @endif
                


    </nav>
</div>