<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use Session;
use App\Category;
use App\product;
use App\ProductsAttribute;
use Illuminate\Support\Facades\Input;
use Image;
use App\ProductsImage;
use DB;
use App\Coupon;
use App\User;
use App\Country;
use App\DeliveryAddress;
use App\Order;
use App\OrdersProduct;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redirect;

class ProductsController extends Controller
{
    public function addProduct(Request $request)
    { if($request->isMethod('post')){
            $data=$request->all();

            $product= new Product;
            $product->category_id=$data['category_id'];
            $product->product_name=$data['product_name'];
            $product->product_code=$data['product_code'];
            $product->product_color=$data['product_color'];
            if(!empty($data['description'])){
                $product->description=$data['description'];
            }else{
                $product->description='';
            }
            if(!empty($data['care'])){
                $product->care=$data['care'];
            }else{
                $product->care='';
            }
            
            $product->price=$data['price'];
            

            if($request->hasFile('image')){

                 $image_tmp=Input::file('image'); 
                if($image_tmp->isValid()){
                    $extension=$image_tmp->getClientOriginalName();
                    $filename=rand(111,99999).'.'.$extension;
                    $large_image_path='img/backend-img/products/large/'.$filename;
                    $medium_image_path='img/backend-img/products/medium/'.$filename;
                    $small_image_path='img/backend-img/products/small/'.$filename;

                     Image::make($image_tmp)->save($large_image_path);
                     Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                     Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                     $product->image=$filename;
                }
            }
              //Upload Video

              if($request->hasFile('video'))
            {
                $video_tmp=Input::file('video'); 
                $video_name=$video_tmp->getClientOriginalName(); 
                $video_path="videos/";
                $video_tmp->move($video_path,$video_name);
                $product->video=$video_name;
            }
            
            

            if(empty($data['status']))
            {
                $status=0;
            }else{
                $status=1;
            }
             if(empty($data['feature_item']))
            {
                $feature_item=0;
            }else{
                $feature_item=1;
            }

          
          
            $product->feature_item=$feature_item;
            $product->status=$status;
            $product->save();
                    return redirect('/admin/view-product')->with('flash_success_message','Product  Has Been Added in Careted');;
        } 
        //Catgories DropDown Start
        $categories=Category::where(['parent_id'=>0])->get();
        $categories_dropdown="<option selected disabled>Select</option>";
        foreach($categories as $cat)
         {
            $categories_dropdown .="<option value='".$cat->id."'>".$cat->name."</option>"; 
            $sub_categories=Category::where(['parent_id'=>$cat->id])->get();
            foreach($sub_categories as $sub_cat) 
            {
                $categories_dropdown .="<option value='".$sub_cat->id."'>&nbsp;--&nbsp;".$sub_cat->name."</option>";
            }   

        }
        //Categories DropDown end

        return view('admin.products.add-product')->with(compact('categories_dropdown'));
    }
    public function editProduct(Request $request,$id=null)
    {
        $productDetails=Product::find($id);



    	if($request->isMethod('post')){
    		$data=$request->all();

            //image
           if($request->hasFile('image')){
                $image_tmp=Input::file('image');
                if($image_tmp->isValid()){
                    $extension=$image_tmp->getClientOriginalName();
                    $filename=rand(111,99999).'.'.$extension;
                    $large_image_path='img/backend-img/products/large/'.$filename;
                    $medium_image_path='img/backend-img/products/medium/'.$filename;
                    $small_image_path='img/backend-img/products/small/'.$filename;
                     Image::make($image_tmp)->save($large_image_path);
                     Image::make($image_tmp)->resize(600,600)->save($medium_image_path);
                     Image::make($image_tmp)->resize(300,300)->save($small_image_path);

                     
                }
            }else{
                $filename=$data['current_image'];
            }
            //Upload Video
            if($request->hasFile('video'))
            {
                $video_tmp=Input::file('video'); 
                $video_name=$video_tmp->getClientOriginalName(); 
                $video_path="videos/";
                $video_tmp->move($video_path,$video_name);
                $videoName=$video_name;
            }
            else
            {
                $videoname="";
            }



    		 $product=Product::find($id);
    		 $product->product_name=$data['product_name'];
    		 $product->category_id=$data['category_id'];
    		 $product->product_color=$data['product_color'];
    		 $product->product_code=$data['product_code'];
    		 $product->description=$data['description'];
    		 $product->price=$data['price'];
             $product->care=$data['care'];
             $product->image=$filename;
       
             if(empty($data['status']))
             {
                $status=0;
             }else{
                $status=1;
             }
             if(empty($data['feature_item']))
            {
                $feature_item=0;
            }else{
                $feature_item=1;
            }
            if(empty($data['videoName']))
            {
                $videoName="";
            }
                  $product->video=$videoName;
            $product->feature_item=$feature_item;
             $product->status=$status;


    		 $product->update();
    		  return redirect('/admin/view-product')->with('flash_success_message','Your edited has been Successfully');
    	}




    	
    	//Categories DropwDown Start
    	$categories=Category::where(['parent_id'=>0])->get();
    	$categories_dropdown="<option selected disabled>Select</option>";

    	foreach($categories as $cat)
    	{
    		if($cat->id==$productDetails->category_id){
    			$selected="selected";
    		}else{
    			$selected="";
    		}
    		$categories_dropdown .="<option value='".$cat->id."' ".$selected.">".$cat->name."</option>";
    		$sub_categories=Category::where(['parent_id'=>$cat->id])->get();
    		foreach($sub_categories as $sub_cat)
    		{
    			if($sub_cat->id==$productDetails->category_id){
    				$selected="selected";
    			}else{
    				$selected="";
    			}
    			$categories_dropdown .="<option value='".$sub_cat->id."' ".$selected.">&nbsp;--&nbsp;".$sub_cat->name."</option>";
    		}

    	}
    	//Categories DropDown Stop
		return view('admin.products.edit-product')->with(compact('productDetails','categories_dropdown'));
    }
    public function deleteProductImage($id=null)
    {
        $productImage=Product::where(['id'=>$id])->first();
        //echo $productImage; die;
        $large_image_path='img/backend-img/products/large';
        $medium_image_path='img/backend-img/products/medium';
        $small_image_path='img/backend-img/products/small';
        if(file_exists( $large_image_path.$productImage->image))
        {
            unlink($large_image_path.$productImage->image);
        }
        if(file_exists( $small_image_path.$productImage->image))
        {
            unlink($medium_image_path.$productImage->image);
        }
        if(file_exists( $small_image_path.$productImage->image))
        {
            unlink($small_image_path.$productImage->image);
        }
        Product::where(['id'=>$id])->update(['image'=>'']);
        return redirect()->back()->with('flash_success_message','Product Images Has Been Successfully Deleted');

    }
    public function deleteProductVideo($id=null)
    {
        //Get Video Name
        $productVideo=Product::select('video')->where('id',$id)->first();
        //Video Path
        $video_path='videos/';
        //Delete Video if it exists in videos folders
        if(file_exists($video_path.$productVideo->video))
        {
            unlink($video_path.$productVideo->video);
        }
        Product::where(['id'=>$id])->update(['video'=>'']);
         return redirect()->back()->with('flash_success_message','Product Videos  Has Been Successfully Deleted');

    }
    public function deleteProduct($id=null)
    {
    	$product=Product::find($id);
    	$product->delete();
    	return redirect()->back()->with('flash_success_message','Your Product Has Been Deleted Successfully!!');
    }


