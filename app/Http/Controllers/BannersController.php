<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Banner;
use Image;

class BannersController extends Controller
{
    public function addbanner(Request $request){
    	if($request->isMethod('post'))
    	{
    		$data=$request->all();
    		$banner=new Banner;
    		$banner->title=$data['title'];
    		$banner->link=$data['link'];
    		if(empty($data['status']))
            {
                $status=0;
            }else{
                $status=1;
            }
            $banner->status=$status;


    			 $image_tmp=Input::file('image'); 
    			if($image_tmp->isValid()){
    				$extension=$image_tmp->getClientOriginalName();
    				$filename=rand(111,99999).'.'.$extension;
    				$banner_path='img/frontend-img/banners/'.$filename;
    				
    				 
    				 Image::make($image_tmp)->resize(1140,340)->save($banner_path);

    				 $banner->image=$filename;
    			}

    			$banner->save();
    			return redirect('/admin/view-banner')->with('flash_success_message','New Banner Has Been Add Succesfully');
    		}
    		return view('admin.banners.add_banner');
    	}

    	public function editBanner(Request $request,$id=null)
    	{
    		if($request->isMethod('post'))
    		{
    			 if(empty($data['status']))
            {
                $data['status']=0;
            }
    			if(empty($data['link']))
    			{
    				$data['link']="";
    			}
    			if(empty($data['title']))
    			{
    				$data['title']="";
    			}

    			$data=$request->all();
    			//echo "<pre>"; print_r($data); die;
    			if($request->hasFile('image')){
                $image_tmp=Input::file('image');
                if($image_tmp->isValid()){
                    $extension=$image_tmp->getClientOriginalName();
                    $filename=rand(111,99999).'.'.$extension;
                    
                    $banner_path='img/frontend-img/banner/'.$filename;
                     
                     Image::make($image_tmp)->resize(1140,340)->save($banner_path);

                     
                }
            }elseif (!empty($data['current_image'])) {
            	# code...
            	 $filename=$data['current_image'];
            }
            else{
               $filename="";
            }
            Banner::where('id',$id)->update(['status'=>$data['status'],'title'=>$data['title'],'link'=>$data['link'],'image'=>$filename]);
            return redirect('/admin/view-banner')->with('flash_success_message','Banner Has Been edited Successfully');
    		}
    		
        $bannerDetails=Banner::where('id',$id)->first();
        return view('admin.banners.edit_banner')->with(compact('bannerDetails'));

    	}
    	
    	public function viewbanner($id=null)
    	{
    		$banners=Banner::get();
    	return view('admin.banners.view_banner')->with(compact('banners'));
    	}
    	public function deleteBanner($id=null)
    	{
    		$banner=Banner::find($id);
    	$banner->delete();
    	return redirect('admin/view-banner')->with('flash_success_message','Banner has been Deleted Succesfully');
    	}
}
