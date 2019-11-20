<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Widgets</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.7 -->
    <link rel="stylesheet" href="{{asset('public/bower_components/bootstrap/dist/css/bootstrap.min.css') }}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('public/bower_components/font-awesome/css/font-awesome.min.css') }}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('public/bower_components/Ionicons/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('public/dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('public/plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
  <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
  <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
  <![endif]-->

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">

        <header class="main-header">
            <!-- Logo -->
            <a href="../index2.html" class="logo">
                <!-- mini logo for sidebar mini 50x50 pixels -->
                <span class="logo-mini"><b>A</b>LT</span>
                <!-- logo for regular state and mobile devices -->
                <span class="logo-lg"><b>User </b>LTE</span>
            </a>
            <!-- Header Navbar: style can be found in header.less -->
            <nav class="navbar navbar-static-top">
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- Tasks: style can be found in dropdown.less -->
                        
                        <!-- User Account: style can be found in dropdown.less -->
                        <li class="dropdown user user-menu">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <img src= "public/img/<?php echo $img ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $name ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{asset('public/img')}}/<?php echo $img ?>"class="img-circle" alt="User Image">

                                    <p>
                                        Alexander Pierce - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-right">
                                        <a href="{{asset('/Logout')}}" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                        <!-- Control Sidebar Toggle Button -->
                        <li>
                            <a href="#" data-toggle="control-sidebar"><i class="fas fa-sign-out-alt"></i></a>
                        </li>
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
                        <img src="{{asset('public/img')}}/<?php echo $img ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo $name ?></p>
                      
                    </div>
                </div>
                <!-- search form -->
             
                <!-- /.search form -->
                <!-- sidebar menu: : style can be found in sidebar.less -->
                <ul class="sidebar-menu" data-widget="tree">
                    <li class="header">MAIN NAVIGATION</li>
                    <li class="treeview">
                      
                        <a href="#">
                            <i class="fa fa-dashboard"></i> <span>Quản lý</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                        <ul class="treeview-menu">
                            <li><a href="{{asset('/ProductTypeManagement')}}"><i class="fa fa-circle-o"></i> Loại sản phẩm</a></li>
                            <li><a href="{{asset('/ProductManagement')}}"><i class="fa fa-circle-o"></i>  Sản phẩm </a></li>
                            <li><a href="{{asset('/UserManagement')}}"><i class="fa fa-circle-o"></i> Người dùng </a></li>
                            <li><a href="{{asset('/CartPaymentManagement')}}"><i class="fa fa-circle-o"></i> Đơn hàng </a></li>
                        </ul>
                    </li>

                    <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
          <!-- Content Header (Page header) -->
          <section class="content-header">
            <h1>
              Home Admin
              <small>Preview page</small>
            </h1>
          </section>
      
          <br/>
          <hr/>
            <!-- Small boxes (Stat box) -->
            <div class="row">
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-aqua">
                  <div class="inner">
                    <h3><?php echo $countPayment?></h3>
      
                    <p>Đơn hàng</p>
                  </div>
                  <div class="icon">
                    <i class="fa fa-shopping-cart"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-green">
                  <div class="inner">
                    <h3><?php echo $countProductType?><sup style="font-size: 20px"></sup></h3>
      
                    <p>Loại sản phẩm</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-stats-bars"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-yellow">
                  <div class="inner">
                    <h3><?php echo $countUser?></h3>
      
                    <p>Người dùng</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-person-add"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
              <div class="col-lg-3 col-xs-6">
                <!-- small box -->
                <div class="small-box bg-red">
                  <div class="inner">
                    <h3><?php echo $countProduct?></h3>
      
                    <p>Sản phẩm</p>
                  </div>
                  <div class="icon">
                    <i class="ion ion-pie-graph"></i>
                  </div>
                  <a href="#" class="small-box-footer">
                    More info <i class="fa fa-arrow-circle-right"></i>
                  </a>
                </div>
              </div>
              <!-- ./col -->
            </div>
            <!-- /.row -->
      
   
    

    <!-- jQuery 3 -->
    <script src="{{asset('public/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- Slimscroll -->
    <script src="{{asset('public/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
    <!-- FastClick -->
    <script src="{{asset('public/bower_components/fastclick/lib/fastclick.js')}}"></script>
    <!-- AdminLTE App -->
    <script src="{{asset('public/dist/js/adminlte.min.js')}}"></script>
    <!-- AdminLTE for demo purposes -->
    <script src="{{asset('public/dist/js/demo.js')}}"></script>
</body>

</html>
