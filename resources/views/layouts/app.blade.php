<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
      <!-- CSRF Token -->
    <meta name="csrf-token" content="{!! csrf_token() !!}">
    <meta name="description" content="">
    <meta name="author" content="">
    

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Bootstrap core CSS -->
    <link href="{{asset('css/app.css')}}" rel="stylesheet">
    <script src="{{ asset('js/app.js') }}" ></script>
    

    <!-- Custom styles for this template -->
    <link href="https://fonts.googleapis.com/css?family=Playfair+Display:700,900" rel="stylesheet">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    
  </head>

  <body>
    @include('inc.nav')
    @include('inc.msgs')
    <div class="container">
      <div class="row">
        @include('categories.categories')
        <div class="col-3 col-sm-9">
        @yield('content')
        </div>
      </div>
    </div>    
        
    <footer class="blog-footer">
      <p>
        <a href="#">Back to top</a>
      </p>
    </footer>

    <!-- Bootstrap core JavaScript
    ================================================== -->
    <!-- Placed at the end of the document so the pages load faster -->
    @yield('js')
    <script type="text/javascript">
    $(document).ready(function(){
      function worker(){
        $.ajax({
          url : '../cart/items_num' ,
          type : 'post',
          data : { _token: '{{csrf_token()}}' },
          success:function(res){
            $('#cart_num').html(res.g);
          }
        });
      }
      worker();
      $('#advance').click(function()
      {
        
      });
    });
    </script>

      
  </body>
</html>
