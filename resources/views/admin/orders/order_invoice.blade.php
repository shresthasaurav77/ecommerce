<link href="//netdna.bootstrapcdn.com/bootstrap/3.1.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//netdna.bootstrapcdn.com/bootstrap/3.1.0/js/bootstrap.min.js"></script>
<script src="//code.jquery.com/jquery-1.11.1.min.js"></script>
<!------ Include the above in your HEAD tag ---------->

<div class="container">
    <div class="row">
        <div class="col-xs-12">
    		<div class="invoice-title">
    			<h2>Invoice</h2><h3 class="pull-right">Order # {{$orderDetails->id}}</h3>
    		</div>
    		<hr>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    				<strong>Billed Address:</strong><br>
    				        {{$userDetails->name}}<br>
    				            {{$userDetails->address}}<br>
    					{{$userDetails->city}}<br>
    					{{$userDetails->state}}<br>
                        {{$userDetails->country}}<br>
                        {{$userDetails->pincode}}<br>
                        {{$userDetails->mobile}}
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
        			<strong>Shipped Address:</strong><br>
    					{{$orderDetails->name}}<br>
                                {{$userDetails->address}}<br>
                        {{$orderDetails->city}}<br>
                        {{$orderDetails->state}}<br>
                        {{$orderDetails->country}}<br>
                        {{$orderDetails->pincode}}<br>
                        {{$orderDetails->mobile}}

    				</address>
    			</div>
    		</div>
    		<div class="row">
    			<div class="col-xs-6">
    				<address>
    					<strong>Payment Method:</strong><br>
    					{{$orderDetails->payment_method}}<br>
    				
    				</address>
    			</div>
    			<div class="col-xs-6 text-right">
    				<address>
    					<strong>Order Date:</strong><br>
    					{{date('j M , Y ', strtotime($orderDetails->created_at)) }}<br><br>
    				</address>
    			</div>
    		</div>
    	</div>
    </div>
    
    <div class="row">
    	<div class="col-md-12">
    		<div class="panel panel-default">
    			<div class="panel-heading">
    				<h3 class="panel-title"><strong>Order summary</strong></h3>
    			</div>
    			<div class="panel-body">
    				<div class="table-responsive">
    					<table class="table table-condensed">
    						<thead>
                                <tr>
        							<td ><strong>Product Code</strong></td>
        							<td style="width:22%" class="text-center"><strong>Product Name</strong></td>
        							<td style="width:22%" class="text-center"><strong>Product Size</strong></td>
        							<td style="width:22%" class="text-right"><strong>Product Colour</strong></td>
                                    <td style="width:22%" class="text-center"><strong>Product Price</strong></td></strong></td>
                                    <td style="width:22%" class="text-center"><strong>Quantity</strong></td>
                                    <td class="text-right"><strong>Totals</strong></td>
                                </tr>
    						</thead>
    						<tbody>
    							<!-- foreach ($order->lineItems as $line) or some such thing here -->
                                <?php $Subtotal=0; ?>
                                @foreach($orderDetails->orders as $pro)
    							<tr>
    								<td>{{$pro->product_code}}</td>
    								<td class="text-center">{{$pro->product_name}}</td>
    								<td class="text-center">{{$pro->product_size}}</td>
    								<td class="text-center">{{$pro->product_color}}</td>
                                    <td class="text-center">{{$pro->product_price}}</td>
                                    <td class="text-center">{{$pro->product_qty}}</td>
                                    <td class="text-right">{{$pro->product_price * $pro->product_qty}}</td>
    							</tr>
                                @endforeach
                                <?php $Subtotal=$Subtotal+($pro->product_price*$pro->product_qty); ?>
                               <tr>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line"></td>
                                    <td class="thick-line text-center"><strong>Subtotal</strong></td>
                                    <td class="thick-line text-right">Rs  <?php echo $Subtotal;?></td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Shipping(+)</strong></td>
                                    <td class="no-line text-right">Free</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Discount(-)</strong></td>
                                    <td class="no-line text-right">Rs {{$orderDetails->coupon_amount}}</td>
                                </tr>
                                <tr>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line"></td>
                                    <td class="no-line text-center"><strong>Total</strong></td>
                                    <td class="no-line text-right">{{$orderDetails->grand_total}}</td>
                                </tr>

                              
    						</tbody>
    					</table>
    				</div>
    			</div>
    		</div>
    	</div>
    </div>
</div>