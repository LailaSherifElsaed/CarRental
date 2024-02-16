@section('title')
	Show Message
@endsection
<!DOCTYPE html>
<html lang="en">
  <head>
  @include('admin.includes.head')
  </head>

  <body class="nav-md">
    <div class="container body">
      <div class="main_container">
        <div class="col-md-3 left_col">
          <div class="left_col scroll-view">
            <div class="navbar nav_title" style="border: 0;">
              <a href="index.html" class="site_title"><i class="fa fa-car"></i></i> <span>Rent Car Admin</span></a>
            </div>

            <div class="clearfix"></div>

            @include('admin.includes.menu_profile')

            <br />
            @include('admin.includes.slide_bar')
            @include('admin.includes.footer_buttons')

            
          </div>
        </div>
        @include('admin.includes.top_navigation')
        

        <!-- page content -->
        <div class="right_col" role="main">
          <div class="">
            <div class="page-title">
              <div class="title_left">
                <h3>Manage Messages</h3>
              </div>

              <div class="title_right">
                <div class="col-md-5 col-sm-5 col-xs-12 form-group pull-right top_search">
                  <div class="input-group">
                    <input type="text" class="form-control" placeholder="Search for...">
                    <span class="input-group-btn">
                      <button class="btn btn-secondary" type="button">Go!</button>
                    </span>
                  </div>
                </div>
              </div>
            </div>

            <div class="clearfix"></div>

            <div class="row">
            <div class="col-md-12 col-sm-12 ">
            <div class="x_panel">
                <h2>Full Name: {{ $message->first_name . ' ' . $message->last_name }}</h2>
                <br>
                <h2>Email: {{ $message->email }}</h2>
                <br>
                <h2>Message Content:</h2>
                <p>{{ $message->message }}</p>
            </div>
        </div>
            </div>
          </div>
        </div>
        <!-- /page content -->

      @include('admin.includes.footer')
      </div>
    </div>

    @include('admin.includes.footerJs')

  </body>
</html>