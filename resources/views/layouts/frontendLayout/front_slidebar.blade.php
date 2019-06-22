<?php use App\Product;?>
<form action="{{url('/products-filter') }}" method="POST">
	<input type="hidden" name="_token" value="{{csrf_token()}}">
		@if(!empty($url))
	<input type="hidden" value="{{ $url }}" name="url" >
	@endif
			<div class="left-sidebar">
						<h2>Category</h2>
					<div class="panel-group category-products" id="accordian"><!--category-productsr-->
							@foreach($categories as $cat)
						 @if($cat->status=="1")
							<div class="panel panel-default">
								<div class="panel-heading">
									<h4 class="panel-title">
										<a data-toggle="collapse" data-parent="#accordian" href="#{{$cat->id}}">
											<span class="badge pull-right"><i class="fa fa-plus"></i></span>
											{{$cat->name}}
										</a>
									</h4>
								</div>

								<div id="{{$cat->id}}" class="panel-collapse collapse">
									<div class="panel-body">
										<ul>
											@foreach($cat->categories as $subcat)
											<?php $productCount=Product::productCount($subcat->id);?>
											@if($subcat->status=="1")
											<li><a href="{{asset('/products/'.$cat->url)}}">{{$subcat->name}} </a>({{$productCount}})</li>
											@endif
											@endforeach
										</ul>
									</div>
								</div>
							</div>
							@endif
							@endforeach
					</div>
					@if(!empty($url))
					<h2>Colour</h2>
					<div class="panel-group category-products">
						
							@foreach($colorArray as $color)
								@if(!empty($_GET['color']))
									<?php $colorArr=explode('-', $_GET['color']); ?>
											@if(in_array($color,$colorArr))
														<?php $colorcheck="checked"; ?>
														@else
														<?php $colorcheck=""; ?> 
											@endif			

							@else
								<?php $colorcheck=""; ?> 
							@endif

								<div class="panel panel-default">
									<div class="panel-heading">
									<h4 class="panel-title">
										<input type="checkbox" name="colorFilter[]" onchange="javascript:this.form.submit();" value="{{$color}}"  id="{{$color}}" {{$colorcheck}}>
										&nbsp;&nbsp;&nbsp;<span class="products-colors">{{$color}}</span>
									</h4>
									</div>
								</div>
							@endforeach 
					</div>
					@endif
			</div>
		</form>