<nav class="navbar navbar-expand-md navbar-dark bg-dark">
    <div class="container">
        <a class="navbar-brand" href="<?=url('/');?>">Joseph</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarsExampleDefault" aria-controls="navbarsExampleDefault" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse justify-content-end" id="navbarsExampleDefault">
            <ul class="navbar-nav m-auto">
                <li class="nav-item">
                    <a class="nav-link" href="<?=url('/');?>">Home</a>
                </li>
                @guest
                <li class="nav-item active">
                <a class="nav-link" href="{{route('login')}}">Orders <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{route('login')}}">Favorite</a>
                </li>
                @else
                <li class="nav-item active">
                    <a class="nav-link" href="<?=url('/');?>/order">Orders <span class="sr-only"></span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="<?=url('/');?>/favo">Favorite</a>
                </li>
                @endguest
            </ul>
             {{--to do search  --}}
            <form class="form-inline my-2 my-lg-0" method="POST" action="<?=url('/');?>/search">
                @csrf
                <div class="input-group input-group-sm">
                    <input type="text" name="textToSearch" class="form-control" aria-label="Small" aria-describedby="inputGroup-sizing-sm" placeholder="Search...">
                    <div class="input-group-append">
                        <button type="submit" class="btn btn-secondary btn-number">
                            <i class="fa fa-search"></i>
                        </button>
                        <button type="button" id="adv" data-toggle="modal" data-target="#advance" class="btn btn-secondary btn-number">
                            <i class="fa fa-cog" aria-hidden="true"></i>
                        </button>
                    </div>
                </div>
            </form>
                <a class="btn btn-success btn-sm ml-3" href="<?=url('/');?>/cart">
                    <i class="fa fa-shopping-cart"></i> Cart
                    <span class="badge badge-light" id='cart_num'></span>
                </a>
                @guest
                <a class="btn btn-primary btn-sm ml-3" href="{{ route('login') }}">Sign in</a>
                <a class="btn btn-warning btn-sm ml-3" href="{{ route('register') }}">Sign up</a>
                @else
                <a class="btn btn-danger btn-sm ml-3" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                </a>

                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                       @csrf
                </form>
                @endguest
        </div>
    </div>
    <div class="modal" tabindex="-1" id="advance" role="dialog">
        <div class="modal-dialog" role="document">
          <div class="modal-content">
            <div class="modal-header">
              <h5 class="modal-title">Advance Search</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                <span aria-hidden="true">&times;</span>
              </button>
            </div>
            <form action='<?=url('/');?>/searcha' method="POST">
                @csrf
                <div class="modal-body">
                    <div class="form-group">
                       <input class="form-control" type="text" name="textToSearch"/>
                     </div>
                    <div class="form-group">
                        <?php
                        use App\Category;
                        $cates=Category::all();
                        ?>
                        <select class="form-control" name="cate">
                                <option selected="selected" value="no">Pick up a category...</option>
                                @foreach($cates as $cate)
                                <option value="<?=$cate->id?>"><?=$cate->title?></option>
                                @endforeach
                        </select>
                    </div> 
                </div>
                <div class="modal-footer">
                    <div class="form-group">
                        <button type="submit" class="btn btn-primary">Search</button>
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                    </div>
                </div>
            </form>
          </div>
        </div>
    </div>
</nav>
