<?php

namespace App\Http\Livewire;

use App\Models\Product;
use App\Models\Transaction;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class ShowPosts extends Component
{
    public $count=1;
    public $users;
    public $user_id;
    public $date_from;
    public $date_to;
    public $a=1;
    public $transactions;


    
    public function render()
    {
        return view('livewire.show-posts');
    }



   public function showReport()
   {
    session()->put('list','list'); 
    $users= User::whereHas('roles', function($query){
    $query->where('role_users.role_id','2'); 
     })->get();

    $user= $this->user_id;
    $this->transactions=Transaction::query()->with('products','users')
    ->when($user==null && $this->date_from && $this->date_to==null,function($query) {
      $query->whereBetween('created_at',[$this->date_from .' 00:00:00',$this->date_from. ' 23:59:59']);
   })


    ->when($user==null && $this->date_from && $this->date_to,function($query) {

       return $query->whereBetween('created_at',[$this->date_from,$this->date_to]);
    })

    ->when($user && $this->date_from && $this->date_to,function($query) use($user){
        $query->whereHas('users',function(Builder $query) use($user){
          return $query->where('users.id',$user);
            })
            ->whereBetween('created_at',[$this->date_from,$this->date_to]);
    })        
    ->when($user && $this->date_from==null && $this->date_to==null,function($query) use($user){
        $query->whereHas('users',function(Builder $query) use($user){
          return $query->where('users.id',$user);
            });
    })
    
   ->when($user && $this->date_from && $this->date_to==null,function($query) use($user){
    $query->whereHas('users',function(Builder $query) use($user){
      return $query->where('users.id',$user);
        })
        ->whereBetween('created_at',[$this->date_from .' 00:00:00',$this->date_from. ' 23:59:59']);
  })      
    ->get();

    // return view('transaction-form',['transactions'=>$transactions,'user'=>$users]);
   }
 

}
