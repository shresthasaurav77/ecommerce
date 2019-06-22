@extends('layouts.frontendLayout.front_design')
@section('content')
<?php use App\Product; ?>
	

		<div class="container">
			<div class="row">
				@if ($message = Session::has('flash_error_message'))
    
<div class="alert alert-danger" role="alert">
    <button type="button" class="close" data-dismiss="alert">×</button> 
        <strong>{{ Session('flash_error_message') }}</strong>
</div>
@endif
				<div class="col-sm-3">
				@include('layouts.frontendLayout.front_slidebar')
				</div>
				
				<div class="col-sm-9 padding-right">
 
					<div class="product-details"><!--product-details-->
						<div class="col-sm-5">
							<div class="view-product">
								<div class="easyzoom easyzoom--overlay easyzoom--with-thumbnails">
									<a href="{{asset('img/backend-img/products/large/'.$productDetails->image)}}">
								<img style="width:330px;" class="mainImage" src="{{asset('img/backend-img/products/medium/'.$productDetails->image)}}" alt="" />
							
							</div>
								
							</div>
							<div id="similar-product" class="carousel slide" data-ride="carousel">
								
								  <!-- Wrapper for slides -->

								    <div class="carousel-inner">
										<div class="item active thumbnails">
											@foreach($productsImages as $altimage)
											<a href="{{asset('img/backend-img/products/large/'.$altimage->image)}}" data-standard="{{asset('img/backend-img/products/large/'.$altimage->image)}}">
										  <img class="changeImage" style="width:90px; cursor:pointer"src="{{asset('img/backend-img/products/small/'.$altimage->image)}}" alt="">
										  @endforeach
										</a>
										 
										</div>
										
										
										
									</div>

								  <!-- Controls -->
								 
							</div>
							

						</div>
						<div class="col-sm-7">
							<form name="addtocartForm" id="addtocartForm" action="{{url('add-cart') }}" method="post">
								<input type="hidden" name="_token" value="{{csrf_token()}}">
								<input type="hidden" name="product_id" value="{{$productDetails->id}}">
								<input type="hidden" name="product_name" value="{{$productDetails->product_name}}">
								<input type="hidden" name="product_code" value="{{$productDetails->product_code}}">
								<input type="hidden" name="product_color" value="{{$productDetails->product_color}}">
								<input type="hidden" name="price" id="price" value="{{$productDetails->price}}">
								
								
							<div class="product-information">
								
								<!--/product-information-->
								<img src="{{asset('img/frontend-img/product-details/new.jpg')}}" class="newarrival" alt="" />
								<h2>{{$productDetails->product_name}}</h2>
								<p>Code: {{$productDetails->product_code}}</p>
								<p>
									<select id="selSize" name="size" style="width:150px;">
										 
										
										
										@foreach($productDetails->attributes as $sizes)
										<option value="{{$productDetails ->id}}-{{$sizes->size}}">{{$sizes->size}}</option>
										@endforeach
									</select>
								</p>
								<!-- <img src="{{asset('img/frontend-img/product-details/rating.png')}}" alt="" /> -->
								<?php $getCurrencyRate=Product::getCurrencyRates($productDetails->price) ?>
								<span>
									<span id="getPrice">₹ {{$productDetails->price}}

								<!-- <h2>USD {{ $getCurrencyRate['USD_Rate'] }}<br>
									NRS {{ $getCurrencyRate['NRS_Rate'] }}<br>
									USD {{ $getCurrencyRate['YEN_Rate'] }}
								</h2> -->
									</span>
									<label>Quantity:</label>
									<input type="text" name="quantity" value="1" />
									@if($total_stock>0)
									<button type="submit" class="btn btn-fefault cart" id="cartButton">
										<i class="fa fa-shopping-cart"></i>
										Add to cart
									</button>
									@endif
								</span>
								<p><b>Availability:</b><span id="Availabilty" >@if($total_stock>0)In Stock @else Out of Stock @endif</p></span>
								<p><b>Condition:</b> New</p>
								
								<a href=""><img src="{{asset('img/frontend-img/product-details/share.png')}}" class="share img-responsive"  alt="" /></a>
							</div>
						<!--/product-information-->
						</div>
					</div><!--/product-details-->
					
					<div class="category-tab shop-details-tab"><!--category-tab-->
						<div class="col-sm-12">
							<ul class="nav nav-tabs">
								<li><a href="#description" data-toggle="tab">Description</a></li>
								<li><a href="#care" data-toggle="tab">Material & Care</a></li>
								<li><a href="#delivery" data-toggle="tab">Delivery Option</a></li>
									@if(!empty($productDetails->video))
								<li><a href="#video" data-toggle="tab">Product Video</a></li>@endif
								<li><a href="#reviews" data-toggle="tab">Reviews</a></li>
								
							</ul>
						</div>
						<div class="tab-content">
							<div class="tab-pane fade" id="description">
								<div class="col-sm-12">
									<p>{{$productDetails->description}}</p>
								</div>
								
							</div>
							
							<div class="tab-pane fade" id="care" >
								
								<div class="col-sm-12">
									<p>{{$productDetails->care}}</p>
								</div>
							</div>
							
							<div class="tab-pane fade" id="delivery" >
								<div class="col-sm-12">
									<p>Paypal</p>
									<p>Cash On Deposit</p>							
								</div>
							</div>
							@if(!empty($productDetails->video))
							<div class="tab-pane fade" id="video">
								<div class="col-sm-12">
									<video width="620" height="240" controls>
  										<source src="{{url('videos/'.$productDetails->video)}}" type="video/mp4">
  						
										
									</video>
								</div>
							</div>
							@endif
							
							<div class="tab-pane fade active in" id="reviews" >
								<div class="col-sm-12">
									<ul>
										<li><a href=""><i class="fa fa-user"></i>EUGEN</a></li>
										<li><a href=""><i class="fa fa-clock-o"></i>12:41 PM</a></li>
										<li><a href=""><i class="fa fa-calendar-o"></i>31 DEC 2014</a></li>
									</ul>
									<p>Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua.Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.Duis aute irure dolor in reprehenderit in voluptate velit esse cillum dolore eu fugiat nulla pariatur.</p>
									<p><b>Write Your Review</b></p>
									
									<form action="#">
										<span>
											<input type="text" placeholder="Your Name"/>
											<input type="email" placeholder="Email Address"/>
										</span>
										<textarea name="" ></textarea>
										<b>Rating: </b> <img src="{{asset('img/frontend-img/product-details/rating.png')}}" alt="" />
										<button type="button" class="btn btn-default pull-right">
											Submit
										</button>
									</form>
								</div>
							</div>
							
						</div>
					</div><!--/category-tab-->
					
					<div class="recommended_items"><!--recommended_items-->
						<h2 class="title text-center">recommended items</h2>
						
						<div id="recommended-item-carousel" class="carousel slide" data-ride="carousel">
							<div class="carousel-inner">
								<?php $count=1; ?>
								@foreach($relatedProducts->chunk(3) as $chunk)
								<div <?php if($count==1){ ?> class="item active" <?php } else { ?> class="item" <?php } ?>>	
									@foreach($chunk as $item)
									<div class="col-sm-4">
										<div class="product-image-wrapper">
											<div class="single-products">
												<div class="productinfo text-center">
													<img style="width:250px;"src="{{asset('img/backend-img/products/medium/'.$item->image)}}" alt="" />
													<h2>NR {{$item->price}}</h2>
													<p>{{$item->product_name}}</p>
													<a href="{{url('product/'.$item->id) }}">
													<button type="button" class="btn btn-default add-to-cart"><i class="fa fa-shopping-cart"></i>View</button>
												</div>
											</div>
										</div>
									</div>
									
									@endforeach
								</div>
								<?php $count++; ?>
								@endforeach
							</div>
							 <a class="left recommended-item-control" href="#recommended-item-carousel" data-slide="prev">
								<i class="fa fa-angle-left"></i>
							  </a>
							  <a class="right recommended-item-control" href="#recommended-item-carousel" data-slide="next">
								<i class="fa fa-angle-right"></i>
							  </a>			
						</div>
					</div><!--/recommended_items-->
					
				</div>
			</div>
		</div>
	
	@endsection
	@section('script')
	<script src="{{asset('js/frontend-js/easyzoom.js')}}"></script>
	<script>		$(document).ready(function(){
		$(".changeImage").click(function(){
		var image= $(this).attr('src');	
		$(".mainImage").attr("src",image);
		});
	
// Instantiate EasyZoom instances
		var $easyzoom = $('.easyzoom').easyZoom();

		// Setup thumbnails example
		var api1 = $easyzoom.filter('.easyzoom--with-thumbnails').data('easyZoom');

		$('.thumbnails').on('click', 'a', function(e) {
			var $this = $(this);

			e.preventDefault();

			// Use EasyZoom's `swap` method
			api1.swap($this.data('standard'), $this.attr('href'));
		});

		// Setup toggles example
		var api2 = $easyzoom.filter('.easyzoom--with-toggle').data('easyZoom');

		$('.toggle').on('click', function() {
			var $this = $(this);

			if ($this.data("active") === true) {
				$this.text("Switch on").data("active", false);
				api2.teardown();
			} else {
				$this.text("Switch off").data("active", true);
				api2._init();
			}
		});

		});
	</script>
	@endsection

	
	