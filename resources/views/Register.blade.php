<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Registration Page</title>
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
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">

    <!-- Google Font -->
    <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

<body class="hold-transition register-page">
    <div class="register-box">
        <div class="register-logo">
            <a href="../../index2.html"><b>Admin</b>LTE</a>
        </div>

        <div class="register-box-body">
            <p class="login-box-msg">Register a new membership</p>

            <?php if(Session::has('errors')){
        $errors =  Session::get('errors');
        foreach ($errors->all() as $key => $error) {
    ?>
            <div class="alert alert-danger">
                <?php echo $error ?>
                <br />
            </div>
            <?php }} ?>
            <?php if(Session::has('error')){
          $error = Session::get('error');?>
            <div class="alert alert-danger">
                <?php echo $error ?>
                <br />
            </div>
            <?php }?>

            <form action="{{asset('/Register')}}" method="post"  enctype="multipart/form-data">
                @csrf
                <div class="form-group has-feedback">
                    <input type="text" class="form-control" name='name' placeholder="Full name" value="{{old('name')}}">
                    <span class="glyphicon glyphicon-user form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="email" class="form-control" name='email' placeholder="Email" value="{{old('email')}}">
                </div>
                Image: <input type = 'file' name = 'myfile' > <br/>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name='password' placeholder="password">
                    <span class="glyphicon glyphicon-lock form-control-feedback"></span>
                </div>
                <div class="form-group has-feedback">
                    <input type="password" class="form-control" name='retypepassword' placeholder="Retype password">
                    <span class="glyphicon glyphicon-log-in form-control-feedback"></span>
                </div>
                <div class="row">
                    <div class="col-xs-8">

                    </div>
                    <!-- /.col -->
                    <div class="col-xs-4">
                        <button type="submit" class="btn btn-primary btn-block btn-flat">Register</button>
                    </div>
                    <!-- /.col -->
                </div>
            </form>



            <a href="{{asset('/Login')}}" class="text-center">I already have a membership</a>
        </div>
        <!-- /.form-box -->
    </div>
    <!-- /.register-box -->

    <!-- jQuery 3 -->
    <script src="{{asset('public/bower_components/jquery/dist/jquery.min.js')}}"></script>
    <!-- Bootstrap 3.3.7 -->
    <script src="{{asset('public/bower_components/bootstrap/dist/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('public/plugins/iCheck/icheck.min.js')}}"></script>
    <script>
        $(function () {
            $('input').iCheck({
                checkboxClass: 'icheckbox_square-blue',
                radioClass: 'iradio_square-blue',
                increaseArea: '20%' /* optional */
            });
        });

    </script>
</body>

</html>
