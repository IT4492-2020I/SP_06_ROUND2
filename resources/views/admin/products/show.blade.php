@extends('layouts.app')

@section('title', 'Thông tin sản phầm')

@section('content')
        <!-- Page Content  -->
        <div id="content">
            <div class="col-md-12">
                <div class="page-header">
                    <h2>Thông tin sản phầm</h2>
                </div>
            </div>
            <table class="table">
                <tr>
                    <th scope="col">#</th>
                    <td>{{ $product->id }}</td>
                </tr>
                <tr>
                    <th scope="col">Tên</th>
                    <td>{{ $product->name }}</td>
                </tr>
                <tr>
                    <th scope="col">ảnh sản phẩm</th>
                    <td><img src="{{ asset($product->image) }}" class="img-thumbnail" width="250" height="auto" alt="{{ $product->name }}"></td>
                </tr>
                <tr>
                    <th scope="col">Giá tiền</th>
                    <td>{{ number_format($product->price) }} đ</td>
                </tr>
                <tr>
                    <th scope="col">Thể loại</th>
                    <td>{{ $product->category->name }}</td>
                </tr>
                <tr>
                    <th scope="col">trang thái</th>
                    <td>@if (($product->status) == 0)Ngừng bán @else Kinh doanh @endif</td>
                </tr>
                <tr>
                    <th scope="col">Ngày khởi tạo</th>
                    <td>{{ date("H:i:s d/m/Y",strtotime($product->created_at)) }}</td>
                </tr>
            </table>
            </table>
    </div>
@endsection
