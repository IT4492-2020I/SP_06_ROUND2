<!-- Sidebar  -->
<nav id="sidebar">
    <div class="sidebar-header">
        <h3>Admin mangager</h3>
    </div>

    <ul class="list-unstyled components pt-0">
        {{--users--}}
        <li class="active">
            <a href="#homeSubmenu1" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Người dùng</a>
            <ul class="collapse list-unstyled" id="homeSubmenu1">
                <li>
                    <a href="{{ route('users.index') }}">Danh sách</a>
                </li>
                <li>
                    <a href="{{ route('users.create') }}">Thêm mới</a>
                </li>
            </ul>
        </li>
        {{--categorys--}}
        <li class="active">
            <a href="#homeSubmenu2" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Thể loại</a>
            <ul class="collapse list-unstyled" id="homeSubmenu2">
                <li>
                    <a href="{{ route('categorys.index') }}">Danh sách</a>
                </li>
                <li>
                    <a href="{{ route('categorys.create') }}">Thêm mới</a>
                </li>
            </ul>
        </li>
        {{--products--}}
        <li class="active">
            <a href="#homeSubmenu3" data-toggle="collapse" aria-expanded="false" class="dropdown-toggle">Sản phẩm</a>
            <ul class="collapse list-unstyled" id="homeSubmenu3">
                <li>
                    <a href="{{ route('products.index') }}">Danh sách</a>
                </li>
                <li>
                    <a href="{{ route('products.create') }}">Thêm mới</a>
                </li>
            </ul>
        </li>

        {{--orders--}}
        <li>
            <a href="{{ route('orders.index') }}">Đơn hàng</a>
        </li>
    </ul>
</nav>
