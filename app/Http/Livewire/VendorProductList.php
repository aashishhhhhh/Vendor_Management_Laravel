<?php

namespace App\Http\Livewire;

use App\Models\Transaction;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class VendorProductList extends Component
{
    public $transactions;
    public $from;
    public $to;
    public function render()
    {
        return view('livewire.vendor-product-list');
    }
   public function showtransactedProduct()
   {
    //    dd('a');
    $id= session()->get('user_id');
    $dt = Carbon::now();
   
    $this->transactions= Transaction::query()->with('products','users')
    ->when( $this->from && $this->to,function($query) use($id){
      $query->whereHas('users',function(Builder $query) use($id){
        return $query->where('users.id',$id);
          })
          ->whereBetween('created_at',[$this->from.' 00:00:00',$this->to. ' 23:59:59']);
  })  
  ->when( $this->from==null && $this->to==null,function($query) use($id){
    $query->whereHas('users',function(Builder $query) use($id){
      return $query->where('users.id',$id);
        });
})  
->when($this->from && $this->to==null,function($query) use($id,$dt){
  $query->whereHas('users',function(Builder $query) use($id,$dt){
    return $query->where('users.id',$id);
      })
      ->whereBetween('created_at',[$this->from .' 00:00:00',$dt->toDateString(). ' 23:59:59']);;
})  
->when($this->from==null && $this->to,function($query) use($id,$dt){
$query->whereHas('users',function(Builder $query) use($id,$dt){
  return $query->where('users.id',$id);
    })
    ->whereBetween('created_at',[$this->to .' 00:00:00',$this->to. ' 23:59:59']);;
})  
    ->get();
   }
}
