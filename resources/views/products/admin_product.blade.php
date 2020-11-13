@extends('layouts.appadmin')
@section('content')
<a href="../prod/create" class="btn btn-success">Add new Product</a>
<table class="table table-striped">
        <thead>
          <tr>
            <th scope="col">Product Title</th>
            <th scope="col">Unit Price</th>
            <th scope="col">Quantity</th>
            <th scope="col"># of orders</th>
            <th scope="col"># of visitors</th>
            <th scope="col">Action</th>
          </tr>
        </thead>
        <tbody>
          @foreach($prods as $prod)
            <tr>
              <td><?=$prod->company.'/'.$prod->title?></td>
              <td><?=$prod->price?></td>
              <td><?=$prod->quantity?></td>
              <td><?=count($prod->orders)?></td>
              <td><?=$prod->counter?></td>
              <td><a href="<?=url('/');?>/prod/<?=$prod->id?>/edit" class="btn btn-primary">Edit</a></td>
            @endforeach  
        </tbody>
</table>  
@endsection