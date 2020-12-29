@extends('layouts.app')

@section('title', 'Hiên thị giá sản phẩm')

@section('content')
    <!-- Page Content  -->
    <div id="content">
        <div class="row">
            <div class="col-md-12">
                <div class="page-header row">
                    <div class="col">
                        <h2><a href="{{ route('products.audit') }}">Danh sách thay đổi giá sản phẩm</a></h2>
                    </div>
                </div>
            </div>
            @if ($audits->count() == 0)
                <div><h3 class="text-center red">{{ 'Không tìm thấy bản ghi nào.' }}</h3></div>
            @else
                <table class="table">
                    <thead>
                    <tr>
                        <th>#</th>
                        <th class="text-center">Tên</th>
                        <th class="text-center">Giá trước</th>
                        <th class="text-center">Trang thái</th>
                        <th class="text-center">Giá sau</th>
                        <th class="text-center">Tác động bởi</th>
                        <th class="text-center">Thời gian</th>
                        <th class="text-center">Hành động</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($audits as $key => $value)
                        <tr>
                            <td class="text-center">{{ $audits->perPage() * ($audits->currentPage() - 1) + $key + 1 }}</td>
                            <td class="text-center"><a href="{{ route('products.show', $value->product_id) }}">{{ $value->product->name }}</a></td>
                            <td class="text-center">{{ $value->price_before }}</td>
                            <td class="text-center pt-2 "><h3><b>
                                        @if($value->price_before < $value->price_after)
                                            <span class="text-success">+</span>
                                        @else
                                            <span class="text-danger">-</span>
                                        @endif
                                    </b></h3></td>
                            <td class="text-center">{{ $value->price_after }}</td>
                            <td class="text-center">{{ $value->email }}</td>
                            <td class="text-center">{{  date("H:i:s d/m/Y",strtotime($value->created_at)) }}</td>
                            <td class="text-center">
                                <form action="{{ route('products.audit') }}" method="get">
                                    <input type="hidden" value="{{ $value->product_id }}" name="product_id">
                                    <button class="btn btn-link text-info pt-0 mt-0" type="submit">Xem</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
                <div class="col-md-12">{{ $audits->appends(request()->input())->links() }}</div>
            @endif
        </div>
    </div>
@endsection