<?php 
use App\Order;
?>
@extends('layouts.appadmin')
@section('content')
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Product Title</th>
        <th scope="col">Customer name</th>
        <th scope="col">Unit Price</th>
        <th scope="col">Quantity</th>
        <th scope="col">Price</th>
        <th scope="col">Ordered at</th>
        <th scope="col">Status</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
      @foreach($orders as $order)
      <?php
      $prod=$order->product;
      $user=$order->user;
      ?>
        <tr>
          <a href="/prod/{{$prod->id}}"><td>{{$prod->company.'/'.$prod->title}}</td></a>          
          <td>{{$user->name}}</td>
          <td>{{$order->price}}</td>
          <td>{{$order->quantity}}</td>
          <td>{{$order->price*$order->quantity}}</td>
          <td>{{$order->created_at}}</td>
          @if($order->status=='pending')
          <td class="table-danger">{{$order->status}}</td>
          <td>
            <button class="btn btn-success" id="{{$order->id}}"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
            <button class="btn btn-danger" id="{{$order->id}}" value="disable"><i class="fa fa-times" aria-hidden="true"></i></button>
          </td>
          @endif
          @if($order->status=='on its way')
          <td class="table-warning">{{$order->status}}</td>
          <td>No action available</td>
          @endif
          @if($order->status=='received')
          <td class="table-success">{{$order->status}}</td>
          <td>
            <button class="btn btn-danger" id="{{$order->id}}" value="disable"><i class="fa fa-times" aria-hidden="true"></i></button>              
          </td>
          @endif
          @if($order->status=='disable')
          <td class="table-secondary">{{$order->status}}</td>
          <td>
            <button class="btn btn-danger" id="{{$order->id}}" value="remove"><i class="fa fa-trash" aria-hidden="true"></i></button>              
          </td>
          @endif
        </tr>
      @endforeach  
    </tbody>
</table>  
@endsection
@section('js')
<script type="text/javascript">
$(document).ready(function()
{
  $('.btn-success').click(function()
  {
    var id=$(this).attr('id');
    if(id!=null)
    {
        var type='accepted';
        $.ajax(
        {
            url: 'order/'+id ,
            type: 'PUT' ,
            data : {type:type , _token:'{{csrf_token()}}'} ,
            success:function(res)
            {
            alert(res.msg);
            location.reload();
            }
        }
        );
    }
  });
  $('.btn-danger').click(function()
  {
    var id=$(this).attr('id');
    if(id!=null)
    {
        var type=$(this).val();
        $.ajax(
        {
            url: 'order/'+id ,
            type: 'PUT' ,
            data : {type: type , _token:'{{csrf_token()}}'} ,
            success:function(res)
            {
            alert(res.msg);
            location.reload();
            }
        }
        );
    }
  });
});
</script>
@endsection