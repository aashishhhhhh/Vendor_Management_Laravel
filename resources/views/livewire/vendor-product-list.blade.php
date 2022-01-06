<div class="row">
    <div class="datediv">
        <form >
            @csrf
            <h3 class="vendorDate">Pick a Transaction Date</h3>
            <label> From </label>
            <input type="date" name="from" wire:model="from">
            <label> To </label>
            <input type="date" name="to" wire:model="to">
            <a wire:click="showtransactedProduct" class="btn btn-primary"> <i class="fas fa-search fa-fw"></i> </a>
        </form>
            </div>
    <div></div>
    @if (count($transactions)>0)
    
    <table class="table table-hover text-nowrap">
        <thead>
            <th>Product Name</th>
            <th>Quantity</th>
        </thead>
        <tbody>
          @foreach ($transactions as $item)
          <tr>
            <td>{{$item->products->name}}</td>
            <td>{{$item->quantity}}</td>
          </tr>
          @endforeach
        </tbody>
      </table> 
      @else
        <h2 style="color: red">You havenot brought any products in this date</h2>
    @endif
</div>
