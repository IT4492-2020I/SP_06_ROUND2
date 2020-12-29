@extends("layout.index")
@section("content")
<div class="container">
		<div id="content" class="space-top-none">
			<div class="main-content">
				<div class="space60">&nbsp;</div>
				<div class="row">
					<div class="col-sm-3">
						<ul class="aside-menu">
						@foreach($category as $cate)
							<li><a href="{{route('category',$cate->id)}}">{{$cate->name}}</a></li>
						@endforeach
						</ul>
					</div>
					<div class="col-sm-9">
						<div class="beta-products-list">
							<h4>New Products</h4>
							<div class="beta-products-details">
								<p class="pull-left">{{count($product_category)}} styles found </p>
								<div class="clearfix"></div>
							</div>
							<div class="row">
							@foreach($product_category as $product)
								<div class="col-sm-4">
									<div class="single-item" style="padding:10px; margin:5px 0px;">
										<div class="single-item-header">
											<a href="{{route('productdetail',$product->id)}}"><img src="{{$product->image}}" style="width:270px; height:auto;" alt=""></a>
										</div>
										<div class="single-item-body">
											<p class="single-item-title">{{$product->name}} </p>
											<p class="single-item-price">
												<span>{{number_format($product->price,0 ,'.' ,'.')}}</span>
											</p>
										</div>
										<div class="single-item-caption" style="margin:2px 0px 0px 0px">
											<a class="add-to-cart pull-left" href="{{route('add_cart',$product->id)}}"><i class="fa fa-shopping-cart"></i></a>
											<a class="beta-btn primary" href="{{route('productdetail',$product->id)}}">Details <i class="fa fa-chevron-right"></i></a>
											<div class="clearfix"></div>
										</div>
									</div>
								</div>
							@endforeach
								<div class="col-md-4 offset-md-4">{{$product_category->links()}}</div>
							</div>
						</div> <!-- .beta-products-list -->
							<div class="space40">&nbsp;</div>
						</div> <!-- .beta-products-list -->
					</div>
				</div> <!-- end section with sidebar and main content -->
			</div> <!-- .main-content -->
		</div> <!-- #content -->
	</div> <!-- .container -->
@endsection
