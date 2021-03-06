<header class="blog-header py-3">
    <div class="row flex-nowrap justify-content-between align-items-center">
      <div class="col-4 pt-1">
        <a class="text-muted" href="#">{{ config('app.name', 'Laravel') }}</a>
      </div>
      <div class="col-4 text-center">
        <a class="blog-header-logo text-dark" href="#">Large</a>
      </div>
      <div class="col-4 d-flex justify-content-end align-items-center">
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('login') }}">Sign in</a>
        <a class="btn btn-sm btn-outline-secondary" href="{{ route('register') }}">Sign up</a>
      </div>
    </div>
  </header>