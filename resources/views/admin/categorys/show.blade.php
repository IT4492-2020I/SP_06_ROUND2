@extends('layouts.app')

@section('title', 'Thông tin người dùng')

@section('content')
        <!-- Page Content  -->
        <div id="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="page-header">
                        <h2>Thông tin thể loại</h2>
                    </div>
                </div>
            </div>
            <table class="table">
                <tr>
                    <th>#</th>
                    <td>{{ $category->id }}</td>
                </tr>
                <tr>
                    <th>Tên</th>
                    <td>{{ $category->name }}</td>
                </tr>
                <tr>
                    <th>Trạng thái</th>
                    <td>@if (($category->status) == 1)Đang sử dụng @else Ngưng sử dụng @endif</td>
                </tr>
                <tr>
                    <th>Ngày tạo</th>
                    <td>{{ date("H:i:s d/m/Y",strtotime($category->created_at)) }}</td>
                </tr>
            
            </table>
            
            <h5>Những sản phẩm trong thể loại này.</h5>
            <table class="table">
                <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Tên sản phẩm</th>
                    <th scope="col">Giá tiền</th>
                    <th scope="col">Trạng thái</th>
                    <th scope="col">Thời gian tạo</th>
                </tr>
                </thead>
                <tbody>
                @if($category->products()->count())
                    @foreach($category->products()->get() as $id => $value)
                        <tr>
                            <td>{{ $id }}</td>
                            <td><a href="#">{{ $value->name }}</a></td>
                            <td>{{ $value->price }}</td>
                            <td>{{ $value->status }}</td>
                            <td>{{ date("H:i:s d/m/Y",strtotime($value->created_at)) }}</td>
                        </tr>
                    @endforeach
                @else
                    <td>Không có sản phẩm nào nào</td>
                @endif
                </tbody>
            </table>
    </div>
@endsection