    public function viewProduct()
    {
    	$products=Product::orderBy('id','DESC')->get();
    	$products=json_decode(json_encode($products));
    	
    	foreach($products as $key => $val){
            $category_name = Category::where(['id'=>$val->category_id])->first();
            $products[$key]->category_name = $category_name->name;
        }
 

    	return view('admin.products.view-product')->with(compact('products'));
    }
     public function addAttributes(Request $request,$id=null)
   {
        $productDetails=Product::with('attributes')->where(['id'=>$id])->first();




         if($request->isMethod('post')){
            $data=$request->all();
             //echo "<pre>"; print_r($data); die;

          foreach($data['sku'] as $key=>$val){
            if(!empty($val))
            {
                //SKU Check
                $attrCountSkU=ProductsAttribute::where('sku',$val)->count();
                if($attrCountSkU>0)
                {
                    return redirect('admin/add-attributes/'.$id)->with('flash_error_message','Sorry!!SKu Already Exits !! Please Add Another');
                }
                //Size Check
                $attrCountSize=ProductsAttribute::where(['product_id'=>$id,'size'=>$data['size'][$key]])->count();
                if($attrCountSize>0){
                         return redirect('admin/add-attributes/'.$id)->with('flash_error_message','Size Already Exits Please Add Another Size');
                }
                $attribute=new ProductsAttribute;
                $attribute->product_id =$id;
                $attribute->sku=$val;
                $attribute->size=$data['size'][$key];
                $attribute->price=$data['price'][$key];
                $attribute->stock=$data['stock'][$key];
                $attribute->save();
            }
          }
            return redirect('admin/add-attributes/'.$id)->with('flash_success_message','Product Attributes has been added successfully');
   }

        return view('admin.products.add-attributes')->with(compact('productDetails'));
     }
     public function editAttributes(Request $request,$id=null)
     {
        if($request->isMethod('post')){
            $data=$request->all();
            // /echo"<pre>"; print_r($data); die;
          
            foreach($data['idAttr'] as $key => $attr){
                ProductsAttribute::where(['id'=>$data['idAttr'][$key]])->update(['price'=>$data['price'][$key],'stock'=>$data['stock'][$key]]);
            }
            return redirect()->back()->with('flash_success_message','Products Atrributes Has been Update');
        }

     }

