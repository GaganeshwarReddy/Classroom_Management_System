<?php
error_reporting(0);
 include 'conn.php';		
 ?>


<?php
  session_start();
  $user_check =$_SESSION['login_user'];
  $message="Change Your Password";

  if(!isset($_SESSION['login_user'])){
    header("location:index.php");
  }
?>

<?php
  if(isset($_POST['btn_newpwadd'])){
       $nwp=$_POST['txt_newpassword'];
       $nwcp=$_POST['txt_confirmpassword'];

       if($nwp==""){
            $message="Please Enter the New Password";
       }
       else if($nwcp==""){
             $message="Please Enter the Confirm Password";
       }
       else if($nwp!==$nwcp){
            $message="Not Match the Password";
       }
       else if($nwcp=="9900" || $nwcp=="9900"){
              $message="This Password Not Used";
       }
       else{
            $password=MD5($_POST['txt_newpassword']);
            $sql13 = "UPDATE user_master SET password='$password' WHERE user_nme='$user_check'";
            mysqli_query($link, $sql13);
            header("location:index.php");
       }

  }


?>

<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Lecturer Assign Subjects</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
      <link rel="stylesheet" media="screen" href="css/common.css">
    </head>
    <body class="bc" style="background-image: url('images/a2.jpg')">

		<br>
		<br>

        <div class="row">
                  <div class="col-lg-3">
                   
                  </div>

                  <div class="col-lg-6">
                    <div class="row">
                        <div class="col-lg-12">
							
							<?php
								if($message=="Change Your Password"){
							?>
								<div class="alert alert-info">
									<a class="close" data-dismiss="alert" href="#">&times;</a>
								   <strong><?php echo $message; ?></strong>
								</div>
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
									<section class="panel panel-default">
                              			<div class="panel-body panel-transparent">
										 <form role="form" id="form1" name="form1" method="post" action="">
										  <div class="form-group" align="center">
												<div class="alert alert-success">
													<strong>User Name: <?php echo $user_check; ?></strong>
												</div>
												
												<input type="hidden" name="txt_username" class="form-control"  value="<?php 
												 echo $user_check;
												?>">
											</div>
											 <div class="form-group" >
												<label>New Password</label>
												<input type="password" name="txt_newpassword" class="form-control" required placeholder="Please Enter Your New password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Must contain at least one number and one uppercase and lowercase letter, and at least 8 or more characters">
											</div>
											<div class="form-group" >
												<label>Confirm Password</label>
												<input type="password" name="txt_confirmpassword" class="form-control" required placeholder="Please Confirm password" pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}" title="Please check that you've entered and confirmed your password!">
											</div> 
											<button type="submit" name="btn_newpwadd" class="btn btn-lg btn-primary btn-block">New Password</button>
										  </div>
										 </form>
									</section>
                            </div>
                        </div>
                    </div>  
                </div> 
				
				
				 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>


</body>

<?php
mysqli_close($link);
?>


</html>
