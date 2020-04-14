<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="" type="image/png" />
    <title>VKBot</title>
	<!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/bootstrap/dist/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/font-awesome/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('adminlte/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/AdminLTE.min.css')}}">
    <!-- AdminLTE Skins. Choose a skin from the css/skins
         folder instead of downloading all of them to reduce the load. -->
    <link rel="stylesheet" href="{{asset('adminlte/dist/css/skins/_all-skins.min.css')}}">

{{--    <link rel="stylesheet" href="{{asset('css/my.css')}}"> --}}

    <!-- Google Font -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">

    <style>
        .wrapper{
            overflow:hidden
        }
        .modal-body {
            overflow-y: auto;
        }
        .modal-dialog {
            width: 100%;
        }
        .loading{
            /*position: absolute;
            margin-top: -25px;
            right: 150px;*/
            margin-left:40%;
            visibility: hidden;
        }
        .mess {
            padding: 5px;
            margin: 10px 5px 10px 5px;
            color: #000;
            border-radius: 8px;
            width: 75%;
            text-align: left;
            -webkit-box-shadow: 1px 1px 6px -2px rgba(105,105,105,1);
            -moz-box-shadow: 1px 1px 6px -2px rgba(105,105,105,1);
            box-shadow: 1px 1px 6px -2px rgba(105,105,105,1);
        }
        .messprep {
            background-color: #fff;
            color: #aaa;
            float: right;
        }
        .messout {
            background-color: #fff;
            float: right;
        }
        .messin {
            background-color: #def1fd;
        }
        .nobutton {
            border: none;
        }
        li {
            list-style-type: none;
            padding: 6px;
        }
        .tabl {
            width: 100%;
        }
        .tabl-top {
            background-color: #f4f4f4;
        }
        .tabl-right {
            float: right;
        }
        .tabl-right-1 {
            position: absolute;
            right: 20px;
        }
        .tabl-right-2 {
            position: absolute;
            right: 60px;
        }
        .tabl-right-3 {
            position: absolute;
            right: 110px;
        }
        .tabl-right-4 {
            position: absolute;
            right: 200px;
        }
        .tabl-right-5 {
            position: absolute;
            right: 280px;
        }
        .tabl-left-1 {
            position: absolute;
            left: 150px;
        }
        .user-name{
            color: black;
        }
        .row-10 {
            background-color: #f9fcd8;
        }
        .row-20 {
            background-color: #f8fdbc;
        }
        .row-1 {
            background-color: #def1fd;
        }
        .row-2 {
            background-color: #f1f8fd;
        }
        .txt-grey {
            color: #aaa;
        }
        .caret-right {
            margin-top: -6px;
            float: right;
        }
        .caret-right2 {
            margin-top: 8px;
            float: right;
        }
        .max-width {
            width: 100%;
        }
    </style>
    <script src="http://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>

    <!-- jQuery 3 -->
<!--<script src="{{asset('adminlte/bower_components/jquery/dist/jquery.min.js')}}"></script>-->

    <!-- Bootstrap 3.3.7 -->
<!--<script src="{{asset('adminlte/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>-->
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

