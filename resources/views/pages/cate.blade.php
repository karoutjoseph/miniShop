<?php
use App\Http\Controllers\ImagesController;
?>
@extends('layouts.app')
@section('content')
<div class="col">
        <div class="row">
            @foreach($prods as $prod)
                    <?php 
                      $img=ImagesController::firstone($prod->id)->img;
                    ?>
                    <div class="card" style="width: 300px;">
                        <img class="card-img-top" src="../storage/images/<?=$img?>">
                        <div class="card-body">
                        <h4 class="card-title"><a href="../prod/<?=$prod->id?>" title="View Product"><?=$prod->title.'/'.$prod->company?></a></h4>
                        <p class="card-text">{{$prod->descr}}</p>
                            <div class="row">
                                <div class="col">
                                <p class="btn btn-danger btn-block">{{$prod->price}}</p>
                                <input type="hidden" id="h<?=$prod->id?>" value="<?=$prod->quantity?>"/>
                                </div>
                                <div class="col">
                                    <button id="{{$prod->id}}" class="btn btn-success btn-block">Add to cart</button>
                                </div>
                            </div>
                        </div>
                    </div>
            
            @endforeach
            @if(count($prods1)>0)
            @foreach($prods1 as $k)
               @foreach($k as $prod1)
               <?php 
               $img=ImagesController::firstone($prod1->id)->img;
                ?>
                <div class="card" style="width: 300px;">
                    <img class="card-img-top" src="../storage/images/<?=$img?>" alt="Card image cap">
                    <div class="card-body">
                    <h4 class="card-title"><a href="../prod/<?=$prod1->id?>" title="View Product"><?=$prod1->title.'/'.$prod1->company?></a></h4>
                    <p class="card-text">{{$prod1->descr}}</p>
                        <div class="row">
                            <div class="col">
                            <p class="btn btn-danger btn-block">{{$prod1->price}}</p>
                            <input type="hidden" id="h<?=$prod1->id?>" value="<?=$prod1->quantity?>"/>
                            </div>
                            <div class="col">
                                <button id="{{$prod1->id}}" class="btn btn-success btn-block">Add to cart</button>
                            </div>
                        </div>
                    </div>
                </div>
            
                @endforeach
            @endforeach
            @endif
         </div> 
</div>
<script type="text/javascript">
    $(document).ready(function() {
        $('.btn-success').click(function()
        {
            var product_id=$(this).attr('id');
            if(product_id!=null)
            {
                var oqtn=1;
                var aqtn=$('#h'+product_id).val();
                if(oqtn>aqtn)
                    {
                        alert("we don't have enough units");
                    }
                    else
                    {
                    $.ajax({
                        url : '../cart' ,
                        type : 'POST' ,
                        data : {product_id: product_id , aqtn:aqtn , oqtn: oqtn , _token : '{{csrf_token()}}'},
                        success:function(res)
                        {
                            alert(res.msg);
                            updatecart_num();
                        }
                    });
                    }
            }
        });

        function updatecart_num()
	    {
		    var old=parseInt($('#cart_num').html());
			var n=old+1;
			$('#cart_num').html(n);
	    }
    });
</script>        
@endsection
