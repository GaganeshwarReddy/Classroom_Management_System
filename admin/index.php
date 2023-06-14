<?php
include 'conn.php';
error_reporting(0);
 ob_start();
 ?>


<?php
$message="Welcome";

session_start();
if (isset($_POST['btn_login']) && !empty($_POST['txt_username']) && !empty($_POST['txt_password'])) {
           
         $username=$_POST['txt_username'];
         $password=MD5($_POST['txt_password']);
        
        $username=stripslashes($username);
        $password=stripslashes($password);
        
        $username = mysqli_real_escape_string($link,$username);
        $password = mysqli_real_escape_string($link,$password);
      
	  
      $sql = "SELECT * FROM user_master WHERE user_nme = '$username' and password = '$password' and status=0";
      $result = mysqli_query($link,$sql);
      while($row=mysqli_fetch_array($result)){
   
			$userlevel=$row['user_level'];
			$unme=$row['user_nme'];
			$pass=$row['password'];
			$userkey=$row['user_key'];
			
	   }
	 
    
    if($unme==$username && $pass==$password){
        if($userlevel=="admin"){

              if($password=="8af95fe2ab1a54b488ef8efb3f3b0797"){ //9900
                    $flag="true";
                    $_SESSION['login_user'] = $username;
                    $_SESSION['userlevel'] = $userlevel;
                    $_SESSION['user_key'] = $userkey;
                   
                     header("location:newpassword.php");
                     session_register("username","userlevel","ukey");
              }
              else{
                    $_SESSION['login_user'] = $username;
                    $_SESSION['userlevel'] = $userlevel;
                    $_SESSION['user_key'] = $userkey;
                    header("location:dashboard.php");
                    session_register("username","userlevel","ukey");
              }
        }

        else{
          //$message = "Your UserName or Password is invalid";
        }
    }
    else{
        
         //$message = "Your UserName or Password is invalid";
        
     }

	if($unme != $username){
		$message = " Your User Name Invalid";
	}
      
 }


?>
<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Login</title>
       <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
        <link rel="stylesheet" media="screen" href="css/common.css">
   
    

        <!-- Custom styles -->
        <style type="text/css">
            .alert{
                margin: 0 auto 20px;
            }
        </style>

        <!-- HTML5 shim and Respond.js IE8 support of HTML5 elements and media queries -->
        <!--[if lt IE 9]>
           <script type="text/javascript" src="js/html5shiv.js"></script>
           <script type="text/javascript" src="js/respond.min.js"></script>
        <![endif]-->
    </head>
    <body class="bc" style="background-image: url('images/a2.jpg')">
       
			<br>
			
			<div class="row">
				<div class="col-md-1">
				
				</div>
				<div class="col-md-10">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<div class="row">
								<div class="col-md-3">
									<img src="images/mlogo.png" style="width:80%" height="160px;">
								</div>
								<div class="col-md-9">
									<h2 style="font-weight:bold;">Department of Technical Education and Training</h2>
									<h1 style="font-weight:bold;">&nbsp;&nbsp;&nbsp;TECHNICAL COLLEGE - MATARA</h1>
								</div>
							</div>
						</div>
					</section>
				</div>
				
			</div>
		
			
            <div class="row">
				<div class="col-md-4">
				
				</div>
                <div class="col-md-4">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
						
						
						<?php
						if($message=="Welcome"){
						?>

						<?php
						}
						else{
						?>
						<div class="alert alert-danger">
						  <a class="close" data-dismiss="alert" href="#">&times;</a>
						  <strong><?php echo $message; ?></strong>
						</div>
					   <?php
						}
					   ?>
						<form method="post"  class="bootstrap-admin-login-form">
							<h4>Login</h4>
							<div class="form-group">
								<input class="form-control" type="text" name="txt_username" placeholder="Username">
							</div>
							<div class="form-group">
								<input class="form-control" type="password" name="txt_password">
										
							</div>
							
							<button class="btn btn-lg btn-primary btn-block" name='btn_login' type="submit">Login</button>
						</form>
						</div>
					</section>
                </div>
            </div>
        

       <script type="text/javascript" src="admin/js/jquery-2.0.3.min.js"></script>
        <script type="text/javascript" src="admin/js/bootstrap.min.js"></script>
        <script type="text/javascript">
            $(function() {
                // Setting focus
                $('input[name="email"]').focus();

                // Setting width of the alert box
                var alert = $('.alert');
                var formWidth = $('.bootstrap-admin-login-form').innerWidth();
                var alertPadding = parseInt($('.alert').css('padding'));

                if (isNaN(alertPadding)) {
                    alertPadding = parseInt($(alert).css('padding-left'));
                }

                $('.alert').width(formWidth - 2 * alertPadding);
            });
        </script>
    </body>
</html>