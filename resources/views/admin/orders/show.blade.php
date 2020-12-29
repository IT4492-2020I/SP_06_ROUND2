@extends('layouts.app')

@section('title', 'Thông tin đơn hàng')

@section('content')
    <!-- Page Content  -->
    <div id="content">
        <div class="row mt-3 mb-5">
            <div class="col">
                <div class="page-header">
                    <h2>Thông tin chi tiết đơn hàng</h2>
                </div>
            
            </div>
            <div class="col text-right">
                @if (($order->status == 1) || ($order->status == 2))
                    <a href="{{ route('orders.status', $order->id) }}" class="btn btn-success mb-1">{{ $status[$order->status + 1] }}</a>
                    <button class="btn btn-danger mb-1" data-toggle="modal" data-target="#cancel-modal">{{ $status[4] }}</button>
                    
                    <!-- Modal -->
                    <div class="modal fade text-left" id="cancel-modal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                        <form method="post" action="{{ route('orders.cancel') }}">
                            @csrf
                            <div class="modal-dialog" role="document">
                                <div class="modal-content">
                                    <div class="modal-header">
                                        <h5 class="modal-title">Bạn có chắc chắn muốn hủy đơn hàng này không?</h5>
                                    </div>
                                    <div class="modal-body">
                                        <div class="form-group">
                                            <input type="hidden" value="{{ $order->id }}" name="id">
                                            <label for="recipient-name" class="col-form-label">Lý do:</label>
                                            <input type="text" class="form-control" name="reason" id="recipient-name" required>
                                        </div>
                                    </div>
                                    <div class="modal-footer">
                                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Huỷ</button>
                                        <button type="submit" class="btn btn-danger">OK</button>
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                @endif
            </div>
        </div>
        <table class="table">
            <tbody>
            <tr>
                <th>Tên khách hàng:</th>
                <td><a href="{{ route('users.show', $order->user_id) }}">{{ $order->user->name }}</a></td>
            </tr>
            <tr>
                <th>Số điện thoại:</th>
                <td>{{ $order->user->phone }}</td>
            </tr>
            <tr>
                <th>Địa chỉ:</th>
                <td>{{ $order->user->address }}</td>
            </tr>
            <tr>
                <th>Ghi chú</th>
                <td>{{ $order->memo }}</td>
            </tr>
            <tr>
                <th>Trạng thái:</th>
                <td>{{ $status[$order->status] }}</td>
            </tr>
            <tr>
                <th>Ngày mua:</th>
                <td>{{ $order->created_at }}</td>
            </tr>
            </tbody>
        </table>
        <div>
            <h4>Đơn hàng chi tiết</h4>
        </div>
        <table class="table">
            <thead>
            <tr>
                <th>#</th>
                <th class="text-center">Tên sản phẩm</th>
                <th class="text-center">hình ảnh</th>
                <th class="text-center">Số lượng</th>
                <th class="text-right">Giá trị(vnđ)</th>
            </tr>
            </thead>
            <tbody>
            @foreach($order->ordersDetail()->get() as $key => $value)
                <tr>
                    @php($product = $value->product)
                    <td>{{ $key }}</td>
                    <td class="text-center"><a href="{{ route('products.show', $product->id) }}">{{ $product->name }}</a></td>
                    <td class="text-center">
                        <img src="{{ $product->image_font }}" class="img-thumbnail" width="150" height="auto" alt="{{ $product->name }}">
                    </td>
                    <td class="text-center">{{ $value->quantity }}</td>
                    <td class="text-right">{{ number_format($value->quantity * $product->price, 0, '', ',') }} đ</td>
                </tr>
            @endforeach
            <tr>
                <td colspan="4" class="text-right"><h4>Thanh toán(vnđ):</h4></td>
                <td class="text-right"><h4><b>{{ number_format($order->total, 0, '', ',') }} đ</b></h4></td>
            </tr>
            </tbody>
        </table>
    </div>
@endsection
