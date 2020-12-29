@extends("product::layoutUser.index")
@section("content")
<div class="container">
    <div id="content">
        <div class="row">
            <div class="col-sm-9">

                <div class="row">
                    <div class="col-sm-4">
                        <img id="anhchinh" src="{{$product->image}}"/></br>
                    </div>
                    <div class="col-sm-8">
                        <div class="single-item-body">
                            <p class="single-item-price">Tên sản phẩm: {{$product->name}}</p><br/>
                            <p class="single-item-price">
                                <span>Giá: {{number_format($product->price,0 ,'.' ,'.')}} VND</span>
                            </p><br/>
                            <p class="single-item-price">Dòng sản phẩm: {{$product->name}}</p><br/>
                            <p class="single-item-price">Mô tả sản phẩm: {{$product->description}}</p><br/>

                        </div>

                        <div class="clearfix"></div>
                        <div class="space20">&nbsp;</div>

                        <div class="single-item-desc">

                            <a class="add-to-cart" href="{{route('add_cart',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                            <div class="clearfix"></div>
                        </div>
                    </div>
                </div>

                <div class="space40">&nbsp;</div>
                <div class="beta-products-list">
                    <h4>Sản phẩm liên quan</h4>
                    <div class="row">
                        @foreach($product_related as $product)
                        <div class="col-sm-4">
                            <div class="single-item" style="padding:10px; margin:5px 0px;">
                                <div class="single-item-header">
                                    <a href="{{route('productdetail',$product->id)}}"><img src="{{$product->image}}" style="width:270px; height:auto;" alt=""></a>
                                </div>
                                <div class="single-item-body">
                                    <p class="single-item-title">{{$product->name}}</p>
                                    <p class="single-item-price">
                                        <span>{{number_format($product->price,0 ,'.' ,'.')}} VND</span>
                                    </p>
                                </div>
                                <div class="single-item-caption" style="margin:2px 0px 0px 0px">
                                    <a class="add-to-cart pull-left" href="{{route('add_cart',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
                                    <a class="beta-btn primary" href="{{route('productdetail',$product->id)}}">Chi tiết <i class="fa fa-chevron-right"></i></a>
                                    <div class="clearfix"></div>
                                </div>
                            </div>
                        </div>
                        @endforeach
                    </div>
                </div>
                <!-- .beta-products-list -->
            </div>
            <div class="col-sm-3">
                <!-- best sellers widget -->
                <div class="widget">
                    <h3 class="widget-title">Sản phẩm mới</h3>
                    <div class="widget-body">
                        <div class="beta-sales beta-lists">
                            @foreach($new_product as $product)
                            <div class="media beta-sales-item">
                                <a class="pull-left" href="{{route('productdetail',$product->id)}}"><img src="{{$product->image}}" alt=""></a>
                                <div class="media-body"style="font-size:18px">
                                    {{$product->name}}<br/>
                                    <span class="beta-sales-price"style="font-size:15px">{{number_format($product->price,0 ,'.' ,'.')}} VND</span>
                                </div>
                            </div>
                            @endforeach
                        </div>
                    </div>
                </div>
                <!-- best sellers widget -->
            </div>
        </div>
    </div>
    <!-- #content -->
</div>
<!-- .container -->

@endsection
