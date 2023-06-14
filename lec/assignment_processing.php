
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");
$cur_yr=date("Y");

if(isset($_GET['suk']) && isset($_GET['curyr'])){
	
	$sql16="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
															INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
															INNER JOIN course_master ON course_master.course_key=cur_statusofbatch_details.coursemas_key
															INNER JOIN facalty_master ON facalty_master.facalty_key=course_master.facalty_key
															WHERE cur_statusofbatch_details.curstatusbatch_detail_key='$_GET[curyr]' AND 
																 cur_statusofbatch_details.status=0";
	$result16 = mysqli_query($link,$sql16);
	while($row16=mysqli_fetch_array($result16)){
	
		$y7=$row16['batchmas_key'];
								
	}
	
	$sql22="SELECT * FROM assignmentmgt_master WHERE assignmentmgtmas_key='$_GET[ak]' AND status=0";
	$result22 = mysqli_query($link,$sql22);
	while($row22=mysqli_fetch_array($result22)){
		$sdte1=$row22['datos'];
	}
	
	
	
	if(isset($_POST['btn_assignmentstartupdate'])){
		
		$sql30="UPDATE assignmentmgt_master SET marks='$_POST[txt_marks]' WHERE assignmentmgtmas_key='$_GET[ak]' AND status=0";
		if(mysqli_query($link,$sql30)){
			echo "<script>
				alert('Successfully Update Assignment Details');
				window.location.href='assignment_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&ak=$_GET[ak]';
				</script>";
		}
	}
	
	if(isset($_POST['btn_barcode'])){
		
		$sql10="SELECT * FROM student_master WHERE student_id='$_POST[txt_barcode]' AND status=0";
		$result10 = mysqli_query($link,$sql10);
		if(mysqli_num_rows($result10)==0){
			echo "<script>
				alert('Invalid Student ID');
				</script>";
		}
		else{
			while($row10=mysqli_fetch_array($result10)){
				$stu_keyos=$row10['student_key'];
			}
			$sql9="SELECT * FROM assignment_details WHERE assignmentmgt_key='$_GET[ak]' AND student_key='$stu_keyos' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
			$result9 = mysqli_query($link,$sql9);
			if(mysqli_num_rows($result9)==0){
				
				$sql11="INSERT INTO assignment_details (status,assingmentdetai_key,assignmentmgt_key,student_key,marks,subject_key,curstatusofbatch_key,act_person) 
												VALUES (0,NULL,'$_GET[ak]','$stu_keyos','$_POST[txt_stumarks]','$_GET[suk]','$_GET[curyr]','$ukey')";
				if(mysqli_query($link,$sql11)){
					
					$sql7="SELECT * FROM assignment_details WHERE assignmentmgt_key='$_GET[ak]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND complete_status IS NULL AND status=0";
					$result7 = mysqli_query($link,$sql7);
					if(mysqli_num_rows($result7)==0){
						
						$sql20="UPDATE assignmentmgt_master SET complete_status=1,complete_dte='$cur_dte' WHERE assignmentmgtmas_key='$_GET[ak]' AND status=0";
						mysqli_query($link,$sql20);
					}
					echo "<script>
					alert('Successfully Added Assignment Mark');
						window.location.href='assignment_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&ak=$_GET[ak]';
					</script>";
				}
				
			}
			else{
				echo "<script>
				alert('Already Attend this Student');
				</script>";
				
			}
			
		}
	}
	
	$sql13="SELECT * FROM student_master WHERE batch_key='$y7' AND status=0";
	$result13 = mysqli_query($link,$sql13);
	while($row13=mysqli_fetch_array($result13)){
		
		$n1="txt_studentkey".$row13['student_key'];
		$n2="txt_studentmarkos".$row13['student_key'];
															
		$btn_addss="btn_addstulist".$row13['student_key'];
		$btn_changess="btn_changestulist".$row13['student_key'];
		$btn_cancelss="btn_cancelstulist".$row13['student_key'];
		
		if(isset($_POST[$btn_addss])){
			
			$sql17="SELECT * FROM assignment_details WHERE assignmentmgt_key='$_GET[ak]' AND student_key='$_POST[$n1]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
			$result17 = mysqli_query($link,$sql17);
			if(mysqli_num_rows($result17)==0){
				
				$sql18="INSERT INTO assignment_details (status,assingmentdetai_key,assignmentmgt_key,student_key,marks,subject_key,curstatusofbatch_key,act_person) 
												VALUES (0,NULL,'$_GET[ak]','$_POST[$n1]','$_POST[$n2]','$_GET[suk]','$_GET[curyr]','$ukey')";
				if(mysqli_query($link,$sql18)){
					
					$sql7="SELECT * FROM assignment_details WHERE assignmentmgt_key='$_GET[ak]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND complete_status IS NULL AND status=0";
					$result7 = mysqli_query($link,$sql7);
					if(mysqli_num_rows($result7)==0){
						
						$sql20="UPDATE assignmentmgt_master SET complete_status=1,complete_dte='$cur_dte' WHERE assignmentmgtmas_key='$_GET[ak]' AND status=0";
						mysqli_query($link,$sql20);
					}
					
					echo "<script>
					alert('Successfully Added Assignment Mark');
						window.location.href='assignment_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&ak=$_GET[ak]';
					</script>";
				}
				
			}
			else{
				echo "<script>
				alert('Already Added this Mark');
				</script>";
			}
			
		}
		
		if(isset($_POST[$btn_changess])){
			
			$sql31="UPDATE assignment_details SET marks='$_POST[$n2]' WHERE assignmentmgt_key='$_GET[ak]' AND student_key='$_POST[$n1]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
			if(mysqli_query($link,$sql31)){
				echo "<script>
					alert('Successfully Update Assignment Mark');
						window.location.href='assignment_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&ak=$_GET[ak]';
					</script>";
			}
		}
		
		if(isset($_POST[$btn_cancelss])){
			
			$sql19="UPDATE assignment_details SET status=1 WHERE assignmentmgt_key='$_GET[ak]' AND student_key='$_POST[$n1]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
			if(mysqli_query($link,$sql19)){
				echo "<script>
					alert('Canceled Assignment Mark');
						window.location.href='assignment_processing.php?suk=$_GET[suk]&curyr=$_GET[curyr]&ak=$_GET[ak]';
					</script>";
			}
		}
		
	}
	
	
	
	
}
?>
<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Lecturer Registration</title>
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!-- Bootstrap -->
        <link rel="stylesheet" media="screen" href="css/bootstrap.min.css">
        <link rel="stylesheet" media="screen" href="css/bootstrap-theme.min.css">

        <!-- Bootstrap Admin Theme -->
        <link rel="stylesheet" media="screen" href="css/bootstrap-admin-theme.css">

        <!-- Custom styles -->
      <link rel="stylesheet" media="screen" href="css/common.css">
	  <style type="text/css">
		<!-- newly added -->
		#chart-container {
		width: 100%;
		height: auto;
		}
		<!-- newly added -->
		#example tbody {
		cursor: pointer;
		}
		
		table.display tbody tr:nth-child(even):hover td{
			background-color:  #80dfff !important
		}
		
		table.display tbody tr:nth-child(odd):hover td{
			background-color:  #80dfff !important
		}
		
		table.display tbody tr:nth-child(even){
			background-color: #2874a6 !important
		}
		table.display tr.even .sorting_1 { 
			background-color:  #2874a6 !important; 
		}
		
		table.display tbody tr:nth-child(odd){
			background-color:  #00ace6 !important
		}
		table.display tr.odd .sorting_1 { 
				background-color:  #00ace6 !important; 
		}
		
		
		.tcontents{
			color:#ffffff;
			font-weight:bold;
			font-size:17px;
		}
		</style>
	  
    </head>
    <body class="bc" style="background-image: url('images/a2.jpg')">
	   <?php include('navi.php') ?>
       <br>
	   <br>
	   <br>
		
		
				<?php
				if(isset($_GET['suk']) && isset($_GET['curyr'])){
							
							$sql4="SELECT * FROM year_master INNER JOIN cur_statusofbatch_details ON year_master.year_key=cur_statusofbatch_details.semester_key 
															INNER JOIN batch_master ON batch_master.batch_mas_key=cur_statusofbatch_details.batchmas_key
															INNER JOIN course_master ON course_master.course_key=cur_statusofbatch_details.coursemas_key
															INNER JOIN facalty_master ON facalty_master.facalty_key=course_master.facalty_key
															WHERE cur_statusofbatch_details.curstatusbatch_detail_key='$_GET[curyr]' AND 
																 cur_statusofbatch_details.status=0";
							$result4 = mysqli_query($link,$sql4);
							while($row4=mysqli_fetch_array($result4)){
								$y1=$row4['facalty_nme'];
								$y2=$row4['course_nme'];
								$y3=$row4['acadamic_yer'];
								$y4=$row4['batch_code'];
								$y5=$row4['year_nme'];
								$y6=$row4['batchmas_key'];
								
							}
							
							$sql5="SELECT * FROM lectureassign_details INNER JOIN subject_master ON lectureassign_details.subject_key=subject_master.subject_key
																		INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
																WHERE subject_master.subject_key='$_GET[suk]' 
																	AND lectureassign_details.cur_statusbatch_key='$_GET[curyr]'
																	AND subject_master.status=0
																	AND lectureassign_details.status=0";
							$result5 = mysqli_query($link,$sql5);
							while($row5=mysqli_fetch_array($result5)){
								$y11=$row5['subject_name'];
								$y12=$row5['lecture_nme'];
							}
						?>
						
					
					
                    <div class="row">
							<div class="col-md-2">
							
							</div>
							<div class="col-md-8">
								<section class="panel panel-transparent">
									<div class="panel-body panel-transparent">
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y1." - ".$y2." - ".$y4;?></h2>
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y3." - ".$y5;?></h2>
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y11;?></h2>
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y12;?></h2>
										
										
										<?php
										if(isset($_GET['ak'])){
											$sql6="SELECT * FROM assignmentmgt_master WHERE assignmentmgtmas_key='$_GET[ak]' AND status=0";
											$result6 = mysqli_query($link,$sql6);
											while($row6=mysqli_fetch_array($result6)){
												$sdte=$row6['datos'];
												$sdis=$row6['description'];
												$method=$row6['method'];
												$smarks=$row6['marks'];
											}
										?>
											<h2 style="font-weight:bold;font-size:28px;" align="center"><?php echo $sdte;?></h2>
											<h2 style="font-weight:bold;font-size:18px;" align="center">Remark:<?php echo $sdis; ?></h2>
											<h2 style="font-weight:bold;font-size:18px;" align="center">Method:<?php echo $method; ?></h2>
											<form role="form" method="post" name="f1">
												<div class="form-group">
													<label>Marks</label>
													<input type="text" class="form-control input-sm" name="txt_marks" placeholder="Please Enter Marks" value="<?php echo $smarks; ?>">
												</div>
												<div class="form-group">
													<button type="submit" name="btn_assignmentstartupdate" class="btn btn-primary btn-lg btn-block">Update</button>
												</div>
											</form>
										
										<?php
										}
										?>
									</div>
									
								</section>
							</div>
					</div>
					<?php
					if(isset($_GET['ak'])){
					?>
							
							
							<div class="row">
									<div class="col-md-2">
									
									</div>
									<div class="col-md-8">
										<section class="panel panel-transparent">
											<div class="panel-body panel-transparent">
												<form role="form" method="post" name="f3">
													<div class="form-group">
														<label>Bar-code</label>
														<input type="text" class="form-control input-lg" name="txt_barcode" placeholder="Barcode">
													</div>
													<div class="form-group">
														<label>Marks</label>
														<input type="text" class="form-control input-md" name="txt_stumarks" placeholder="Please Enter Student Mark">
													</div>
													<div class="form-group">
														<button type="submit" name="btn_barcode" class="btn btn-primary btn-lg btn-block">Add Marks</button>
													</div>
												</form>
												<br>
												<form method="post" name="f4">
												<table class="table table-striped table-bordered" width="100%">
														<thead>
															<tr style="background-color:  #ffffff; ">
																<th width="30%">Student ID</th>
																<th width="50%">Student Name</th>
																<th width="10%">Marks</th>
																<th width="10%">Add</th>
															</tr>
														</thead>
														<tbody>
															<?php
													
															$sql8="SELECT * FROM student_master WHERE batch_key='$y6' AND status=0";
															$result8 = mysqli_query($link,$sql8);
															while($row8=mysqli_fetch_array($result8)){
																
																$txt_studentkey="txt_studentkey".$row8['student_key'];
																$txt_studentmarks="txt_studentmarkos".$row8['student_key'];
															
																$btn_addstulist="btn_addstulist".$row8['student_key'];
																
																$sql12="SELECT * FROM assignment_details WHERE assignmentmgt_key='$_GET[ak]' AND student_key='$row8[student_key]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
																$result12 = mysqli_query($link,$sql12);
																if(mysqli_num_rows($result12)==0){
																	echo "<tr>
																			
																			<td width='30%'>
																			<input type='hidden' class='form-control input-sm' name=".$txt_studentkey." value=".$row8['student_key'].">
																			".$row8['student_id']."</td>
																			<td width='60%'>".$row8['initial_nme']."</td>
																			<td width='10%'>
																			<input type='text' class='form-control input-sm' name=".$txt_studentmarks.">
																			</td>
																			<td width='10%'>
																				<input type='submit' class='btn btn-sm btn-primary' value='Add' name=".$btn_addstulist.">
																			</td>
																		</tr>";
																}
															}
														?>
														</tbody>
												</table>
												</form>
												<h2>Mark Added Students</h2>
												<form method="post" name="f5">
												<table class="table table-striped table-bordered" width="100%">
														<thead>
															<tr style="background-color:  #ffffff; ">
																<th width="30%">Student ID</th>
																<th width="50%">Student Name</th>
																<th width="10%">Marks</th>
																<th width="5%">Change</th>
																<th width="5%">Cancel</th>
															</tr>
														</thead>
														<tbody>
															<?php
													
															$sql14="SELECT * FROM student_master WHERE batch_key='$y6' AND status=0";
															$result14 = mysqli_query($link,$sql14);
															while($row14=mysqli_fetch_array($result14)){
																
																$txt_studentkeyaa="txt_studentkey".$row14['student_key'];
																$txt_maekeyaa="txt_studentmarkos".$row14['student_key'];
															
																$btn_changestulist="btn_changestulist".$row14['student_key'];
																$btn_cancelstulist="btn_cancelstulist".$row14['student_key'];
																
																$sql15="SELECT * FROM assignment_details WHERE assignmentmgt_key='$_GET[ak]' AND student_key='$row14[student_key]' AND subject_key='$_GET[suk]' AND  curstatusofbatch_key='$_GET[curyr]' AND status=0";
																$result15 = mysqli_query($link,$sql15);
																if(mysqli_num_rows($result15)>0){
																	while($row15=mysqli_fetch_array($result15)){
																		$mks=$row15['marks'];
																	}
																	echo "<tr>
																			
																			<td width='30%'>
																			<input type='hidden' class='form-control input-sm' name=".$txt_studentkeyaa." value=".$row14['student_key'].">
																			".$row14['student_id']."</td>
																			<td width='50%'>".$row14['initial_nme']."</td>
																			<td width='10%'>
																				<input type='text' class='form-control input-sm' name=".$txt_maekeyaa." value=".$mks.">
																			</td>
																			<td width='5%'>
																				<input type='submit' class='btn btn-sm btn-success' value='Change' name=".$btn_changestulist.">
																			</td>
																			<td width='5%'>
																				
																				<input type='submit' class='btn btn-sm btn-danger' value='Cancel' name=".$btn_cancelstulist.">
																			</td>
																		</tr>";
																}
															}
														?>
														</tbody>
												</table>
												</form>
											</div>
										</section>
									</div>
									
							</div>
				<?php
					}
				}
				?>
		
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
        <script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>

        <!-- Include all compiled plugins (below), or include individual files as needed -->
        <script type="text/javascript" src="js/bootstrap.min.js"></script>
        <script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
        <script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
        <script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
		
			<link rel="stylesheet" type="text/css" href="datatable/dataTables.min.css" />
				<script type="text/javascript" src="datatable/dataTables.min.js"></script> 	
				
				<script type="text/javascript" charset="utf-8">
						$(document).ready(function() {
							$('#example thead th').each( function () {
								 var title = $('#example thead th').eq( $(this).index() ).text();
								
								$(this).html( '<label style="font-size:18px;color:white">'+title+'</label><input type="text" placeholder="'+title+'" style="color:black;" class="form-control input-sm" />' );
							} );
			 
						// DataTable
							var table = $('#example').DataTable({
							});
						
							
							// Apply the search
					
							table.columns().eq( 0 ).each( function ( colIdx ) {
								$( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
									table
										.column( colIdx )
										.search( this.value )
										.draw();
								} );
							} );
						});
				</script>
    </body>
</html>
