<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;

class CategoryController extends Controller
{
    public function addCategory(Request $request)
    {
    	if($request->isMethod('post')){
    		$data=$request->all();
    		//echo "<pre>"; print_r($data); die;
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
    		$category=new Category;
    		$category->name=$data['category_name'];
    		$category->parent_id=$data['parent_id'];
    		$category->description=$data['description'];
    		$category->url=$data['url'];
            $category->meta_title=$data['meta_title'];
            $category->meta_description=$data['meta_description'];
            $category->meta_keywords=$data['meta_keywords'];
            $category->status=$status;
    		$category->save();
    		return redirect('/admin/view-category')->with('flash_success_message','New Category has Been Added');

    	}
    	$levels=Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.add_category')->with(compact('levels'));
    }
  
    public function editCategory(Request $request,$id=null)
    {
    	if($request->isMethod('post')){
    		$data=$request->all();
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
    		
    		//echo "<pre>"; print_r($data); die;
    		$category=Category::find($id);
    		$category->name=$data['category_name'];
    		$category->description=$data['description'];
    		$category->parent_id=$data['parent_id'];
    		$category->url=$data['url'];
            $category->meta_title=$data['meta_title'];
            $category->meta_description=$data['description'];
            $category->meta_keywords=$data['meta_keywords'];
            $category->status=$status;
    		$category->update();

    		return redirect('/admin/view-category')->with('flash_success_message','Edited Has Been Successfully');
    	}
    	$categoryDetails=Category::find($id);
    	$levels=Category::where(['parent_id'=>0])->get();
    	return view('admin.categories.edit-category')->with(compact('categoryDetails','levels'));	
    }
    public function deleteCategory($id=null)
    {
    	
    $category=Category::find($id);
    $category->delete();
    return redirect()->back()->with('flash_success_message','Category has been deleted Successfully');
    
    }

    public function viewCategories()
    {
    	$categories=Category::get();
    	
        
    	return view('admin.categories.view-categories')->with(compact('categories','levels'));
    	
    }


}
