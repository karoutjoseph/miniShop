<div class="card bg-light mb-3">
            <div class="card-header bg-primary text-white text-uppercase"><i class="fa fa-list"></i> Categories</div>
            <ul class="list-group category_block">
                    <?php
                    use App\Category;
                    $cates=Category::all();
                    foreach($cates as $c)
                    {
                    ?>
                <li class="list-group-item"><a href="<?=url('/');?>/cate/<?=$c->id?>"><?=$c->title?></a></li>
                <?php } ?>
            </ul>
</div>       