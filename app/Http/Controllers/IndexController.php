<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use App\Banner;

class IndexController extends Controller
{
	public function index()
	{
		$productsAll=Product::inRandomOrder()->where('status',1)->where('feature_item',1)->paginate(3);
		$categories=Category::with('categories')->where(['parent_id'=>0])->get();
		//$categories=json_decode(json_decode($categories));
		//echo "<pre>"; print_r($categories); die;

		/*$categories_menu="";
		foreach($categories as $cat)
		{
			
			$categories_menu.="<div class='panel-heading'>
									<h4 class='panel-title'>
										<a data-toggle='collapse' data-parent='#accordian' href='#".$cat->id."'>
											<span class='badge pull-right'><i class='fa fa-plus'></i></span>
											".$cat->name."
										</a>
									</h4>
								</div>
								<div id='".$cat->id."' class='panel-collapse collapse'>
									<div class='panel-body'>
										<ul>";
										$sub_categories=Category::where(['parent_id'=>$cat->id])->get();
										foreach($sub_categories as $subcat)
											{
												$categories_menu.="<li><a href='".$subcat->url."'><strong>".$subcat->name."</strong> </a></li>";
											}
											
											
									$categories_menu.="	</ul>
									</div>
								</div>";
			
		}*/
		$banners=Banner::where('status','1')->get();

		//meta tags
		$meta_title="E-Commerce Website";
		$meta_description="Online Shopping Site for Men, Women and Kids Clothing";
		$meta_keywords="e-shop website,online shopping,men clothing";

		   return view('index')->with(compact('productsAll','categories','meta_title','meta_description','meta_keywords','banners'));
	}
 
}
