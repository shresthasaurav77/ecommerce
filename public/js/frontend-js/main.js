/*price range*/

 $('#sl2').slider();

	var RGBChange = function() {
	  $('#RGB').css('background', 'rgb('+r.getValue()+','+g.getValue()+','+b.getValue()+')')
	};	
		
/*scroll to top*/

$(document).ready(function(){
	$(function () {
		$.scrollUp({
	        scrollName: 'scrollUp', // Element ID
	        scrollDistance: 300, // Distance from top/bottom before showing element (px)
	        scrollFrom: 'top', // 'top' or 'bottom'
	        scrollSpeed: 300, // Speed back to top (ms)
	        easingType: 'linear', // Scroll to top easing (see http://easings.net/)
	        animation: 'fade', // Fade, slide, none
	        animationSpeed: 200, // Animation in speed (ms)
	        scrollTrigger: false, // Set a custom triggering element. Can be an HTML string or jQuery object
					//scrollTarget: false, // Set a custom target element for scrolling to the top
	        scrollText: '<i class="fa fa-angle-up"></i>', // Text for element, can contain HTML
	        scrollTitle: false, // Set a custom <a> title if required.
	        scrollImg: false, // Set true to use image
	        activeOverlay: false, // Set CSS color to display scrollUp active point, e.g '#00FFFF'
	        zIndex: 2147483647 // Z-Index for the overlay
		});
	});
});

//Replace Main Image with ALternate Image


$(document).ready(function(){
		$("#selSize").change(function(){
				var idSize = $(this).val();
				if(idSize=="")
				{
					return false;
				}
				$.ajax({
						type:'get',
						url:'/get-product-price',
						data:{idSize:idSize},
						success:function(resp){
							//alert(resp); return false;
							var arr=resp.split('#');
							
							$("#getPrice").html("₹"+arr[0]);
							$("#price").val(arr[0]);
							if(arr[1]==0)
							{
								$("#cartButton").hide();
								$("#Availabilty").text("Out Of Stock");
							}
							else{
										$("#cartButton").show();
								$("#Availabilty").text("In Stock");
							}
						}, 
						error:function(){
							alert("Error");
						}
				});

		});	

		

});

	

			$("#current_pwd").keyup(function(){
				var current_pwd=$(this).val();
				$.ajax({
					type:'get',
					url:'/check-user-pwd',
					data:{current_pwd:current_pwd},
					success:function(resp){
						if(resp=="false")
						{
						$("#chkPwd").html("<font color='red'>Current-Password is Incorrect</font>");
					}else if(resp=="true")
					{
						$("#chkPwd").html("<font color='green'>Current-Password is Correct</font>");
					}					
					},error:function(){
						alert('Error');
					}
				})
			})
		
	

		$().ready(function(){
			$('#myPassword').passtrength({
      minChars: 4,
      passwordToggle: true,
      tooltip: true,
      eyeImg : 'img/frontend-img/eye.svg'
});
			//Copying Billing Address To Shipping Address Script
			$("#billtoship").on('click',function(){
				if(this.checked){
				$('#shipping_name').val($("#billing_name").val());
			$('#shipping_address').val($("#billing_address").val());
			$('#shipping_city').val($("#billing_city").val());
			$('#shipping_state').val($("#billing_state").val());
			$('#shipping_country').val($("#billing_country").val());
			$('#shipping_pincode').val($("#billing_pincode").val());
			$('#shipping_mobile').val($("#billing_mobile").val());
			} else{
				$('#shipping_name').val(' ');
				$('#shipping_address').val(' ');
				$('#shipping_city').val(' ');
				$('#shipping_state').val(' ');
				$('#shipping_country').val(' ');
				$('#shipping_pincode ').val(' ');
				$('#shipping_mobile').val(' ');


			}

			});


		});

		
		
		function selectPayementMethod(){
			if($('#Paypal').is(':checked') || $('#COD').is(':checked')){
				/*alert("checked");*/
			}else{
				alert("Please Select Payment Method");
			return false;
		}
		}

	
		