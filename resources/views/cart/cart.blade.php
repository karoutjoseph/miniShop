@extends('layouts.app')
@section('content')
<?php
use App\Http\Controllers\ImagesController;
use App\Product;
$gt=0;
?>
<div class="shopping-cart" style="margin-top: 5%;">
    <div class="column-labels">
      <label class="product-image">Image</label>
      <label class="product-details">Product</label>
      <label class="product-price">Price</label>
      <label class="product-quantity">Quantity</label>
      <label class="product-removal">Remove</label>
      <label class="product-line-price">Total</label>
    </div>
    @foreach($cart as $item)
    <?php
    $prod=$item->product;
    $img=ImagesController::firstone($prod->id)->img;
    ?>
    <div class="product">
      <div class="product-image">
        <img src="storage/images/<?=$img?>">
      </div>
      <div class="product-details">
       <a href="<?=url('/');?>/prod/<?=$prod->id?>"><div class="product-title"><?=$prod->company.'/'.$prod->title?></div></a>
        <p class="product-description"><?=$prod->descr?></p>
      </div>
      <div class="product-price"><?=$prod->price?></div>
      <div class="product-quantity">
        <input type="number" id="<?=$item->id?>" value="<?=$item->quantity?>" min="1">
        <?php
        $gt=$gt+$item->quantity*$prod->price;
        ?>
      </div>
      <div class="product-removal">
        <button class="remove-product" id="<?=$item->id?>">
          Remove
        </button>
      </div>
      <div class="product-line-price"><?=$item->quantity*$prod->price?></div>
    </div>
    @endforeach
    <div class="totals">
      <div class="totals-item">
        <label>Subtotal</label>
        <div class="totals-value" id="cart-subtotal"><?=$gt?></div>
      </div>
      <div class="totals-item">
        <label>Tax (0%)</label>
        <div class="totals-value" id="cart-tax">0</div>
      </div>
      <div class="totals-item">
        <label>Shipping</label>
        <div class="totals-value" id="cart-shipping">0</div>
      </div>
      <div class="totals-item totals-item-total">
        <label>Grand Total</label>
        <div class="totals-value" id="cart-total"><?=$gt?></div>
      </div>
    </div>
        @guest
        <a class="checkout" type="button" href="{{ route('login') }}">Checkout</a>
        @else
        <button class="checkout">Checkout</button>
        @endguest
   
  </div>
  @section('js')
  <script type="text/javascript">
  $(document).ready(function() {
   
   /* Set rates + misc */
   var taxRate = 0;
   var shippingRate = 0; 
   var fadeTime = 300;

   $('.checkout').click(function()
   {
     $.ajax
     ({
       url : '<?=url('/');?>/order' ,
       type : 'POST' ,
       data : {_token:'{{csrf_token()}}'} ,
       success:function(res)
       {
         alert(res.msg);
         location.reload();
       }
     });
   });
    
    
   /* Assign actions */
   $('.product-quantity input').change( function() {
     var oqtn=$(this).val();
     var id=$(this).attr('id');
     var quantity_input=this;
     $.ajax
     ({
       url: '<?=url('/');?>/cart/'+id ,
       type: 'PUT' ,
       data: {oqtn: oqtn , _token:'{{csrf_token()}}'} ,
       success:function(res)
       {
         if(res.msg=="yes")
         {
         updateQuantity(quantity_input);
         }
         else
         {
           alert(res.msg);
           $(quantity_input).val(parseInt(res.qtn));
           updateQuantity(quantity_input);
           
         }
       }
     });
     
   });
    
  //  $('.product-removal button').click( function() {
  //    removeItem(this);
  //  });
   $('.remove-product').click(function()
   {
     var id=$(this).attr('id');
     var remove_product=this;
     $.ajax
     ({
       url: '<?=url('/');?>/cart/'+id,
       type: 'DELETE' ,
       data: {_token:'{{csrf_token()}}'},
       success:function(res)
       {
         alert(res.msg);
         removeItem(remove_product);
       }

     });
   });
    
    
   /* Recalculate cart */
   function recalculateCart()
   {
     var subtotal = 0;
      
     /* Sum up row totals */
     $('.product').each(function () {
       subtotal += parseFloat($(this).children('.product-line-price').text());
     });
      
     /* Calculate totals */
     var tax = subtotal * taxRate;
     var shipping = (subtotal > 0 ? shippingRate : 0);
     var total = subtotal + tax + shipping;
      
     /* Update totals display */
     $('.totals-value').fadeOut(fadeTime, function() {
       $('#cart-subtotal').html(subtotal.toFixed(2));
       $('#cart-tax').html(tax.toFixed(2));
       $('#cart-shipping').html(shipping.toFixed(2));
       $('#cart-total').html(total.toFixed(2));
       if(total == 0){
         $('.checkout').fadeOut(fadeTime);
       }else{
         $('.checkout').fadeIn(fadeTime);
       }
       $('.totals-value').fadeIn(fadeTime);
     });
   }
    
    
   /* Update quantity */
   function updateQuantity(quantityInput)
   {
     /* Calculate line price */
     var productRow = $(quantityInput).parent().parent();
     var price = parseFloat(productRow.children('.product-price').text());
     var quantity = $(quantityInput).val();
     var linePrice = price * quantity;
      
     /* Update line price display and recalc cart totals */
     productRow.children('.product-line-price').each(function () {
       $(this).fadeOut(fadeTime, function() {
         $(this).text(linePrice.toFixed(2));
         recalculateCart();
         $(this).fadeIn(fadeTime);
       });
     });  
   }
    
    
   /* Remove item from cart */
   function removeItem(removeButton)
   {
     /* Remove row from DOM and recalc cart total */
     var productRow = $(removeButton).parent().parent();
     productRow.slideUp(fadeTime, function() {
       productRow.remove();
       recalculateCart();
     });
   }
    
   });
  </script>
  @endsection
@endsection