     public function deleteProductAttribute($id=null)
     {
        $attribute=ProductsAttribute::find($id);
        $attribute->delete();
        return redirect()->back()->with('flash_success_message','Your Product attribute has been Deleted succesfully');
     }

     public function products($url=null)
     {
     $countCategory=Category::where(['url'=>$url,'status'=>1])->count();
     if($countCategory==0){
        abort(404);
     }

        //Get all Categories and Sub Categories
       $categories=Category::with('categories')->where(['parent_id'=>0])->get();

        $categoryDetails=Category::where(['url'=>$url])->first();
        if($categoryDetails->parent_id==0)
        {
            //If Url is main category url
            $subCategories=Category::where(['parent_id'=>$categoryDetails->id])->get();
            foreach($subCategories as $subcat){
                $cat_ids[]=$subcat->id;
            }
            $productsAll=Product::whereIn('category_id',$cat_ids)->where('status','1')->orderBy('id','DESC');
            //$productsAll=json_decode(json_encode($productsAll));

        }else{
            //If url is subcategory url
            $productsAll=Product::where(['category_id'=>$categoryDetails->id])->where('status',1)->orderBy('id','DESC');
        }
            if(!empty($_GET['color'])){
                $colorArray=explode('-',$_GET['color']);
                $productsAll=$productsAll->whereIn('product_color',$colorArray);
            }
            $productsAll=$productsAll->paginate(5);

           // $colorArray=array('Black','Blue','Green','Brown','Gold','Green','Orange','White','Purple','Red','Silver','Yellow');
            $colorArray=Product::select('product_color')->groupBy('product_color')->get();
            $colorArray=array_flatten(json_decode(json_encode($colorArray),true));
            /*echo "<pre>"; print_r($colorArray); die; */

            $meta_title=$categoryDetails->product_name;
            $meta_description=$categoryDetails->description;
            $meta_keywords=$categoryDetails->product_name;


        return view('products.listing')->with(compact('categories','categoryDetails','meta_keywords','meta_title','meta_description','url','productsAll','colorArray'));

     }

