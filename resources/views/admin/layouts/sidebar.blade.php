<div class="left-side-menu left-side-menu-detached">

    {{--<div class="leftbar-user">--}}
        {{--<a href="javascript: void(0);">--}}
            {{--<img src="{{ asset('images/users/avatar-1.jpg') }}" alt="user-image" height="42"--}}
                {{--class="rounded-circle shadow-sm">--}}
            {{--<span class="leftbar-user-name">Nhiệm</span>--}}
        {{--</a>--}}
    {{--</div>--}}

    <!--- Sidemenu -->
    <ul class="metismenu side-nav">

        <li class="side-nav-title side-nav-item">Menu</li>

        <li class="side-nav-item">
            <a href="{{route('admin.attributes.index')}}" class="side-nav-link">
                <i class="dripicons-chevron-right"></i>
                <span>Attributes</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{route('admin.attribute_values.index')}}" class="side-nav-link">
                <i class="dripicons-chevron-right"></i>
                <span>Attribute Values</span>
            </a>
        </li>

         <li class="side-nav-item">
            <a href="{{route('admin.categories.index')}}" class="side-nav-link">
                <i class="dripicons-chevron-right"></i>
                <span>Categories</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{route('admin.brands.index')}}" class="side-nav-link">
                <i class="dripicons-chevron-right"></i>
                <span>Brands</span>
            </a>
        </li>

         <li class="side-nav-item">
            <a href="{{route('admin.products.index')}}" class="side-nav-link">
                <i class="dripicons-chevron-right"></i>
                <span>Products</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{route('admin.banners.index')}}" class="side-nav-link">
                <i class="dripicons-chevron-right"></i>
                <span>Banners</span>
            </a>
        </li>

        <li class="side-nav-item">
            <a href="{{route('admin.menus.index')}}" class="side-nav-link">
                <i class="dripicons-chevron-right"></i>
                <span>Menus</span>
            </a>
        </li>

        <li class="side-nav-title side-nav-item">Others</li>

        <li class="side-nav-item">
            <a href="{{route('admin.locations.index')}}" class="side-nav-link">
                <i class="dripicons-chevron-right"></i>
                <span>Locations</span>
            </a>
        </li>
    </ul>
    <!-- End Sidebar -->

    <div class="clearfix"></div>
    <!-- Sidebar -left -->

</div>
