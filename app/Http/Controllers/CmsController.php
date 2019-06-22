<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\CmsPage;
use App\Category;
use Illuminate\Support\Facades\Mail;
use Validator;


class CmsController extends Controller
{
    public function addCmsPage(Request $request){
    	if($request->isMethod('post'))
    	{
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;
    		$cmspage=new CmsPage;
    		$cmspage->title=$data['title'];
    		$cmspage->description=$data['description'];
    		$cmspage->url=$data['url'];
    		
    		if(empty($data['status']))
    		{
    			$status=0;
    		}else{
    			$status=1;
    		}
    		if(empty($data['meta_title']))
    		{
    			$data['meta_title']="";
    		}
    		if(empty($data['meta_description']))
    		{
    			$data['meta_description']="";
    		}
    		if(empty($data['meta_keywords']))
    		{
    			$data['meta_keywords']="";
    		}
    		$cmspage->meta_title=$data['meta_title'];
    		$cmspage->meta_description=$data['meta_description'];
    		$cmspage->meta_keywords=$data['meta_keywords'];
    		$cmspage->status=$status;
    		$cmspage->save();
    		return redirect('/admin/view-cms-pages')->with('flash_success_message','New CMS pages has been added successfully');
    	}
    	return view('admin.pages.add_cms_page');
    }
    public function viewCmsPages($id=null)
    {
    	$cmsPages=CmsPage::get();
    	$cmsPages=json_decode(json_encode($cmsPages));
    		// /echo "<pre>"; print_r($cmsPages); die;

    	return view('admin.pages.view_cms_pages')->with(compact('cmsPages'));
    }
    public function editCmsPage($id=null,Request $request){
    	if($request->isMethod('post'))
    	{
    		$data=$request->all();
    		if(empty($data['meta_title']))
    		{
    			$data['meta_title']="";
    		}
    		if(empty($data['meta_description']))
    		{
    			$data['meta_description']="";
    		}
    		if(empty($data['meta_keywords']))
    		{
    			$data['meta_keywords']="";
    		}
    		if(empty($data['status']))
    		{
    			$status=0;
    		}else
    		{
    			$status=1;
    		}
    		//echo "<pre>"; print_r($data); die; 
    		CmsPage::where('id',$id)->update(['title'=>$data['title'],'description'=>$data['description'],'url'=>$data['url'],'meta_title'=>$data['meta_title'],'meta_description'=>$data['meta_description'],'meta_keywords'=>$data['meta_keywords'],'status'=>$status]);
    		return redirect('/admin/view-cms-pages')->with('flash_success_message','CMS pages has been Updated successfully');
    	}
    	$cmsPage=CmsPage::where('id',$id)->first();
    	return view('admin.pages.edit_cms_page')->with(compact('cmsPage'));
    }
    public function deleteCmsPage($id=null)
    {
    	$deleteCmsPage=CmsPage::find($id);
    	$deleteCmsPage->delete();
    	return redirect('/admin/view-cms-pages')->with('flash_success_message','CMS pages has been Deleted  successfully');
    }
    public function cmsPage($url)
    {
    	//check if cmsPage is diabled or enabled
    	$cmsPageCount=CmsPage::where(['url'=>$url,'status'=>1])->count();
    	if($cmsPageCount>0){
    		  	$cmsPageDetails=CmsPage::where('url',$url)->first();
    		  	$meta_title=$cmsPageDetails->meta_title;
    		  	$meta_description=$cmsPageDetails->meta_description;
    		  	$meta_keywords=$cmsPageDetails->meta_keywords;
    	}else{
    		abort(404);
    	}

    	$categories_menu="";
  
    	$categories=Category::with('categories')->where(['parent_id'=>0])->get();


    	return view('pages.cms_page')->with(compact('cmsPageDetails','categories','meta_title','meta_description','meta_keywords'));
    	}

    	public function contact(Request $request){
    		if($request->isMethod('post'))
    		{
    			$data=$request->all();
    			//echo "<pre>"; print_r($data); die;
				$validator=Validator::make($request->all(),[
					'name'=>'required|regex:/^[\pL\s\-]+$/u|max:200',
					'email'=>'email|unique:users,email',
					'subject'=>'required',
				]);
				if($validator->fails()){
					return redirect()->back()->withErrors($validator)->withInput();
				}

    			$email="shresthasaurav77@yopmail.com";
    			$messageData=[
    				'name'=>$data['name'],
    				'email'=>$data['email'],
    				'subject'=>$data['subject'],
    				'comment'=>$data['message']

    			];
    			Mail::send('emails.enquiry',$messageData,function($message)use($email){
    				$message->to($email)->subject('Enquiry From Ecommerce');
    			});
    			return redirect()->back()->with('flash_success_message','Thank you for your enquiry.We will get back to you soon');
    		}
    	$categories_menu="";
  		$categories=Category::with('categories')->where(['parent_id'=>0])->get();

  		$meta_title="Contact Us|E-Commerce Website";
		$meta_description="Contact us for any queries related to our products ";
		$meta_keywords="contactus,queries";
  		return view('pages.contact')->with(compact('categories','meta_title','meta_description','meta_keywords'));
    	}
    
}