     public function filter(Request $request)
    {
       
        $data= $request->all();
        //echo "<pre>"; print_r($data); die;
         $colorUrl="";
            if(!empty($data['colorFilter'] )){
                foreach($data['colorFilter'] as $color){
                    if(empty($colorUrl)){
                        $colorUrl="&color=".$color;
                            }
                            else{
                                $colorUrl.="-".$color;
                    }
                }
            

            }
            $finalUrl="products/".$data['url']."?".$colorUrl;
            return redirect::to($finalUrl );
    }

      public function searchProducts(Request $request)
     {
        if($request->isMethod('post')){
           
            $data=$request->all();
            //echo "<pre>"; print_r($data); die;
            $categories=Category::with('categories')->where(['parent_id'=>0])->get();
            
            $search_products=$data['product'];
            
            //$productsAll=Product::where('product_name','like','%'.$search_products.'%')->orwhere('product_code',$search_products)->where('status',1)->get();
            $productsAll=Product::where(function($query)use($search_products){
                $query->where('product_name','like','%'.$search_products.'%')
                ->orWhere('product_code','like','%'.$search_products.'%')
                ->orWhere('product_color','like','%'.$search_products.'%')
                ->orWhere('description','like','%'.$search_products.'%');
            })->where('status',1)->get();
            return view('products.listing')->with(compact('categories','search_products','productsAll'));
        }
     }

     public function product($id=null)
     { 
        $productsCount=Product::where(['id'=>$id,'status'=>1])->count();
        if($productsCount==0){
            abort(404);
        }
        //Get Product Details
        $productDetails=Product::with('attributes')->where('id',$id)->first();
        $productDetails=json_decode(json_encode($productDetails));
        /*echo "<pre>"; print_r($productDetails); die;*/
        //Get all Categories and SUbcatgories
        $relatedProducts=Product::where('id','!=',$id)->where(['category_id'=>$productDetails->category_id])->get();
        //$relatedProducts=json_decode(json_encode($relatedProducts));
        //echo "<pre>"; print_r($relatedProducts); die;
       
        $categories=Category::with('categories')->where(['parent_id'=>0])->get();
         $productsImages=productsImage::where(['product_id'=>$id])->get();
         /*$productsImages=json_decode(json_encode($productsImages));
         echo "<pre>"; print_r($productsImages); */
            $total_stock=ProductsAttribute::where('product_id',$id)->sum('stock'); 
            $meta_title=$productDetails->product_name;
            $meta_description=$productDetails->description;
            $meta_keywords=$productDetails->product_name;

      
        return view('products.detail')->with(compact('categories','productDetails','productsImages','total_stock','relatedProducts','productsCount','meta_title','meta_description','meta_keywords'));
     }
     public function getProductPrice(Request $request)
     {
        $data=$request->all();
        /*echo "<pre>"; print_r($data); die;*/
        $proArr=explode("-", $data['idSize']);

       
        $proAttr=ProductsAttribute::where(['product_id'=>$proArr[0],'size'=>$proArr[1]])->first();
       

        echo $proAttr->price; 
        echo "#";

        echo $proAttr->stock;
     
    }
    public function addImages(Request $request,$id=null)
    {
       $productDetails=Product::with('attributes')->where(['id'=>$id])->first();
       if($request->isMethod('post'))
       {
        $data=$request->all();

        if($request->hasFile('image'))
            {
            $files=$request->file('image');
            foreach($files as $file){

          /*  echo "<pre>"; print_r($files); die;*/
            $image= new ProductsImage;
            $extension=$file->getClientOriginalName();
            $filename=rand(111,99999).'.'.$extension;

                    $large_image_path='img/backend-img/products/large/'.$filename;
                    $medium_image_path='img/backend-img/products/medium/'.$filename;
                    $small_image_path='img/backend-img/products/small/'.$filename;
                     Image::make($file)->save($large_image_path);
                     Image::make($file)->resize(600,600)->save($medium_image_path);
                     Image::make($file)->resize(300,300)->save($small_image_path);
                     $image->image=$filename;
                     $image->product_id=$data['product_id'];
                     $image->save();

            }
          

            }

            return redirect('/admin/add-images/'.$id)->with('flash_success_message','Prodcut Images  Has been Succesfully Added');
        }

        $productsImages=productsImage::where(['product_id'=>$id])->get();

        return view('admin.products.add-images')->with(compact('productDetails','productsImages'));

    }
    public function deleteAltImage($id=null)
    {
        $productsImages=productsImage::find($id);
        $productsImages->delete();
        return redirect()->back()->with('flash_success_message','Images has been deleted succesfully');
    }

