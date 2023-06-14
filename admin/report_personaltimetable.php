
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");




?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Personal Time Table</title>
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
	   <?php include('navi.php') ?>
       <br>
	   <br>
	   <br>
		
			<div class="row">
                <div class="col-md-6">
				
				</div>
				<div class="col-md-5">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<form method="post" name="f1" action="tcpdf/reports/personaltimetable.php" target="_blank">
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Lecturer </label> 
									<select class="form-control input-sm" name="sele_lec" required>
										<?php
													 echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													$sql1="SELECT * FROM lecture_master WHERE status=0";
													$result1 = mysqli_query($link,$sql1);
													while($row1=mysqli_fetch_array($result1)){
														echo "<option value=$row1[lecturemas_key]>$row1[lecture_nme]</option>";
													}
                                          ?>
									</select>
								</div> 
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Start Date </label> 
									<input type="Date" class="form-control input-sm" name="start_dte" required placeholder="YYYY-MM-DD">
								</div> 
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>End Date </label> 
									<input type="Date" class="form-control input-sm" name="end_dte" required placeholder="YYYY-MM-DD">
								</div> 
								<button class="btn btn-lg btn-primary btn-block" name='btn_sele' type="submit">Report Generate</button>
							</form>
						</div>
					</section>
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
</html>
