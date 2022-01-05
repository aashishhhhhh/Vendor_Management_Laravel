<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\CategoryProduct;
use App\Models\Product;
use App\Models\ProductUser;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;

class ProductController extends Controller
{
   public function showAddProduct()
   {
       $data=Category::all();
       return view('product-add',['datas'=>$data]);   
   }

   public function addProduct(Request $request)
   {
        $data= $request->validate([
            'name'=>'required|unique:products',
            'quantity'=>'required'
        ]);
       

          $insert= Product::create([
            'name'=>$data['name'],
            'quantity'=>$data['quantity']
        ]);
        $p_id=$insert->id;
        $cat_id=$request['category'];
        $length= sizeof($cat_id);
        for ($i=0; $i<$length ; $i++) { 
              CategoryProduct::create([
            'product_id'=>$p_id,
            'category_id'=>$cat_id[$i]
        ]);
        }

        Transaction::create(
            [
                'product_id'=>$p_id,
                'quantity'=>$data['quantity'],
                'transaction_type'=>'IN'
            ]
            );
        return redirect('showProductList');
   }

   public function showProductList()
   {
       $data = Product::all();
       return view('product-list',['datas'=>$data]);
   }

   public function showProductedit($id)
   {
    $data= Product::where('id',$id)->first();
  
      return view('product-edit',['datas'=>$data]);
   }

   public function editProduct(Request $request)
   {
        $data= $request->validate([
            'name'=>'required',
            'quantity'=>'required'
        ]);
        $id= $request->id;
        Product::where('id',$id)->update([
            'name'=>$data['name'],
            'quantity'=>$data['quantity']
        ]);
        return redirect('showProductList');

   }
   public function deleteProduct($id)
   {
       $product= Product::find($id);
       $product->categories()->detach();
       Product::where('id',$id)->delete();
       Transaction::create(
        [
            'product_id'=>$id,
            'transaction_type'=>'OUT'
        ]
        );
       return redirect('showProductList');
   }


   public function showQuantityAdd($id)
   {
     $data= Product::where('id',$id)->first();
     $id= $data->id;
     
    return view('product-quantity-add',['id'=>$data->id]);
   }

   
   public function quantityAdd(Request $request)
   {
      $data= $request->validate([
          'quantity'=>'required'
      ]);
      $id= $request->id;
    $value=Product::where('id',$id)->first();
    $currentQuantity= $value->quantity;
    $updatedQuantity= $currentQuantity+$data['quantity'];
    
    Product::where('id',$id)->update([
        'quantity'=>$updatedQuantity
    ]);
    Transaction::create(
        [
            'product_id'=>$id,
            'quantity'=>$updatedQuantity,
            'transaction_type'=>'IN'
        ]
        );
     return redirect('showProductList');
   }

   public function showAssignProduct($id)
   {
    $data=Product::all();
    return view('product-assign',['datas'=>$data,'id'=>$id]);
   }

   public function assignProduct(Request $request)
   {
        $pId= $request->product;
        $uId=$request->userid;
        // dd($uId);
        $data= $request->validate([
            'quantity'=>'required'
        ]);
        $value=Product::where('id',$pId)->first();
        $stockQuantity= $value->quantity;

        if($stockQuantity>$data['quantity'])
        {

            $remainingQuantity= $stockQuantity-$data['quantity'];
            Product::where('id',$pId)->update([
                'quantity'=>$remainingQuantity,
            ]
            );
            
            ProductUser::create([
                'user_id'=>$uId,
                'product_id'=>$pId,
                'quantity'=>$data['quantity']
            ]);
            Transaction::create(
                [
                    'product_id'=>$pId,
                    'user_id'=>$uId,
                    'quantity'=>$data['quantity'],
                    'transaction_type'=>'OUT'
                ]
                );
    
            return redirect('showList');
        }
        else{
            return redirect('showAssignProduct/'.$uId)->with('msg','You dont have enough quantity to assign this product');
        }
   }

   public function showCategoryProducts($id)
   {
       $products= Category::find($id)->products()->get();
       return view('product-list',['datas'=>$products]);

      
   }

 
}