    public function addtocart(Request $request)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        $data=$request->all();
       // / echo "<pre>"; print_r($data); die;
        $product_size=explode("-", $data['size']);

        $getProductStock=ProductsAttribute::where(['product_id'=>$data['product_id'],'size'=>$product_size[1]])->first();
       // echo $getProductStock->stock; die;
// /echo $getProductStock->stock; die;
        if($getProductStock->stock<$data['quantity'])
        {
            return redirect()->back()->with('flash_error_message','Required Quantity is not Avail');
        }

        if(empty(Auth::user()->email))
        {
            $data['user_email']="";
        }
        else{
            $data['user_email']=AUth::user()->email;
        }


        $session_id=Session::get('session_id');
        if(empty($session_id))
        {
          $session_id=str_random(40); 
         Session::put('session_id',$session_id);  
        }
         
        
        if(empty($data['session_id']))
        {
            $data['session_id']="";
        }
        $sizeArr=explode("-",$data['size']);

        $countProducts=DB::table('cart')->where(['product_id'=>$data['product_id'],'product_color'=>$data['product_color'],'size'=>$sizeArr[1],'session_id'=>$session_id])->count();
        //echo $countProducts; die;
        if($countProducts>0)
        {
                return redirect()->back()->with('flash_error_message','Sorry!!! Products Already Exits in Cart');
        }else {
            $getSKU=ProductsAttribute::select('sku')->where(['product_id'=>$data['product_id'],'size'=>$sizeArr[1]])->first();

            DB::table('cart')->insert(['product_id'=>$data['product_id'],'product_name'=>$data['product_name'],'product_code'=>$getSKU->sku,'product_color'=>$data['product_color'],'price'=>$data['price'],'size'=>$sizeArr[1],'quantity'=>$data['quantity'],'user_email'=>$data['user_email'],'session_id'=>$session_id]);

        }


        
      
