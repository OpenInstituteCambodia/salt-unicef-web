<nav class="navbar-default navbar-static-top navbar-fixed-top" role="navigation">
  <div class="navbar-header">
    <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
      <span class="sr-only">Toggle navigation</span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
      <span class="icon-bar"></span>
    </button>
    <h1>
      <a class="navbar-brand" href="#">
        <!-- Logo icon -->
        <b><img src="logo.png" alt="" class="dark-logo" /></b>
        <!-- Logo text -->
        <span>{{ trans('allstr.salt') }}</span>
      </a>
    </h1>
  </div><!-- /.navbar-header -->
  <div class="border-bottom">
    <div class="full-left">
      <section class="full-top">
        <button id="toggle"><i class="fa fa-arrows-alt"></i></button>
        <!-- language -->
        <button type="button" class="btn btn-link dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          @if(LaravelLocalization::getCurrentLocale() == 'en')
            <img src="/en.png" alt="English"> English
          @else
            <img src="/kh.png" alt="ភាសាខ្មែរ"> ភាសាខ្មែរ
          @endif
          <span class="caret"></span>
        </button>
        <ul class="dropdown-menu">
          @if(LaravelLocalization::getCurrentLocale() == 'en')
            <li>
              <a rel="alternate" hreflang="km" href="{{ LaravelLocalization::getLocalizedURL('km') }}">
                <img src="/kh.png" alt="ភាសាខ្មែរ"> ភាសាខ្មែរ
              </a>
            </li>
          @else
            <li>
              <a rel="alternate" hreflang="en" href="{{ LaravelLocalization::getLocalizedURL('en') }}">
                <img src="/en.png" alt="English"> English
              </a>
            </li>
          @endif
        </ul>
      </section>
      <div class="clearfix"></div>
    </div>
    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="drop-men">

      <ul class="nav">

        <li class="dropdown" style="padding: 5px">

          <a href="#" class="dropdown-toggle dropdown-at" data-toggle="dropdown">
            <span class=" name-caret">
              @if (Auth::check()) {{ Auth::user()->name }}
              @endif
            </span>
            <img src="{{ URL::asset('vendors/minimalAdmin/images/user_m.png')}}" style="border-radius: 50%;">
          </a>
          <ul class="dropdown-menu " role="menu">
            {{--<li><a href="profile.html"><i class="fa fa-user fa-lg"></i>Edit Profile</a></li>--}}
            <li><a href="{{route('logout')}}"><i class="fa fa-power-off fa-lg"></i> Logout</a></li>
          </ul>
        </li>

      </ul>
    </div><!-- /.navbar-collapse -->
    <div class="clearfix"></div>

    <!-- sidebar -->
    @if(Auth::user()->role==1)
    <div class="navbar-default sidebar" role="navigation" style="text-align: left">
      <div class="sidebar-nav navbar-collapse">
        <ul class="nav" id="side-menu">
          <li>
            <a href="{{ url('/usermgmt') }}" class="hvr-bounce-to-right">
              <i class="fa fa-dashboard fa-lg nav_icon "></i>
              <span class="nav-label"> {{ trans('allstr.user_mgmt')}} </span>
            </a>
          </li>
          <li>
            <a href="{{ url('/facilitymgmt') }}" class="hvr-bounce-to-right">
              <i class="fa fa fa-university fa-lg nav_icon "></i>
              <span class="nav-label"> {{ trans('allstr.facility_mgmt')}}  </span>
            </a>
          </li>
          <li>
            <a href="" class="hvr-bounce-to-right">
              <i class="fa fa-bar-chart fa-lg nav_icon "></i>
              <span class="nav-label"> {{ trans('allstr.monthly_report')}} </span>
              <span class="fa arrow fa-lg"></span>
            </a>
            <ul class="nav nav-second-level">
              <li>
                <a href="{{ url('/productionreportdisp') }}" class=" hvr-bounce-to-right">
                  <i class="fa fa-angle-double-right fa-lg nav_icon"></i>
                  {{ trans('allstr.producing_report')}}
                </a>
              </li>
              <li>
                <a href="{{ url('/inspectionreportdisp') }}" class=" hvr-bounce-to-right">
                  <i class="fa fa-angle-double-right fa-lg nav_icon"></i>
                  {{ trans('allstr.monitoring_report')}}
                </a>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </div>
    @endif
  </div>
</nav>