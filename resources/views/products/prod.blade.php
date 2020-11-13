@extends('layouts.app')
@section('content')
<div class="container">
	   
		<div class="card">
			<div class="container-fliud">
				<div class="wrapper row">
				    <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<!-- e commers -->
<ins class="adsbygoogle"
     style="display:block"
     data-ad-client="ca-pub-9155049400353686"
     data-ad-slot="5554792257"
     data-ad-format="auto"></ins>
<script>
(adsbygoogle = window.adsbygoogle || []).push({});
</script>
				    
					<div class="preview col-md-6">
						
						<div class="preview-pic tab-content">
						  <div class="tab-pane active" id="pic-1"><img src="../storage/images/<?=$images[0]->img?>" /></div>
						  <?php $j=2; ?>
						  @for($i=1;$i<count($images);$i++)
						  <div class="tab-pane" id="pic-<?=$j?>"><img src="../storage/images/<?=$images[$i]->img?>" /></div>
						  <?php $j++; ?>
						  @endfor
						</div>
						<ul class="preview-thumbnail nav nav-tabs">
						  <li class="active"><a data-target="#pic-1" data-toggle="tab"><img src="../storage/images/<?=$images[0]->img?>" /></a></li>
						  <?php $j=2; ?>
						  @for($i=1;$i<count($images);$i++)
						  <li><a data-target="#pic-<?=$j?>" data-toggle="tab"><img src="../storage/images/<?=$images[$i]->img?>" /></a></li>
						  <?php $j++; ?>
						  @endfor
						</ul>
						
					</div>
					<div class="details col-md-6">
						<h3 class="product-title"> <?=$prod->company.'/'.$prod->title?> </h3>
						<div class="rating">
							<span class="review-no"><?=$prod->counter?> reviews</span>
						</div>
						<p class="product-description"><?=$prod->descr?></p>
						<h4 class="price">current price: <span><?=$prod->price?></span></h4>
						<p class="vote"><strong><?=$prod->quantity?></strong> units available right now</p>
						<div class="form-group" >
                            <label class="form-control">Quantity:</label> 
						    <input class="form-control" id="quantity" name="quantity" type="number" value="">
						</div>
						<div class="action">
							<button id="<?=$prod->id?>" class="add-to-cart btn btn-default" value="cart" type="button">add to cart</button>
							@guest
							<a class="like btn btn-default" value="favo1" type="button" href="{{ route('login') }}">Add to favorite</a>							
							@else
				            <div id="fbtn">
							<button id="<?=$prod->id?>" class="like btn btn-default" value="favo" type="button">Add to favorite</button>
				            </div>
							@endguest
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
	
	 <script async src="//pagead2.googlesyndication.com/pagead/js/adsbygoogle.js"></script>
<ins class="adsbygoogle"
     style="display:block; text-align:center;"
     data-ad-format="fluid"
     data-ad-layout="in-article"
     data-ad-client="ca-pub-9155049400353686"
	 data-ad-slot="7825539155"></ins>
@section('js')	 
<script type="text/javascript">
     $(document).ready(function(){
       $('.btn-default').click(function(){
          var type=$(this).val();
		  if(type=="favo")
		  {
		    var product_id=$(this).attr('id');
			 $.ajax({
				 url:'../favo' ,
				 type:'POST' ,
				 data: {product_id:product_id, _token:'{{csrf_token()}}'} ,
				 success:function(res){
					 $('#fbtn').html(res.msg);
				 }
			 });
		  }
		  else
		  {
			  var aqtn=parseInt(<?=$prod->quantity?>);
			  var oqtn=$('#quantity').val();
			  var product_id=$(this).attr('id');
			  if(oqtn=="")
			  {
				  oqtn=1;
			  }
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
				  success:function(res){
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
@endsection