<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use Illuminate\Http\Request;

class CategoryController extends Controller
{
   public function showAddCategory()
   {
       return view('category-add');
   }
   public function addCategory(Request $request)
   {
       $data= $request->validate(
           [
               'name'=>'required|unique:categories'
           ]
           );
       Category::create(
           [
               'name'=>$data['name']
           ]
           );
           return redirect('showCategoryList');

   }
   public function showCategoryList()
   {
       $data= Category::all();
       return view('category-list',['datas'=>$data]);
   }

   public function showCategoryedit($id)
   {
       $data= Category::where('id',$id)->first();
       return view('category-edit',['datas'=>$data]);
   }

   public function editCategory(Request $request)
   {
       $data= $request->validate([
           'name'=>'required|unique:categories'
       ]);
       $id= $request->id;
       Category::where('id',$id)->update(['name'=>$data['name']]);
       return redirect('showCategoryList');
   }

   public function deleteCategory(Category $category)
   {   
       $category->products()->delete();
       $category->delete();
       return redirect('showCategoryList');
   }
}
