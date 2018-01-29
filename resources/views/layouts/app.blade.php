<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content=""/>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="icon" type="image/png" href="/img/favicon.ico">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>{{ config('app.name', 'Laravel') }}</title>
    <script src="/js/jquery.min.js" type="text/javascript"></script>
    <script src="/js/jquery-ui.min.js" type="text/javascript"></script>
    @yield('extrajs_head')
    <!-- Scripts -->
    <script> window.Laravel = <?php echo json_encode(['csrfToken' => csrf_token(),]); ?></script>
    <!-- Bootstrap core CSS     -->
    <link href="/css/bootstrap.min.css" rel="stylesheet" />
    <!--  Light Bootstrap Dashboard core CSS    -->
    <link href="/css/light-bootstrap-dashboard.css" rel="stylesheet"/>
    <!--  CSS for Demo Purpose, don't include it in your project     -->
    <link href="/css/demo.css" rel="stylesheet" />
    <!--     Fonts and icons     -->
    <link href="http://maxcdn.bootstrapcdn.com/font-awesome/latest/css/font-awesome.min.css" rel="stylesheet">
    <link href='http://fonts.googleapis.com/css?family=Roboto:400,700,300' rel='stylesheet' type='text/css'>
    <link href="/css/pe-icon-7-stroke.css" rel="stylesheet" />
    @yield('extracss')
</head>
<body class="">
<div class="screen-loading">
    <div class="loading-page">
        <div class="icon"><i class="fa fa fa-spinner fa-pulse fa-5x fa-fw"></i></div>
        {{-- <p>Loading ...</p> --}}
    </div>
