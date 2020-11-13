@extends('layouts.app')
@section('content')
<?php
use App\Http\Controllers\ImagesController;
?>
<div class="upcoming py-5">
        <div class="container">
        <div class="row pb-4 text-center">
            <div class="col-md-12">
                <h2>Latest Products</h2>
                <p> Some text here.</p>
            </div>
        </div>
        <div class="row text-center">
          <?php
          $m=4; 
          if(count($lp)<4)
          {
              $m=count($lp);
          }
          ?>  
          @for($i=0;$i<$m;$i++)
          <?php $img=ImagesController::firstone($lp[$i]->id)->img; ?>
          <div class="col-md-3 box border py-4">
                <div class="box-carimage">
                    <img src="storage/images/<?=$img?>" alt="">
                </div>
                <div class="box-cartitle">
                    <h4><?=$lp[$i]->company?></h4>
                </div>
                <div class="box-carprice">
                    <h6><i class="fa fa-inr"></i><?=$lp[$i]->title?></h6>
                </div>
                <div class="box-date pb-3">
                    <small><?=$lp[$i]->created_at?></small>
                    
                </div>
                <a href="<?=url("/");?>/prod/<?=$lp[$i]->id?>" class="btn btn-outline-danger">Check Price</a>
            </div>
          @endfor
        </div>
    </div>
</div>
    <div class="popular py-5">
        <div class="container">
        <div class="row pb-4 text-center">
            <div class="col-md-12">
                <h2>Popular Products</h2>
                <p> Some text here.</p>
            </div>
        </div>
        <div class="row text-center">
        <?php
          $m=4; 
          if(count($vp)<4)
          {
              $m=count($vp);
          }
          ?>  
          @for($i=0;$i<$m;$i++)
          <?php $img=ImagesController::firstone($vp[$i]->id)->img; ?>
          <div class="col-md-3 box border py-4">
                <div class="box-carimage">
                    <img src="storage/images/<?=$img?>" alt="">
                </div>
                <div class="box-cartitle">
                    <h4><?=$vp[$i]->company?></h4>
                </div>
                <div class="box-carprice">
                    <h6><i class="fa fa-inr"></i><?=$vp[$i]->title?></h6>
                </div>
                <div class="box-date pb-3">
                    <small><?=$vp[$i]->created_at?></small>
                    
                </div>
                <a href="<?=url("/");?>/prod/<?=$vp[$i]->id?>" class="btn btn-outline-danger">Check Price</a>
            </div>
          @endfor
        </div>
    </div>
    </div>
    <div class="popular py-5">
            <div class="container">
            <div class="row pb-4 text-center">
                <div class="col-md-12">
                    <h2>Most Ordered Products</h2>
                    <p> Some text here</p>
                </div>
            </div>
            <div class="row text-center">
            <?php
            $m=4; 
            if(count($op)<4)
             {
              $m=count($op);
             }
            ?>  
            @for($i=0;$i<$m;$i++)
            <?php $img=ImagesController::firstone($op[$i]->id)->img; ?>
            <div class="col-md-3 box border py-4">
                <div class="box-carimage">
                    <img src="storage/images/<?=$img?>" alt="">
                </div>
                <div class="box-cartitle">
                    <h4><?=$op[$i]->company?></h4>
                </div>
                <div class="box-carprice">
                    <h6><i class="fa fa-inr"></i><?=$op[$i]->title?></h6>
                </div>
                <div class="box-date pb-3">
                    <small><?=$op[$i]->created_at?></small>
                    
                </div>
                <a href="<?=url("/");?>/prod/<?=$op[$i]->id?>" class="btn btn-outline-danger">Check Price</a>
            </div>
            @endfor
            </div>
        </div>
    </div>
    <div class="popular py-5">
            <div class="container">
            <div class="row pb-4 text-center">
                <div class="col-md-12">
                    <h2>Favorite Products</h2>
                    <p> Some text here.</p>
                </div>
            </div>
            <div class="row text-center">
          <?php
          $m=4; 
          if(count($fp)<4)
          {
              $m=count($fp);
          }
          ?>  
          @for($i=0;$i<$m;$i++)
          <?php $img=ImagesController::firstone($fp[$i]->id)->img; ?>
          <div class="col-md-3 box border py-4">
                <div class="box-carimage">
                    <img src="storage/images/<?=$img?>" alt="">
                </div>
                <div class="box-cartitle">
                    <h4><?=$fp[$i]->company?></h4>
                </div>
                <div class="box-carprice">
                    <h6><i class="fa fa-inr"></i><?=$fp[$i]->title?></h6>
                </div>
                <div class="box-date pb-3">
                    <small><?=$fp[$i]->created_at?></small>
                    
                </div>
                <a href="<?=url("/");?>/prod/<?=$fp[$i]->id?>" class="btn btn-outline-danger">Check Price</a>
            </div>
          @endfor
            </div>
        </div>
    </div>
@endsection