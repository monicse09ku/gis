<!-- Left side column. contains the logo and sidebar -->
  <aside class="main-sidebar">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
      <!-- Sidebar user panel -->
      <div class="user-panel">
        <div class="pull-left image">
          <img src="{{asset('images/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
        </div>
        <div class="pull-left info">
          <p> {{ Auth::user()->name }}</p>
          <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
        </div>
      </div>
      <!-- search form -->
      <form action="#" method="get" class="sidebar-form">
        <div class="input-group">
          <input type="text" name="q" class="form-control" placeholder="Search...">
          <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i>
                </button>
              </span>
        </div>
      </form>
      <!-- /.search form -->
      <!-- sidebar menu: : style can be found in sidebar.less -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">MAIN NAVIGATION</li>      
        <li @if( url()->current() == url('/home')) class="active" @endif><a href="{{ url('/home') }}"><i class="fa fa-snowflake-o"></i> <span>Dashboard</span></a></li>
        <li @if( url()->current() == url('/arrivals')) class="active" @endif><a href="{{ url('/arrivals') }}"><i class="fa fa-map-marker"></i> <span>Arrivals</span></a></li>
        <li @if( url()->current() == url('/incidents')) class="active" @endif><a href="{{ url('/incidents') }}"><i class="fa fa-sitemap"></i> <span>Incidents</span></a></li>
        
      </ul>
    </section>
    <!-- /.sidebar -->
  </aside>