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
    <script src="https://kit.fontawesome.com/62b3b1101a.js" crossorigin="anonymous"></script>
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
                                <img src="public/img/<?php echo Auth::user()->img ?>" class="user-image"
                                    alt="User Image">
                                <span class="hidden-xs"><?php echo Auth::user()->name ?></span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- User image -->
                                <li class="user-header">
                                    <img src="public/img/avatar.png" class="img-circle" alt="User Image">

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
                        <img src="public/img/<?php  echo Auth::user()->img ?>" class="img-circle" alt="User Image">
                    </div>
                    <div class="pull-left info">
                        <p><?php echo Auth::user()->name ?></p>

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
                            <li><a href="{{asset('/ProductTypeManagement')}}"><i class="fa fa-circle-o"></i> Loại sản
                                    phẩm</a></li>
                            <li><a href="{{asset('/ProductManagement')}}"><i class="fa fa-circle-o"></i> Sản phẩm </a></li>
                            <li><a href="../index2.html"><i class="fa fa-circle-o"></i> Người dùng </a></li>
                            <li><a href="../index2.html"><i class="fa fa-circle-o"></i> Đơn hàng </a></li>
                        </ul>
                    </li>

                    <!-- /.sidebar -->
        </aside>

        <div class="content-wrapper">
            <!-- Content Header (Page header) -->
            <section class="content-header">
                <h1>
                    Create Notification
                    <small>Preview page</small>
                </h1>
            </section>

            <br />
            <hr />
            <?php if(Session::has('success')){
                $success = Session::get('success');?>
            <div class="alert alert-success">
                <?php echo $success ?>
                <br />
            </div>
            <?php }?>


            <div class="container-fluid">
                <?php if(Session::has('error')){
                            $error = Session::get('error');?>
                <div class="alert alert-danger">
                    <?php echo $error ?>
                    <br />
                </div>
                <?php }?>

                <?php if(Session::has('errors')){
                            $errors =  Session::get('errors');
                            foreach ($errors->all() as $key => $error) {
                        ?>
                <div class="alert alert-danger">
                    <?php echo $error ?>
                    <br />
                </div>
                <?php }} ?>
                <form action="{{asset('/CreateNotification')}}" method='POST' enctype="multipart/form-data">
                    @csrf

                    Loại tin tức: 
                    <select class="form-control" name="id_notification" id="">
                     
                        @foreach ($lsNotificationType as $key => $value) { ?>
                                <option value= {{$value->id}}>{{  $value->name }}</option>
                        @endforeach
                    </select>
                   

                    Tiêu đề: <div class="form-group">
                        <input type="text" class="form-control" name="title" id="" aria-describedby="helpId"
                            placehoder='Nhập tên' value="{{ old('title') }}" ?>
                    </div>
                    
                    Hình: <input type='file' name='myfile'>
                    <br /><br />
                    Chi tiết:<div class="form-group">
                        <textarea style ="height:400px" type="text" class="form-control" name="Description" id="" aria-describedby="helpId"
                            placehoder='Nhập mô tả'> {{ old('Description') }}</textarea>

                    </div>
                    <button type='submit' class='btn btn-success'>Submit</button>
                    <a href="{{asset('/NotificationManagement')}}" class="btn btn-warning">Back</a>
                </form>
            </div>
        </div>
        <div <!-- jQuery 3 -->
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