</head>
<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">

    <header class="main-header">
        <!-- Logo -->
        <a href="{{route('bot.admin.index.index')}}" class="logo">
            <!-- mini logo for sidebar mini 50x50 pixels -->
            <span class="logo-mini"><b>A</b>LT</span>
            <!-- logo for regular state and mobile devices -->
            <span class="logo-lg"><b>Admin</b> Panel</span>
        </a>
        <!-- Header Navbar: style can be found in header.less -->
        <nav class="navbar navbar-static-top">
            <!-- Sidebar toggle button-->
            <a href="#" class="sidebar-toggle" data-toggle="push-menu" role="button">
                <span class="sr-only">Toggle navigation</span>
            </a>

            <div class="navbar-custom-menu">
                <ul class="nav navbar-nav">

                    <li class="dropdown user user-menu">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                            <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                            <span class="hidden-xs">{{ucfirst (Auth::user()->name) }} </span>
                        </a>
                        <ul class="dropdown-menu">
                            <!-- User image -->
                            <li class="user-header">
                                <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                                <p>
                                    {{ ucfirst(Auth::user()->name) }}
                                </p>

                            </li>
                            <!-- Menu Footer-->
                            <li class="user-footer">
                                <div class="pull-left">
                                    <a href="" class="btn btn-default btn-flat">Profile</a>
                                </div>
                                <div class="pull-right">
                                    <a href="{{ route('logout') }}" onclick="event.preventDefault();
                                                     document.getElementById('logout-form').submit();"
                                       class="btn btn-default btn-flat">Sign out</a>
                                    <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                        {{ csrf_field() }}
                                    </form>

                                </div>
                            </li>
                        </ul>
                    </li>
                    <!-- Control Sidebar Toggle Button -->

                </ul>
            </div>
        </nav>
    </header>
    <!-- Left side column. contains the logo and sidebar -->
    <aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
            <!-- Sidebar user panel -->
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{asset('adminlte/dist/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">
                </div>
                <div class="pull-left info">
                    <p>{{ ucfirst (Auth::user()->name) }} </p>
                    <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
                </div>
            </div>

            <!-- sidebar menu: : style can be found in sidebar.less -->
            <ul class="sidebar-menu" data-widget="tree">
                <li class="header">Menu</li>
                <!-- Optionally, you can add icons to the links -->
                <li><a href="/admin/index"><i class="fa fa-hand-spock-o"></i> <span>Overview</span></a></li>
                <li><a href="{{ route('bot/admin.communication.index') }}"><i class="fa fa-comments-o"></i> <span>Communication</span></a></li>
                <li><a href=""><i class="fa fa-tasks"></i> <span>Tasks</span></a></li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-list-alt"></i> <span>Lists</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="">VK lists</a></li>
                        <li><a href="">Own lists</a></li>
                        <li><a href="{{ route('bot/admin.lists.categories.index') }}">Categories</a></li>
                    </ul>
                </li>
                <li class="treeview">
                    <a href="#"><i class="fa fa-gear"></i> <span>Preferences</span>
                        <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
                    </a>
                    <ul class="treeview-menu">
                        <li><a href="">Proxy</a></li>
                        <li><a href="">User Agents</a></li>
                        <li><a href="">Options...</a></li>
                    </ul>
                </li>


            <!-- search form -->

            <form action="" method="get" autocomplete="off"  style="position: absolute;">
                <div class="input-group">
                    <input id="search" name="search" type="text" class="form-control" placeholder="Search...." style="color: whitesmoke; background-color:#20262a; border: none;">
                    <span class="input-group-btn">
                        <button type="submit" value="" class="btn btn-flat" style="background-color: #ebeff4;"><i class="fa fa-search"></i></button>
                    </span>
                </div>
            </form>



            <!-- /.search form -->
        </section>
        <!-- /.sidebar -->
    </aside>

    <!-- Content Wrapper. Contains page content -->
    <div class="content-wrapper">

        <main id="app">
         {{--@include('bot.admin.components.result_messages')--}}
            @yield('content')
        </main>
    </div>
    <!-- /.content-wrapper -->
    <footer class="main-footer">
        <div class="pull-right hidden-xs">
            <b>Version</b> 1.0
        </div>
        <strong>Copyright &copy; 2020  All rights reserved.</strong>
    </footer>

    <div class="control-sidebar-bg"></div>
</div>
<!-- ./wrapper -->



<script>
    var pathd = '{{PATH}}';
</script>

<!-- Validator -->
<script src="{{asset('js/validator.js')}}"></script>
<!-- Search -->

<!-- AdminLTE App -->
<script src="{{asset('adminlte/dist/js/adminlte.min.js')}}"></script>

<!-- === = ===  -->
</body>
</html>
