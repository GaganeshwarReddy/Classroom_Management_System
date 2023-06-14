
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 //error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");
$cur_yr=date("Y");


?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Module Info</title>
        
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
		#example tbody {
		cursor: pointer;
		}
		
		table.display tbody tr:nth-child(even):hover td{
			background-color:  #FF5733 !important
		}
		
		table.display tbody tr:nth-child(odd):hover td{
			background-color:  #FF5733 !important
		}
		
		table.display tbody tr:nth-child(even){
			background-color: #2874a6 !important
		}
		table.display tr.even .sorting_1 { 
			background-color:  #2874a6 !important; 
		}
		
		table.display tbody tr:nth-child(odd){
			background-color:  #229954 !important
		}
		table.display tr.odd .sorting_1 { 
				background-color:  #229954 !important; 
		}
		
		
		.tcontents{
			color:#ffffff;
			font-weight:bold;
			font-size:17px;
		}
		</style>
    </head>
     <body class="bc" style="background-image: url('images/a2.jpg')">
	   <?php //include('navi.php') ?>
       <br>
	   <br>
	   <br>
		
		
				<?php
				if(isset($_GET['suk']) && isset($_GET['curyr']) && isset($_GET['shk'])){
							
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
							
							$sql6="SELECT * FROM shedule_details WHERE sheduledetail_key='$_GET[shk]' AND status=0";
							$result6 = mysqli_query($link,$sql6);
							while($row6=mysqli_fetch_array($result6)){
									$y7=$row6['lesson_nme'];
									$y8=$row6['shedule_dte'];
									$y9=$row6['acadamic_week'];
									$y10=$row6['hours'];
									$y13=$row6['complete_dte'];
									$y14=$row6['complete_lecturedtemgt'];
									$y15=$row6['complete_hours'];
							}
							
							
							$sql1="SELECT * FROM lecturedtemgt_details WHERE lecturedtemgtdetail_key='$y14' AND status=0";
							$result1 = mysqli_query($link,$sql1);
							while($row1=mysqli_fetch_array($result1)){
								$lecture_dte=$row1['datos'];
								$term_note=$row1['term_note'];
							}
						?>
						
					
					
                    <div class="row">
							<div class="col-md-2">
							
							</div>
							<div class="col-md-8">
								<section class="panel panel-transparent">
									<div class="panel-body panel-transparent">
										
										<table width="100%" border="0">
											<thead>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Course</th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y2; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Faculty</th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y1; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Batch </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y4; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Semester </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y3."-".$y5; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Subject </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y11; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Lecturer </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y12; ?></th>
												</tr>
												
											</thead>
										</table>
									</div>
									
								</section>
							</div>
					</div>
					
					<div class="row">
							
							<div class="col-md-6">
								<section class="panel panel-transparent">
									<div class="panel-body panel-transparent">
										
										<table width="100%" border="0">
											<thead>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Module</th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y7; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Schedule Date</th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y8; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Academic Week </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y9; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Target Hours </th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y10; ?> Hours</th>
												</tr>
											</thead>
										</table>
									</div>
									
								</section>
							</div>
							
							<div class="col-md-6">
								<section class="panel panel-transparent">
									<div class="panel-body panel-transparent">
										
										<table width="100%" border="0">
											<thead>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Complete Date</th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $lecture_dte; ?></th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Complete Hours</th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $y15; ?> Hours</th>
												</tr>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:18px;">Term Note</th>
													<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
													<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $term_note; ?></th>
												</tr>
												
											</thead>
										</table>
									</div>
									
								</section>
							</div>
					</div>
					
					<div class="row">
							<div class="col-md-2">
								
							</div>
							
							<div class="col-md-8">
								<section class="panel panel-transparent">
									<div class="panel-body panel-transparent">
									
										<?php
										$sql3="SELECT * FROM attendance_details
																			WHERE lecturedtemgt_key='$y14' 
																			AND subject_key='$_GET[suk]' 
																			AND curstatusofbatch_key='$_GET[curyr]' 
																			AND status=0";
										$result3 = mysqli_query($link,$sql3);
										$n1=mysqli_num_rows($result3);
										?>
										
										<h3 align="center" style="font-weight:bold;">Attendance of Module : <?php echo $n1; ?></h3>
										<table width="100%" border="1">
											<thead>
												<tr>
													<th width="30%" style="font-weight:bold;font-size:20px;"> Student ID</th>
													<th width="70%" style="font-weight:bold;font-size:20px;"> Student Name</th>
												</tr>
											</thead>	
											<tbody>
													<?php
													
														
														$sql2="SELECT * FROM student_master INNER JOIN attendance_details ON student_master.student_key=attendance_details.student_key
																			WHERE attendance_details.lecturedtemgt_key='$y14' 
																			AND attendance_details.subject_key='$_GET[suk]' 
																			AND attendance_details.curstatusofbatch_key='$_GET[curyr]' 
																			AND attendance_details.status=0";
														$result2 = mysqli_query($link,$sql2);
														while($row2=mysqli_fetch_array($result2)){
																
																	echo "<tr>
																			
																			<td width='30%' style='font-size:18px;'> ".$row2['student_id']."</td>
																			<td width='70%' style='font-size:18px;'> ".$row2['initial_nme']."</td>
																		</tr>";
																
														}
														?>
											</tbody>
										</table>
									</div>
									
								</section>
							</div>
					</div>
					
					<?php
					$sql7="SELECT * FROM lecturedtemgt_details WHERE subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND pending_status=1 AND shedule_key='$_GET[shk]' AND status=0";
					$result7 = mysqli_query($link,$sql7);
					if(mysqli_num_rows($result7)>0){
						while($row7=mysqli_fetch_array($result7)){
					?>
							<div class="row">
									<div class="col-md-2">
										
									</div>
									
									<div class="col-md-8">
										<section class="panel panel-transparent">
											<div class="panel-body panel-transparent">
												<h1 align="center">Incomplete Date Information - <?php echo $row7['datos']; ?></h1>
												<table width="100%" border="0">
													<thead>
														<tr>
															<th width="30%" style="font-weight:bold;font-size:18px;">Date</th>
															<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
															<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $row7['datos']; ?></th>
														</tr>
														<tr>
															<th width="30%" style="font-weight:bold;font-size:18px;">Term Note</th>
															<th width="5%" style="font-weight:bold;font-size:18px;">:</th>
															<th width="65%" style="font-weight:bold;font-size:18px;"><?php echo $row7['term_note']; ?></th>
														</tr>
														
													</thead>
												</table>
												
												<?php
												$sql8="SELECT * FROM attendance_details
																					WHERE lecturedtemgt_key='$row7[lecturedtemgtdetail_key]' 
																					AND subject_key='$_GET[suk]' 
																					AND curstatusofbatch_key='$_GET[curyr]' 
																					AND status=0";
												$result8 = mysqli_query($link,$sql8);
												
												?>
												<h3 align="center" style="font-weight:bold;">Attendance of Module : <?php echo mysqli_num_rows($result8); ?></h3>
												<?php
												if(mysqli_num_rows($result8)>0){
												?>
												<table width="100%" border="1">
													<thead>
														<tr>
															<th width="30%" style="font-weight:bold;font-size:20px;"> Student ID</th>
															<th width="70%" style="font-weight:bold;font-size:20px;"> Student Name</th>
														</tr>
													</thead>	
													<tbody>
															<?php
															
																
																$sql9="SELECT * FROM student_master INNER JOIN attendance_details ON student_master.student_key=attendance_details.student_key
																					WHERE attendance_details.lecturedtemgt_key='$row7[lecturedtemgtdetail_key]' 
																					AND attendance_details.subject_key='$_GET[suk]' 
																					AND attendance_details.curstatusofbatch_key='$_GET[curyr]' 
																					AND attendance_details.status=0";
																$result9 = mysqli_query($link,$sql9);
																while($row9=mysqli_fetch_array($result9)){
																		
																			echo "<tr>
																					
																					<td width='30%' style='font-size:18px;'> ".$row9['student_id']."</td>
																					<td width='70%' style='font-size:18px;'> ".$row9['initial_nme']."</td>
																				</tr>";
																		
																}
																?>
													</tbody>
												</table>
												<?php
												}
												?>
											</div>
											
										</section>
									</div>
							</div>
					<?php
						}
					}
					?>
					
					<?php
					$sql10="SELECT * FROM lecturedtemgt_details WHERE subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND pending_status=2 AND shedule_key='$_GET[shk]' AND status=0";
					$result10 = mysqli_query($link,$sql10);
					if(mysqli_num_rows($result10)>0){
					?>
						<div class="row">
									<div class="col-md-2">
										
									</div>
									
									<div class="col-md-8">
										<section class="panel panel-transparent">
											<div class="panel-body panel-transparent">
												<h1 align="center">Postpone Module Details</h1>
												<table width="100%" border="1">
													<thead>
														<tr>
															<th width="30%" style="font-weight:bold;font-size:20px;"> Date</th>
															<th width="70%" style="font-weight:bold;font-size:20px;"> Reason</th>
														</tr>
													</thead>	
													<tbody>
															<?php
																while($row10=mysqli_fetch_array($result10)){
																		
																			echo "<tr>
																					
																					<td width='30%' style='font-size:18px;'> ".$row10['datos']."</td>
																					<td width='70%' style='font-size:18px;'> ".$row10['term_note']."</td>
																				</tr>";
																		
																}
																?>
													</tbody>
												</table>
											</div>
											
										</section>
									</div>
						</div>
					
					<?php
					}
					?>
					
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