        return redirect('/cart')->with('flash_success_message','Product  Has Been Added in Carted Succesffully');
    }

    public function cart()
    {
       
        $session_id=Session::get('session_id');
        $userCart=DB::table('cart')->where(['session_id'=>$session_id])->get();
        foreach($userCart as $key =>$product)
        {
            $productDetails=Product::where('id',$product->product_id)->first();
            $userCart[$key]->image=$productDetails->image;
        }
        $meta_title="Shopping Cart-E-com Website";
        $meta_description="View Shopping Cart of Ecommerce Website";
        $meta_keywords="Shopping Cart-Ecommerce Website";
        //echo "<pre"; print_r($userCart); die;
        return view('products.cart')->with(compact('userCart','meta_title','meta_description','meta_keywords','productDetails'));
    }
    public function deleteCartProduct($id=null)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
        DB::table('cart')->where('id',$id)->delete();
        return redirect('/cart')->with('flash_success_message','Product Has Been Deleted from Carted Succesffully');
    }

    public function updateCartQuantity($id=null,$quantity=null)
    {
        Session::forget('CouponAmount');
        Session::forget('CouponCode');
            $getCartDetails=DB::table('cart')->where('id',$id)->first();
            $getAttributeStock=ProductsAttribute::where('sku',$getCartDetails->product_code)->first();
               //echo $getAttributeStock->stock; echo "and ";
            $updated_quantity=$getCartDetails->quantity+$quantity;

                if($getAttributeStock->stock>=$updated_quantity)
                {
                    DB::table('cart')->where('id',$id)->increment('quantity',$quantity);
            return redirect('/cart')->with('flash_success_message','Quantity Of product Has Been Update Successfully');
                }
                else
                {
                     return redirect('/cart')->with('flash_error_message','Sorry!!! Sorry Your Required Quantity is not available');
                }


            
    }
    public function applyCoupon(Request $request)
    {
        
        $data=$request->all();
        //echo "<pre>"; print_r($data); die;
        $couponCount=Coupon::where('coupon_code',$data['coupon_code'])->count();
        if($couponCount ==0)
        {
            return redirect()->back()->with('flash_error_message','Coupon does not exist');

        }else {
            // perform other check like Active or Inactive,Expiry Date,
            //Coupon Details
            $couponDetails=Coupon::where('coupon_code',$data['coupon_code'])->first();

            //If Coupon is Inactive
            if($couponDetails->status==0)
            {
                return redirect()->back()->with('flash_error_message','Sorry!!!This Coupon is not active');  
            }
            //If Coupon is Expired
         $expiry_date=$couponDetails->expiry_date; 
        $current_date=date('Y-m-d'); 
         if($expiry_date < $current_date)
         {
            return redirect()->back()->with('flash_error_message','Sorry !!! COupon Has Been Expired');
         }
     }
         //Coupon is Valid for discount
         //Get Cart Total Amount
         $session_id=Session::get('session_id');
         $userCart=DB::table('cart')->where(['session_id'=>$session_id])->get();
         $total_amount=0;
        foreach($userCart as $item)
        {
          $total_amount=$total_amount + ($item->price * $item->quantity);
        }

        //check if the amount type is valid or percentage
         if($couponDetails->amount_type=="fixed"){
            $couponAmount=$couponDetails->amount;
         }else{
            $couponAmount=$total_amount*($couponDetails->amount/100);
         }
         //Add Coupon Code And Amount in Session
         Session::put('CouponAmount',$couponAmount);
         Session::put('CouponCode',$data['coupon_code']);
         return redirect()->back()->with('flash_success_message','CouponCode Has Been succesfully Applies');

        

    }
    public function checkout(Request $request)
    {
        $user_id=Auth::user()->id;
        $user_email=Auth::user()->email;
        $userDetails=User::find($user_id);
        $countries=Country::get();

        //Check if SHipping Address exits
        $shippingCount= DeliveryAddress::where('user_id',$user_id)->count();
        $shippingDetails=array();
        if($shippingCount>0){
            $shippingDetails=DeliveryAddress::where('user_id',$user_id)->first();
        }
        //Update cart table with user email 
        $session_id=Session::get('session_id');
        DB::table('cart')->where(['session_id'=>$session_id])->update(['user_email'=>$user_email]) ;

        if($request->isMethod('post'))
      {

            $data=$request->all();
            //echo "<pre"; print_r($data); die;
            if(empty($data['billing_name']) || empty($data['billing_address']) || empty($data['billing_city']) || empty($data['billing_state']) || empty($data['billing_country']) || empty($data['billing_pincode']) || empty($data['billing_mobile']) || empty($data['shipping_name']) || empty($data['shipping_address']) || empty($data['shipping_city']) || empty($data['shipping_state']) || empty($data['shipping_country'])|| empty($data['shipping_pincode']) || empty($data['shipping_mobile']))
            {
                return redirect()->back()->with('flash_error_message','Please fill all field to CheckOut');
            }
            //Update User Details
            User::where('id',$user_id)->update(['name'=>$data['billing_name'],'address'=>$data['billing_address'],'city'=>$data['billing_city'],'state'=>$data['billing_state'],'country'=>$data['billing_country'],'pincode'=>$data['billing_pincode'],'mobile'=>$data['billing_mobile']]);
            
            if($shippingCount>0){
                //Update Shipping Address
                DeliveryAddress::where('user_id',$user_id)->update(['name'=>$data['shipping_name'],'address'=>$data['shipping_address'],'city'=>$data['shipping_city'],'state'=>$data['shipping_state'],'country'=>$data['shipping_country'],'pincode'=>$data['shipping_pincode'],'mobile'=>$data['shipping_mobile']]);
            }else{
                //Add New Shipping Address
                $shipping=new DeliveryAddress;
                $shipping->user_id=$user_id;
                $shipping->user_email=$user_email;
                $shipping->name= $data['shipping_name'];
                $shipping->address =$data['shipping_address'];
                $shipping->city=$data['shipping_city'];
                $shipping->state= $data['shipping_state'];
                $shipping->pincode= $data['shipping_pincode'];
                $shipping->country=$data['shipping_country'];
                $shipping->mobile=  $data['shipping_mobile'];
                $shipping->save();
            }
           return redirect()->action('ProductsController@orderReview'); 

        }
          
        return view('products.checkout')->with(compact('userDetails','countries','shippingDetails'));
    }
    public function orderReview(){
       $user_id=Auth::user()->id;
        $user_email=Auth::user()->email;
        $userDetails=User::where('id',$user_id)->first();
        $shippingDetails=DeliveryAddress::where('user_id',$user_id)->first();
        $shippingDetails=json_decode(json_encode($shippingDetails)); 
            $userCart=DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($userCart as $key =>$product){
                $productDetails=Product::where('id',$product->product_id)->first();
                $userCart[$key]->image=$productDetails->image;
            }
           // echo "<pre>"; print_r($userCart); die;
            $meta_title="Order Review - E-Commerce Website";



    
        return view('products.order_review')->with(compact('userDetails','meta_title','shippingDetails','userCart'));
    }
    public function placeOrder(Request $request)
    {
        if($request->isMethod('post')){
            $data=$request->all();
            $user_id=Auth::user()->id;
            $user_email=Auth::User()->email;
            //getting Shipping Address of User
            $shippingDetails=DeliveryAddress::where(['user_email'=>$user_email])->first();


            if(empty(Session::get('CouponCode'))){
                $coupon_code ='';
            }else{
                $coupon_code= Session::get('CouponCode');
            }
            
             if(empty(Session::get('CouponAmount'))){
                $coupon_amount="";
             }else{
                $coupon_amount=Session::get('CouponAmount');
             }
            

            
            $order=new Order;
            $order->user_id=$user_id;
            $order->user_email=$user_email;
            $order->name=$shippingDetails->name;
                $order->address=$shippingDetails->address;
            $order->city=$shippingDetails->city;
            $order->state=$shippingDetails->state;
            $order->pincode=$shippingDetails->pincode;
            $order->country=$shippingDetails->country;
            $order->mobile=$shippingDetails->mobile;
            $order->coupon_code=$coupon_code;
            $order->order_status="New";
            $order->coupon_amount=$coupon_amount;
            $order->payment_method=$data['payment_method'];
            $order->grand_total=$data['grand_total'];
            $order->save();

            $order_id=DB::getPdo()->lastInsertId();

            $cartProducts=DB::table('cart')->where(['user_email'=>$user_email])->get();
            foreach($cartProducts as $pro){
                $cartPro=new OrdersProduct;
                $cartPro->order_id=$order_id;
                $cartPro->user_id=$user_id;
                $cartPro->product_id=$pro->product_id;
                $cartPro->product_code=$pro->product_code;
                $cartPro->product_color=$pro->product_color;
                $cartPro->product_name=$pro->product_name;
                $cartPro->product_size=$pro->size;
                $cartPro->product_price=$pro->price;
            
                $cartPro->product_qty=$pro->quantity;
                $cartPro->save();

            }
                Session::put('order_id',$order_id);
                Session::put('grand_total',$data['grand_total']);
                /*Code for Order Email Start*/
             
                if($data['payment_method']=="COD"){
                    $productDetails=Order::with('orders')->where('id',$order_id)->first();
                    $productDetails=json_decode(json_encode($productDetails));
                    //echo "<pre>"; print_r($productDetails); die;

                    $userDetails=User::where('id',$user_id)->first();
                    $userDetails=json_decode(json_encode($userDetails));
                   // echo "<pre>"; print_r($userDetails); die;
                    
                     $email=$user_email;
                    $messageData =[
                    'email'=>$email,
                    'name'=>$shippingDetails->name,
                    'order_id'=>$order_id,
                    'productDetails'=>$productDetails,
                    'userDetails'=>$userDetails
                ];
                Mail::send('emails.order',$messageData,function($message) use($email){
                    $message->to($email)->subject('Order Placed - Ecommerce Website');
                });
                  return redirect('/thanks');   
              }else{
                return redirect('/paypal');
              }
               
           
        }
    }
    public function thanks(Request $request){
        $user_email=Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.thanks');

    }
    public function paypal(Request $request ){
        $user_email=Auth::user()->email;
        DB::table('cart')->where('user_email',$user_email)->delete();
        return view('orders.paypal');

    }
    public function userOrders(){
        $user_id=Auth::user()->id;
        $orders=Order::with('orders')->where('user_id',$user_id)->orderBy('id','DESC')->get(); 
        /*$orders=json_decode(json_encode($orders));
        echo "<pre>"; print_r($orders); die;*/
        return view('orders.user_orders')->with(compact('orders'));
    }
    public function userOrderDetails($order_id){
        $user_id = Auth::user()->id;
        $orderDetails=Order::with('orders')->where('id',$order_id)->first();
        $orderDetails=json_decode(json_encode($orderDetails));
        //echo "<pre>"; print_r($orderDetails); die;
        return view('orders.user_order_details')->with(compact('orderDetails'));
    }
    public function viewOrders()
    {
        $orders=Order::with('orders')->orderBy('id','DESC')->get();
        $orders=json_decode(json_encode($orders));
       // / echo "<pre>"; print_r($orders); die;
        return view('admin.orders.view-order')->with(compact('orders'));
    }
     public function vieworderDetails($order_id)
     {
         $orderDetails=Order::with('orders')->where('id',$order_id)->first();
        $orderDetails=json_decode(json_encode($orderDetails));
        //echo "<pre>"; print_r($orderDetails); die;
     $user_id=$orderDetails->user_id;
     $userDetails=User::where('id',$user_id)->first();
     $userDetails=json_decode(json_encode($userDetails));
     //echo "<pre>"; print_r($userDetails); die; 

        return view('admin.orders.order_details')->with(compact('orderDetails','userDetails'));
     }

     public function viewOrderInvoice($order_id){
        $orderDetails=Order::with('orders')->where('id',$order_id)->first();
        $orderDetails=json_decode(json_encode($orderDetails));
       // echo "<pre>"; print_r($orderDetails); die;
        $user_id=$orderDetails->user_id;
        $userDetails=User::where('id',$user_id)->first();
        $userDetails=json_decode(json_encode($userDetails));
        //echo "<pre>"; print_r($userDetails); die;
        return view('admin.orders.order_invoice')->with(compact('orderDetails','userDetails'));
     }

     public function updateOrderStatus(Request $request){
        if($request->isMethod('post')){
            $data=$request->all();
            Order::with('id',$data['order_id'])->update(['order_status'=>$data['order_status']]);
            return redirect()->back()->with('flash_success_message','Order Status has been Updated Successfully');
        }
     }
    



 }

