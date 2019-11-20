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
    <style>
        .card-body .title {
            margin-left: 90px;
        }

    </style>
    <style>
            .card-img-top {
                width: 100%;
                height: 100%;
            }

          
    
        </style>
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
                                <img src = "{{asset('public/img')}}/<?php echo $img ?>" class="user-image" alt="User Image">
                                <span class="hidden-xs"><?php echo $name ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="{{asset('public/img')}}/<?php echo $img ?>" class="img-circle" alt="User Image">

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
                        <img src= "{{asset('public/img')}}/<?php echo $img ?>" class="img-circle" alt="User Image">
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
                            <i class="fa fa-dashboard"></i> <span>Loại sản phẩm</span>
                            <span class="pull-right-container">
                                <i class="fa fa-angle-left pull-right"></i>
                            </span>
                        </a>
                    
                        <ul class="treeview-menu">
                                <li><a href="{{asset('/')}}"><i class="fa fa-circle-o"></i> All product</a></li>
                            <?php foreach ($lsProductType as $key => $value) { ?>
                                 <li><a href="{{asset('/ProductByProductType/')}}/<?php echo $value->id?>"><i class="fa fa-circle-o"></i> <?php echo $value->name ?></a></li>
                           <?php }?>
                         
                        </ul>
                    </li>

                    <!-- /.sidebar -->
        </aside>

        <!-- Content Wrapper. Contains page content -->
        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Payment
                    <small>Preview page</small>
                </h1>
            </section>
            <br />
            <hr />
            <?php 
             foreach ($lsProductPayment as $key => $item) { ?>
                <div class="card row">
                        <div class="col-sm-3">
                            <img class="card-img-top" src="{{asset('public/Images')}}/<?php echo $item['Img']?>" alt="Card image cap">
                            <div class="card-body">
                                <div class="card-title"><b style="font-size:22px"><?php echo $item['Name']?></b></div>
                                <p class="card-text"><i>Giá: <?php echo $item['Price']?></i></p>
                            </div>
                        </div>
                       
                        <div class="col-sm-1">
                                <a href="{{asset('/MinusProductSession')}}/<?php echo $item['Id']?>"><b style="font-size:30px"> - </b></a> 
                                
                        </div>
                        <div class="col-sm-1">
                                <b style="font-size:30px"> <?php echo $item['quantity']?> </b>
                        </div>
                        <div class="col-sm-1">
                                <a href="{{asset('/AddProductSession')}}/<?php echo $item['Id']?>"><b style="font-size:30px"> + </b></a> 
                        </div>
                        <div class="col-sm-4">
                                <a href="{{asset('/RemoveProductSession')}}/<?php echo $item['Id']?>" class="btn btn-danger">Delete</a>
                        </div>
                    </div>
        
            <?php } ?>
            <div class="pay">
                    <b style="font-size:40px"> Tổng tiền: <?php echo $totalPay ?></b> <br/>
                    <a href="{{asset('/Payment')}}" class="btn btn-info">Thanh toán</a>
                    <a href="{{asset('/')}}" class="btn btn-warning">Quay lại</a>

                   
            </div>
           
        </div>


        <!-- /.row -->

        <!-- =========================================================== -->





        <!-- Add the sidebar's background. This div must be placed
       immediately after the control sidebar -->
        <div class="control-sidebar-bg"></div>
    </div>
    <!-- ./wrapper -->

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