</div>
<div class="wrapper">
    <div class="sidebar" data-color="orange" data-image="/img/full-screen-image-3.jpg">
        <div class="logo">
            <a href="/" class="logo-text"> PickInside </a>
        </div>
        <div class="logo logo-mini">
            <a href="/" class="logo-text">Pi</a>
        </div>

        <div class="sidebar-wrapper">
            <div class="user">
                <div class="photo">
                    <img src="/img/default-avatar.png" />
                </div>
                <div class="info">
                    <a data-toggle="collapse" href="#collapseExample" class="collapsed">
                        {{ Auth::user()->name }}
                        <b class="caret"></b>
                    </a>
                    <div class="collapse" id="collapseExample">
                        <ul class="nav">
                            <li><a href="/user">My Profile</a></li>
                            {{-- <li><a href="/user">Edit Profile</a></li> --}}
                            {{-- <li><a href="#">Settings</a></li> --}}
                        </ul>
                    </div>
                </div>
            </div>

            <ul class="nav">
                <li>
                    <a href="{{ url('/') }}">
                        <i class="pe-7s-graph"></i>
                        <p>Dashboard</p>
                    </a>
                </li>

                <li>
                    <a data-toggle="collapse" href="#categoryTree" aria-expanded="true">
                        <i class="pe-7s-id"></i>
                        <p>Category
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="categoryTree">
                        <ul class="nav">

                            <li>
                                <a href="{{action('TaxonomyController@category')}}">
                                    <p>Category Card</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{action('TaxonomyController@category')}}?view=tree">
                                    <p>Category Tree</p>
                                </a>
                            </li>
                            <li>
                                <a href="{{action('CategoryTreeController@viewTree')}}">
                                    <p>Category Table</p>
                                </a>
                            </li>
                        </ul>
                    </div>
                </li>

               {{--  <li>
                    <a data-toggle="collapse" href="#mainTaxonomy" aria-expanded="true">
                        <i class="pe-7s-plugin"></i>
                        <p>Taxonomies
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="mainTaxonomy">
                        <ul class="nav">
                            <li><a href="{{action('TaxonomyController@get_taxlist',0)}}">Category</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',22)}}">Compare Browsers</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',24)}}">Compare with</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',46)}}">Framework</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',91)}}">Softwares</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',96)}}">Theme includes</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',57)}}">Layouts</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',21)}}">Columns</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',23)}}">Email service</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',83)}}">Resolution</a></li>
                            <li><a href="{{action('TaxonomyController@get_taxlist',60)}}">Minimum Adobe CS Version</a></li>
                        </ul>
                    </div>
                </li> --}}

                <li>
                    <a data-toggle="collapse" href="#boardsManager" aria-expanded="true">
                        <i class="pe-7s-portfolio"></i>
                        <p>Boards Report
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="boardsManager">
                        <ul class="nav">
                            <li><a href="{{action('BoardsController@index')}}">List Boards</a></li>
                            <li><a href="{{action('BoardsController@create')}}">Create board</a></li>
                        </ul>
                    </div>
                </li>

                @if(Auth::user()->id == 1 || Auth::user()->id == 2)
                    <li>
                        <a data-toggle="collapse" href="#listItems">
                            <i class="pe-7s-note2"></i>
                            <p>{{trans('items.title_page')}}
                               <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="listItems">
                            <ul class="nav">
                                <li><a href="{{action('ItemsController@index')}}">{{trans('items.list')}}</a></li>
                                <li><a href="{{action('ItemsController@create')}}">{{trans('items.create')}}</a></li>
                                <li><a href="{{action('ItemsController@createAPi')}}">Create item from api</a></li>
                                <li><a href="{{action('ItemsController@listItemAPIView')}}" target="_blank">API list item</a></li>
                                <li><a href="{{action('ItemsController@testApiDetail','5814cc5b92283a53908294dd')}}" target="_blank">API Detail a item</a></li>
                                <li><a href="{{action('ItemsController@ajaxGetData')}}">Index data</a></li>
                            </ul>
                        </div>
                    </li>
                @endif

                <li>
                    <a data-toggle="collapse" href="#SearchItem">
                        <i class="pe-7s-albums"></i>
                        <p>Custom search
                           <b class="caret"></b>
                        </p>
                    </a>
                    <div class="collapse" id="SearchItem">
                        <ul class="nav">
                            <li><a href="{{action('SearchController@index')}}">Search advance</a></li>

                        </ul>
                    </div>
                </li>
                @if(Auth::user()->id == 1 || Auth::user()->id == 2)
                    <li>
                        <a data-toggle="collapse" href="#setting">
                            <i class="pe-7s-albums"></i>
                            <p>Settings
                               <b class="caret"></b>
                            </p>
                        </a>
                        <div class="collapse" id="setting">
                            <ul class="nav">
                                <li><a href="{{action('SettingController@index')}}">Setting</a></li>
                                <li><a href="{{action('SettingController@createNavigation')}}">Setting Navigation</a></li>
                            </ul>
                        </div>
                    </li>
                @endif
            </ul>
        </div>
    </div>

    <div class="main-panel">
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-minimize">
                    <button id="minimizeSidebar" class="btn btn-warning btn-fill btn-round btn-icon">
                        <i class="fa fa-ellipsis-v visible-on-sidebar-regular"></i>
                        <i class="fa fa-navicon visible-on-sidebar-mini"></i>
                    </button>
                </div>
                <div class="navbar-header">
                    <button type="button" class="navbar-toggle" data-toggle="collapse">
                        <span class="sr-only">Toggle navigation</span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                        <span class="icon-bar"></span>
                    </button>
                    @yield('header')
                </div>
                <div class="collapse navbar-collapse">

                    <form class="navbar-form navbar-left navbar-search-form" action="/search/items" role="search" method="POST">
                        {{ csrf_field() }}
                        <div class="input-group">
                            <span class="input-group-addon"><i class="fa fa-search"></i></span>
                            <input type="text" name="q" value="" class="form-control" placeholder="Search...">
                        </div>
                    </form>

                    <ul class="nav navbar-nav navbar-right">
                        @if(Auth::user()->id == 1 || Auth::user()->id == 2)
                            <li>
                                <a href="charts.html"><i class="fa fa-line-chart"></i><p>Stats</p></a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-gavel"></i>
                                    <p class="hidden-md hidden-lg">
                                        Actions
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Create New Post</a></li>
                                    <li><a href="#">Manage Something</a></li>
                                    <li><a href="#">Do Nothing</a></li>
                                    <li><a href="#">Submit to live</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#">Another Action</a></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                    <i class="fa fa-bell-o"></i>
                                    <span class="notification">5</span>
                                    <p class="hidden-md hidden-lg">
                                        Notifications
                                        <b class="caret"></b>
                                    </p>
                                </a>
                                <ul class="dropdown-menu">
                                    <li><a href="#">Notification</a></li>
                                    <li><a href="#">Another notification</a></li>
                                </ul>
                            </li>
                        @endif
                        <li class="dropdown dropdown-with-icons">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <i class="fa fa-list"></i>
                                <p class="hidden-md hidden-lg">
                                    More
                                    <b class="caret"></b>
                                </p>
                            </a>
                            <ul class="dropdown-menu dropdown-with-icons">
                                @if(Auth::user()->id == 1 || Auth::user()->id == 2)
                                    <li><a href="#"><i class="pe-7s-mail"></i> Messages</a></li>
                                    <li><a href="#"><i class="pe-7s-help1"></i> Help Center</a></li>
                                    <li><a href="#"><i class="pe-7s-tools"></i> Settings</a></li>
                                    <li class="divider"></li>
                                    <li><a href="#"><i class="pe-7s-lock"></i> Lock Screen</a></li>
                                @endif
                                <li><a href="{{ url('/logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="text-danger"><i class="pe-7s-close-circle"></i>Log out</a></li>
                            </ul>
                            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </li>

                    </ul>
                </div>
            </div>
        </nav>

        <div class="content">
            <div class="container-fluid">
                 @yield('content')
            </div>
        </div>

        <footer class="footer">
            <div class="container-fluid">
                <nav class="pull-left">
                    {{-- <ul>
                        <li><a href="#">Home</a></li>
                        <li><a href="#">Company</a></li>
                        <li><a href="#">Portfolio</a></li>
                        <li><a href="#">Blog</a></li>
                    </ul> --}}
                </nav>
                <p class="copyright pull-right">
                    &copy; {{date('Y')}} <a href="http://www.pickinside.com" target="_blank">pickinside</a>, made with love for a better web
                </p>
            </div>
        </footer>

    </div>
