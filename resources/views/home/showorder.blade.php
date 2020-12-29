@extends("layout.index")
@section('content')
<div class="container">
    <div id="content" class="row">
        <div class="table-responsive">
            <!-- Shop Products Table -->
            <h4>Đơn hàng của bạn</h4>
                <table class="shop_table beta-shopping-cart-table" cellspacing="0">
                    <thead>
                        <tr>
                            <th class="product-name">Sản Phẩm</th>
                            <th class="product-price">Giá</th>
                            <th class="product-quantity">Số Lượng</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($productcart as $product)
                        <tr class="cart_item">
                            <td class="product-name">
                                <div class="media">
                                    <img class="pull-left" height="40px" width="40px" style="margin-right:10px" src="{{$product->image_font}}" alt="">
                                    <div class="media-body">
                                        <p class="font-large table-title">{{$product->name}}</p>
                                    </div>
                                </div>
                            </td>
                            <td class="product-price">
                                <span class="amount" id="price">{{number_format($product->price,0 ,'.' ,'.')}} VND</span>
                            </td>
                            <td class="product-quantity">
                                <input type="number" id="qty" style="width:40px; height=20px" name="sl" disabled value="{{$product->quantity}}" min="1" data-id="" />
                            </td>

                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                    </tfoot>

                </table>
        </div>
        <!-- #content -->
    </div>
    <div id="content">
        <div class="your-order-head"  class="row"><h5>Tổng tiền đơn hàng của bạn:<span id="total_price">{{number_format($totalPrice,0 ,'.' ,'.')}} VND</span></h5></div>
        <div class="your-order-head"  class="row">
            <h>Hình thức thanh toán</h5><br/>
              <div><strong>
                        Cửa hàng sẽ gửi hàng đến địa chỉ của bạn, bạn xem hàng rồi thanh toán tiền cho nhân viên giao hàng
                        </strong>
                    </div>
        </div>

        <div class="your-order-body"  class="row">
        <ul class="payment_methods methods">
                <li class="payment_method_bacs">

                </li>
            </ul>
        </div>
        <div class="text-center"><a href="{{route('rediect')}}"><button type="submit" class="beta-btn primary"> Home <i class="fa fa-chevron-right"></i></button></a></div>
    </div>
</div>
<!-- .container -->
@endsection
