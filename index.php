<?php
include 'admin/conn.php';
error_reporting(0);
 ob_start();
 ?>
 
 <?php
$message="Welcome";

session_start();
if(isset($_POST['btn_login'])){
	if (!empty($_POST['txt_username']) && !empty($_POST['txt_password'])) {
			   
			 $username=$_POST['txt_username'];
			 $password=MD5($_POST['txt_password']);
			
			$username=stripslashes($username);
			$password=stripslashes($password);
			
			$username = mysqli_real_escape_string($link,$username);
			$password = mysqli_real_escape_string($link,$password);
		 
		$sql1="SELECT * FROM student_master WHERE student_id='$username' AND status=0";
		$result1 = mysqli_query($link,$sql1);
		if(mysqli_num_rows($result1)>0){
			
			$sql2="SELECT * FROM student_master WHERE student_id='$username' AND status=0";
			$result2 = mysqli_query($link,$sql2);
			while($row2=mysqli_fetch_array($result2)){
						$unme=$row2['student_id'];
						$pass=$row2['password'];
						$userkey=$row2['student_key'];
			}
			
			if($unme==$username){
					
					if($pass==$password){	
						$_SESSION['login_user'] = $username;
						$_SESSION['user_key'] = $userkey;
						header("location:student/dashboard.php");
						session_register("username","ukey");
					}
					else{
						 $message = "Your Password invalid";
					}
			}
			else{
				$message = "Your UserName is invalid";
			}

		}
		else{
				$sql = "SELECT * FROM user_master WHERE user_nme = '$username' and status=0";
				$result = mysqli_query($link,$sql);
				while($row=mysqli_fetch_array($result)){
			   
						$userlevel=$row['user_level'];
						$unme=$row['user_nme'];
						$pass=$row['password'];
						$userkey=$row['user_key'];
						$lec_key=$row['lec_key'];
				}
				 
				
				if($unme==$username){
					
					if($pass==$password){	
						if($userlevel=="admin"){

							  if($password=="8af95fe2ab1a54b488ef8efb3f3b0797"){ //9900
									$flag="true";
									$_SESSION['login_user'] = $username;
									$_SESSION['userlevel'] = $userlevel;
									$_SESSION['user_key'] = $userkey;
									header("location:admin/newpassword.php");
									session_register("username","userlevel","ukey");
							  }
							  else{
									$_SESSION['login_user'] = $username;
									$_SESSION['userlevel'] = $userlevel;
									$_SESSION['user_key'] = $userkey;
									header("location:admin/dashboard.php");
									session_register("username","userlevel","ukey");
							  }
						}
						if($userlevel=="lec"){

							  if($password=="8af95fe2ab1a54b488ef8efb3f3b0797"){ //9900
									$flag="true";
									$_SESSION['login_user'] = $username;
									$_SESSION['userlevel'] = $userlevel;
									$_SESSION['user_key'] = $userkey;
									$_SESSION['lec_key'] = $lec_key;
									 header("location:lec/newpassword.php");
									  session_register("username","userlevel","ukey","leckey");
							  }
							  else{
									$_SESSION['login_user'] = $username;
									$_SESSION['userlevel'] = $userlevel;
									$_SESSION['user_key'] = $userkey;
									$_SESSION['lec_key'] = $lec_key;
									header("location:lec/dashboard.php");
									session_register("username","userlevel","ukey","leckey");
							  }
						}
						else{
						  $message = "Your UserName or Password is invalid";
						}
					}
					else{
						  $message = "Your Password is invalid";
					}
				}
				else{
					
					 $message = "Your UserName is invalid";
					
				}
		}
	}
	else{
		$message = "Enter User Name and Password"; 
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
        <link rel="stylesheet" media="screen" href="admin/css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="admin/css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="admin/css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
        <link rel="stylesheet" media="screen" href="admin/css/common.css">
   
    

        <!-- Custom styles -->
        <style type="text/css">
            .alert{
                margin: 0 auto 20px;
            }
        </style>

    </head>
<body class="bc" style="background-image: url('admin/images/a2.jpg')">
       
				<div class="row align-items-end">
							
							<div class="col-md-7">
								<div class="col-md-2">
								<br>
								<br>
								<br>
								<br><br>
								<br><br>
								<br><br>
								<br><br>
								<br><br>
								<br>
								</div>
							</div>
				</div>
				<div class="row">
							
							<div class="col-md-7">
								<div class="col-md-2">
								
								</div>
								
								<div class="col-md-10">
									<section class="panel panel-transparent">
										<div class="panel-body panel-default">
											
													<center>
													<h4 style="font-weight:bold;">Educational Institue of India</h4>
													<h5 style="font-weight:bold;">&nbsp;&nbsp;&nbsp;No.1 Tech Collage in INDIA</h1>
													<br>
													<br>
													<h4 style="font-weight:bold;">Classroom Managment System</h4>
													<br>
													<br>
													</center>
									
										</div>
									</section>
								</div>
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