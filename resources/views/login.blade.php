<!DOCTYPE html>
<html lang="en">
    
<head>
        <title>Matrix Admin</title><meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
		<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/bootstrap.min.css" />
		<link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/bootstrap-responsive.min.css" />
        <link rel="stylesheet" href="{{ URL::asset('') }}plugins/css/matrix-login.css" />
        <link href="{{ URL::asset('') }}plugins/font-awesome/css/font-awesome.css" rel="stylesheet" />
		<link href='http://fonts.googleapis.com/css?family=Open+Sans:400,700,800' rel='stylesheet' type='text/css'>
    </head>
    <body class="body">
        <div id="loginbox">            
            <form id="loginform" class="form-vertical" action="{{url(route('login.check'))}}" method="POST">
				 <div class="control-group normal_text"> <h3><img src="{{ URL::asset('') }}plugins/img/logo.png" alt="Logo" /></h3></div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lg"><i class="icon-user"> </i></span><input type="text" placeholder="email" name="email" />
                        </div>
                    </div>
                </div>
                <div class="control-group">
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_ly"><i class="icon-lock"></i></span><input type="password" name="password" password="password" placeholder="Password" />
                        </div>
                    </div>
                </div>
                <div class="form-actions">
                   <input type="hidden" name="_token" value="{{ csrf_token() }}">
                    <input type="submit" name="submit" value="login" class="btn btn-success pull-right" class="">
                </div>
            </form>
            <form id="recoverform" action="#" class="form-vertical">
				<p class="normal_text">Enter your e-mail address below and we will send you instructions how to recover a password.</p>
				
                    <div class="controls">
                        <div class="main_input_box">
                            <span class="add-on bg_lo"><i class="icon-envelope"></i></span><input type="text" placeholder="E-mail address" />
                        </div>
                    </div>
               
                <div class="form-actions">
                    <span class="pull-left"><a href="#" class="flip-link btn btn-success" id="to-login">&laquo; Back to login</a></span>
                    <span class="pull-right"><a class="btn btn-info"/>Reecover</a></span>
                </div>
            </form>
        </div>
        
        <script src="{{ URL::asset('') }}plugins/js/jquery.min.js"></script> 
        <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script> 
        <script src="{{ URL::asset('') }}plugins/js/matrix.login.js"></script> 
        @include('layouts.errorMessage')
    </body>

</html>
