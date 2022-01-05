<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Carbon\Carbon;
use Doctrine\DBAL\Query;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class TransactionController extends Controller
{
    public function filterTransaction()
    {
        $users= User::whereHas('roles', function($query){
            $query->where('role_users.role_id','2');
        })->get();
        return view('transaction-form',['user'=>$users]);
    }
    public function showTransaction(Request $request)
    {
        session()->put('list','list'); 
        $users= User::whereHas('roles', function($query){
        $query->where('role_users.role_id','2'); 
         })->get();

        $user= $request->user;
        $transactions=Transaction::query()->with('products','users')
        ->when($user==null && $request->from && $request->to==null,function($query) use($request){
          $query->whereBetween('created_at',[$request->from .' 00:00:00',$request->from. ' 23:59:59']);
       })


        ->when($user==null && $request->from && $request->to,function($query) use($request){

           return $query->whereBetween('created_at',[$request->from,$request->to]);
        })

        ->when($user && $request->from && $request->to,function($query) use($request,$user){
            $query->whereHas('users',function(Builder $query) use($user){
              return $query->where('users.id',$user);
                })
                ->whereBetween('created_at',[$request->from,$request->to]);
        })        
        ->when($user && $request->from==null && $request->to==null,function($query) use($user){
            $query->whereHas('users',function(Builder $query) use($user){
              return $query->where('users.id',$user);
                });
        })
        
       ->when($user && $request->from && $request->to==null,function($query) use($request,$user){
        $query->whereHas('users',function(Builder $query) use($user){
          return $query->where('users.id',$user);
            })
            ->whereBetween('created_at',[$request->from .' 00:00:00',$request->from. ' 23:59:59']);
      })      
        ->get();

        return view('transaction-form',['transactions'=>$transactions,'user'=>$users]);
    }

    public function showtransactedProduct(Request $request)
    {
        $id= session()->get('user_id');
        $dt = Carbon::now();
       
        $transactions= Transaction::query()->with('products','users')
        ->when( $request->from && $request->to,function($query) use($request,$id){
          $query->whereHas('users',function(Builder $query) use($id){
            return $query->where('users.id',$id);
              })
              ->whereBetween('created_at',[$request->from.' 00:00:00',$request->to. ' 23:59:59']);
      })  
      ->when( $request->from==null && $request->to==null,function($query) use($request,$id){
        $query->whereHas('users',function(Builder $query) use($id){
          return $query->where('users.id',$id);
            });
    })  
    ->when($request->from && $request->to==null,function($query) use($request,$id,$dt){
      $query->whereHas('users',function(Builder $query) use($id,$dt){
        return $query->where('users.id',$id);
          })
          ->whereBetween('created_at',[$request->from .' 00:00:00',$dt->toDateString(). ' 23:59:59']);;
  })  
  ->when($request->from==null && $request->to,function($query) use($request,$id,$dt){
    $query->whereHas('users',function(Builder $query) use($id,$dt){
      return $query->where('users.id',$id);
        })
        ->whereBetween('created_at',[$request->to .' 00:00:00',$request->to. ' 23:59:59']);;
})  
        ->get();
        // dd($transactions);
        return view('vendor-product-list',['transactions'=>$transactions]);
    }
}
