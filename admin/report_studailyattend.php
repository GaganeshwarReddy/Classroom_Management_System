
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");

$sql4="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key WHERE course_master.status=0";
$result4=mysqli_query($link,$sql4);
$option4 ="";
while($row4=mysqli_fetch_array($result4)){
	$option4 = $option4."<option value=$row4[course_key]>$row4[course_nme]-$row4[facalty_nme]</option>";			//Load Reagon Name
}


if(isset($_POST['btn_sele'])){
	
	$nm1=$_POST['sele_course'];
	$nm2=$_POST['sele_semester'];
	
	echo "<script>
			window.location.href='report_studailyattend.php?cs=$nm1&curyr=$nm2';
		</script>";
}

?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Student Daily Attendance</title>
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
							<form method="post" name="f1">
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Course </label> 
									<select class="form-control input-sm" name="sele_course" onchange="this.form.submit();">
										<?php
											 if(isset($_GET['cs'])){
													
													$sql2="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
															  WHERE course_master.course_key='$_GET[cs]'";
													$result2 = mysqli_query($link,$sql2);
													while($row2=mysqli_fetch_array($result2)){
														$couse_nme=$row2['course_nme']." - ".$row2['facalty_nme'];
													}

													echo "<option value=$_GET[cs]>$couse_nme</option>";
													
												}
												else if(isset($_POST['sele_course'])){
													$sql7="SELECT * FROM course_master INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
															  WHERE course_master.course_key='$_POST[sele_course]'";
													$result7 = mysqli_query($link,$sql7);
													while($row7=mysqli_fetch_array($result7)){
														$course_key=$row7['course_key'];
														$couse_nme1=$row7['course_nme']." - ".$row7['facalty_nme'];
													}

													echo "<option value=$course_key>$couse_nme1</option>";
													echo $option4;
												}
												else{
												
													  echo "<option value='' disabled selected hidden>Please Choose.............</option>";
													  echo $option4;
												}
                                          ?>
									</select>
								</div> 
								<div class="form-group">                
									<label class="control-label"><font color="red">&lowast;</font>Semester </label> 
									<select class="form-control input-sm" name="sele_semester" required>
										<?php
											
											if(isset($_GET['curyr'])){
												
												$sql1="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
																		 INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
																		WHERE cur_statusofbatch_details.coursemas_key='$_GET[cs]' AND 
																			  cur_statusofbatch_details.status=0
																		ORDER BY cur_statusofbatch_details.curstatusbatch_detail_key DESC";
												$result1=mysqli_query($link,$sql1);
												$option1 ="";
												while($row1=mysqli_fetch_array($result1)){
															
															$option1 = $option1."<option value=$row1[curstatusbatch_detail_key]>$row1[acadamic_yer]-$row1[batch_code]-$row1[year_nme]</option>";
												}
												
												$sql3="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
																		 INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
																		WHERE cur_statusofbatch_details.curstatusbatch_detail_key='$_GET[curyr]' AND 
																			  cur_statusofbatch_details.status=0";
												$result3=mysqli_query($link,$sql3);
												$option3 ="";
												while($row3=mysqli_fetch_array($result3)){
															
															$option3 = $option3."<option value=$row1[curstatusbatch_detail_key]>$row3[acadamic_yer]-$row3[batch_code]-$row3[year_nme]</option>";
												}
												
												echo $option3;
												echo $option1;
											}
											if(isset($_POST['sele_course'])){
												$sql1="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
																		 INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
																		WHERE cur_statusofbatch_details.coursemas_key='$_POST[sele_course]' AND 
																			  cur_statusofbatch_details.status=0
																		ORDER BY cur_statusofbatch_details.curstatusbatch_detail_key DESC";
												$result1=mysqli_query($link,$sql1);
												$option1 ="";
												while($row1=mysqli_fetch_array($result1)){
															
															$option1 = $option1."<option value=$row1[curstatusbatch_detail_key]>$row1[acadamic_yer]-$row1[batch_code]-$row1[year_nme]</option>";
												}
												
												echo "<option value='' disabled selected hidden>Please Choose.............</option>";
												echo $option1;
											}
                                        ?>
									</select>
								</div>
								<button class="btn btn-lg btn-primary btn-block" name='btn_sele' type="submit">Select</button>
							</form>
						</div>
					</section>
				</div>
			</div>
			
			<?php
			if(isset($_GET['cs']) && isset($_GET['curyr'])){
				$sql5="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
											 INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
											 INNER JOIN course_master ON batch_master.course_key=course_master.course_key
											 INNER JOIN facalty_master ON batch_master.facalty_key=facalty_master.facalty_key
											 WHERE cur_statusofbatch_details.curstatusbatch_detail_key='$_GET[curyr]' AND 
													cur_statusofbatch_details.status=0";
				$result5 = mysqli_query($link,$sql5);		
				while($row5=mysqli_fetch_array($result5)){	
					$course_key=$row5['course_key'];
					$yer_key=$row5['year_key'];
				}			
			?>
				<div class="row">
					<div class="col-md-2">
					
					</div>
					<div class="col-md-8">
						<section class="panel panel-transparent">
							<div class="panel-body panel-transparent">
								<?php
								$sql6="SELECT * FROM subject_master WHERE course_key='$course_key' AND year_key='$yer_key' AND status=0";
								$result6 = mysqli_query($link,$sql6);		
								while($row6=mysqli_fetch_array($result6)){	
								?>
									<a href="tcpdf/reports/studailyattend.php?cs=<?php echo $_GET['cs']; ?>&curyr=<?php echo $_GET['curyr']; ?>&sub=<?php echo $row6['subject_key']; ?>" target="_blank"><button class="btn btn-md btn-success btn-block"><?php echo $row6['subject_name']; ?></button>
									<br>
								<?php
								}			
								?>
							
							</div>
						</section>
					</div>
				</div>
			<?php
			}
			?>
			
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
    </body>
</html>
