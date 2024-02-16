<!doctype html>
<html lang="en">
  <head>
    @include('web.includes.head')
  </head>
  <body>
    <div class="site-wrap" id="home-section">

      <div class="site-mobile-menu site-navbar-target">
        <div class="site-mobile-menu-header">
          <div class="site-mobile-menu-close mt-3">
            <span class="icon-close2 js-menu-toggle"></span>
          </div>
        </div>
        <div class="site-mobile-menu-body"></div>
      </div>
        @include('web.includes.header')
        @include('web.includes.top')
        @yield('content')
        @include('web.includes.footer')
        @include('web.includes.footerjs')
    </div>
  </body>
</html>

