@extends('user::layoutAdmin.app')

@section('title', 'Thông tin người dùng')

@section('content')
        <!-- Page Content  -->
        <div id="content">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Thông tin người dùng</h2>
                </div>
            </div>
            <table class="table">
                <tr>
                    <th scope="col">#Id</th>
                    <td>{{ $user->id }}</td>
                </tr>
                <tr>
                    <th scope="col">Tên</th>
                    <td>{{ $user->name }}</td>
                </tr>
                <tr>
                    <th scope="col">email</th>
                    <td>{{ $user->email }}</td>
                </tr>
                <tr>
                    <th scope="col">avatar</th>
                    <td><img src="{{ asset($user->avata_url) }}" class="img-thumbnail" width="250" height="auto" alt="{{ $user->name }}"></td>
                </tr>
                <tr>
                    <th scope="col">Số điện thoại</th>
                    <td>{{ $user->phone }}</td>
                </tr>
                <tr>
                    <th scope="col">Địa chỉ</th>
                    <td>{{ $user->address }}</td>
                </tr>
                <tr>
                    <th scope="col">Quyền</th>
                    <td>@if (($user->role) == 1)Admin @else Customer @endif</td>
                </tr>
                <tr>
                    <th scope="col">Trạng thái</th>
                    <td>@if (($user->status) == 1) Kích hoạt @else Khóa @endif</td>
                </tr>
                <tr>
                    <th scope="col">Ngày khởi tạo</th>
                    <td>{{ date("H:i:s d/m/Y",strtotime($user->created_at)) }}</td>
                </tr>
            </table>
    </div>
@endsection
