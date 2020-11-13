<?php 
use App\Order;
?>
@extends('layouts.app')
@section('content')
<table class="table table-striped">
    <thead>
      <tr>
        <th scope="col">Product Title</th>
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
      ?>
        <tr>
          <td><a href="/prod/{{$prod->id}}">{{$prod->company.'/'.$prod->title}}</a></td>
          <td>{{$order->price}}</td>
          <td>{{$order->quantity}}</td>
          <td>{{$order->price*$order->quantity}}</td>
          <td>{{$order->created_at}}</td>
          @if($order->status=='pending')
          <td class="table-danger">{{$order->status}}</td>
          <td>
          <button class="btn btn-danger" id="{{$order->id}}" value="disable"><i class="fa fa-times" aria-hidden="true"></i></button>
          </td>
          @endif
          @if($order->status=='on its way')
          <td class="table-warning">{{$order->status}}</td>
          <td>
             <button class="btn btn-success" id="{{$order->id}}" value="received"><i class="fa fa-check-square-o" aria-hidden="true"></i></button>
          </td>
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
            <button class="btn btn-danger" id="{{$order->id}}" value="remove"><i class="fa fa-trash" aria-hidden="true"></i></i></button>
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
    var type=$(this).val();
    if(type!=null)
    {
      var id=$(this).attr('id');
      $.ajax(
      {
        url: 'order/'+id ,
        type: 'PUT' ,
        data : {type: type , _token:'{{csrf_token()}}'} ,
        success:function(res)
        { 
          location.reload();
          alert(res.msg);
        }
      }
      );
    }
  });
  $('.btn-danger').click(function()
  {
    var id=$(this).attr('id');
    var btnr=this;
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
          $(btnr).parent().parent().remove();
        }
      }
      );
    }
  });
});
</script>
@endsection