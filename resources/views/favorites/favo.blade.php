@extends('layouts.app')
@section('content')
<?php
use App\Http\Controllers\ImagesController;
?>
<div class="col">
        <div class="row">
            @foreach($favorites as $favorite)
                    <?php 
                      $prod=$favorite->product;
                      $img=ImagesController::firstone($prod->id)->img;
                    ?>
                    <div class="card" style="width: 300px;">
                        <img class="card-img-top" src="storage/images/<?=$img?>" alt="Card image cap">
                        <div class="card-body">
                        <h4 class="card-title"><a href="<?=url("/");?>/prod/<?=$prod->id?>" title="View Product"><?=$prod->title.'/'.$prod->company?></a></h4>
                        <p class="card-text">{{$prod->descr}}</p>
                            <div class="row">
                                <div class="col">
                                <p class="btn btn-warning btn-block">{{$prod->price}}</p>
                                <input type="hidden" id="h<?=$prod->id?>" value="<?=$prod->quantity?>"/>
                                </div>
                                <div class="col">
                                    <button id="{{$favorite->id}}" class="btn btn-danger btn-block">Remove form Favorite</button>
                                </div>
                            </div>
                        </div>
                    </div>
            @endforeach
@endsection
@section('js')
<script type="text/javascript">
    $(document).ready(function()
    {
        $('.btn-danger').click(function()
        {
            var id =$(this).attr('id');
            if(id != null)
            {
                $.ajax
                ({
                    url: '<?=url("/");?>/favo/'+id ,
                    type: 'DELETE' ,
                    data: {_token : '{{csrf_token()}}'} ,
                    success:function(res)
                    {
                        alert(res.msg);
                        location.reload();
                    }
                });
            }
        });
    });

</script>
@endsection