</div>


</body>
    <script src="/js/bootstrap.min.js" type="text/javascript"></script>
    <script src="/js/jquery.validate.min.js"></script>
    <script src="/js/moment.min.js"></script>
    <script src="/js/bootstrap-datetimepicker.js"></script>
    <script src="/js/bootstrap-selectpicker.js"></script>
    <script src="/js/bootstrap-checkbox-radio-switch-tags.js"></script>
    <script src="/js/chartist.min.js"></script>
    <script src="/js/bootstrap-notify.js"></script>
    <script src="/js/sweetalert2.js"></script>
    <script src="/js/jquery-jvectormap.js"></script>
    <script src="https://maps.googleapis.com/maps/api/js?key=AIzaSyCOeGmyX-gl-BqGDrCvYd1qeEWstO9553Y"></script>
    <script src="/js/jquery.bootstrap.wizard.min.js"></script>
    <script src="/js/bootstrap-table.js"></script>
    <script src="/js/jquery.datatables.js"></script>
    <script src="/js/fullcalendar.min.js"></script>
    <script src="/js/light-bootstrap-dashboard.js"></script>
    <script src="/js/jquery.sharrre.js"></script>
    <script src="/js/demo.js"></script>
    <script src="/js/app.js"></script>
    @yield('extrajs')
    <script>
        (function($){
            "use strict";
            $('#btn-advance').click(function(e){
                swal({  title: 'Theme detail',
                    html:
                        '<div class="row"><div class="col-sm-3 text-right">Title:</div><div class="col-sm-9 text-left"><input id="advance-title" type="checkbox" value="title"></div></div>'
                    });
            });
            $('#advance-title').click(function(event) {
                console.log('dsafdsafdsf')
            });
        })(jQuery)
    </script>
</html>
