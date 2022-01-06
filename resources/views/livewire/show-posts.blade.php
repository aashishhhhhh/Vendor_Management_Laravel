<div class="row">
   
      <div class="card-body">
        <h2>Pick Transaction Date</h2>
        <form id="quickForm" >
          @csrf
          <div class="form-group">
           
            <div class="col-4">
              <br>
              <p>From</p>
              <input type="date" class="form-control " name="from" id="" wire:model="date_from">
            </div>
          </div>
          <div class="form-group">
            <div class="col-4">
              <p>To</p>
              <input type="date" class="form-control " name="to" id="" wire:model="date_to">
            </div>
          </div>
          <div class="form-group">
            <div class="col-4">
    
            <p>Pick User</p>
          <select name='user'class="form-control" wire:model="user_id">
            <option value="none">Select an Option</option>
              @foreach ($users as $item)
            <option value="{{$item->id}}" > {{$item->name}} </option>
            @endforeach
          </select>
        </div>
        
        </div>
        <div class="form-group">
        <a wire:click="showReport()" class="btn btn-primary">search </a>  
        </div>
    
        </form>
        <hr>
    
        @isset($transactions)        
        @if (count($transactions)<1)
        <h2 style="color: red"> No Transactions done in this date </h2>      
        @else         
        <table class="table table-hover text-nowrap">
          <h3>Transaction Table</h3>
          <thead>
              <th>S.N</th>
              <th>Product Name</th>
              <th>User Name</th>
              <th>Quantity</th>
              <th>Transaction Type</th>
          </thead>
        {{-- @dd($transctions[0]->products->name) --}}
          <tbody>
              @foreach ($transactions as $key => $item)
              <tr>
                  <td> {{$key++}}</td>
                  <td >{{$item->products->name}}</td>
                  <td >{{$item->users->name ?? 'None'}}</td>
                  <td>{{$item->quantity}}</td>
                  <td>{{$item->transaction_type}}</td>
              </tr>
          @endforeach
        </tbody>   
        </table>
        
        @endif
        @endisset    
      </div>
   
    
    
</div>