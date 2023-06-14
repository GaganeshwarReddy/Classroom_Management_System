<?php
//error_reporting(0);
include 'conn.php';	
include 'sessionhandaler.php';
?>
<?php



$cur_dte=date("Y-m-d");
$cur_yr=date("Y");

$twoweeksago=date('Y-m-d', strtotime('+14 days'));

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

        <!-- small navbar -->
        <?php include('navi.php') ?>
		<br>
		<br>
		<br>
                    <div class="row">
							<section class="panel panel-transparent">
                              
                                <div class="panel-body panel-transparent">
								
									<div style="font-weight:bold;font-size:20px;">Assignment Schedule <?php echo $twoweeksago; ?></div>
									<br>
                                    <table class="table display" id="example" width="100%">
                                        <thead>
                                            <tr style="background-color:#1b4f72">
												<th width="8%">Date</th>
												<th width="25%">Course</th>
												<th width="8%">Batch</th>
												<th width="13%">Semester</th>
												<th width="12%">Subject</th>
												<th width="6%">Method</th>
												<th width="17%">Description</th>
												<th width="5%">Total Marks</th>
												<th width="5%">View Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql7="SELECT * FROM subject_master INNER JOIN assignmentmgt_master ON subject_master.subject_key=assignmentmgt_master.subject_key
																						  INNER JOIN lectureassign_details ON lectureassign_details.subject_key=subject_master.subject_key
																						  INNER JOIN course_master ON subject_master.course_key=course_master.course_key
																						   INNER JOIN year_master ON subject_master.year_key=year_master.year_key
																						   INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																						   INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
																						   INNER JOIN cur_statusofbatch_details ON lectureassign_details.cur_statusbatch_key=cur_statusofbatch_details.curstatusbatch_detail_key
																						   INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																						   WHERE cur_statusofbatch_details.acadamic_yer='$cur_yr'
																							 AND lecture_master.lecturemas_key='$lec_key'
																						     AND cur_statusofbatch_details.status=0
																							 AND assignmentmgt_master.complete_status IS NULL 
																							 AND assignmentmgt_master.status=0
																							 AND assignmentmgt_master.datos>='$cur_dte'
																							 AND assignmentmgt_master.datos<='$twoweeksago'
																							 ORDER BY assignmentmgt_master.datos ASC";
												$result7=mysqli_query($link,$sql7);
												while($row7=mysqli_fetch_array($result7)){
											?>
													<tr class="clickable-row" data-href="assignment_processing.php?suk=<?php echo $row7['subject_key'];?>&curyr=<?php echo $row7['curstatusbatch_detail_key'];?>&ak=<?php echo $row7['assignmentmgtmas_key'];?>">
														<td><div class="tcontents"><?php echo $row7['datos']?></div></td>
														<td><div class="tcontents"><?php echo $row7['course_nme']."-".$row7['facalty_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row7['batch_code']?></div></td>
														<td><div class="tcontents"><?php echo $row7['year_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row7['subject_name']?></div></td>
														<td><div class="tcontents"><?php echo $row7['method']?></div></td>
														<td><div class="tcontents"><?php echo $row7['description']?></div></td>
														<td><div class="tcontents"><?php echo $row7['marks']?>%</div></td>
														<td><a href="assignment_processing.php?suk=<?php echo $row7['subject_key'];?>&curyr=<?php echo $row7['curstatusbatch_detail_key'];?>&ak=<?php echo $row7['assignmentmgtmas_key'];?>"><button class='btn btn-sm btn-primary btn-block'>Process</button></a></td>
													</tr>
											<?php
												}
											?>
										
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                    </div>
					
					<div class="row">
                            <section class="panel panel-transparent">
                               
                                <div class="panel-body panel-transparent">
									<div style="font-weight:bold;font-size:20px;">Week Attendance Students</div>
									<br>
                                    <table class="tables display" id="example2" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
                                                <th width="15%">Student ID</th>
                                                <th width="25%">Student Name</th>
											    <th width="20%">Subject</th>
												<th width="20%">Course</th>
												<th width="10%">Batch</th>
												<th width="10%">Semester</th>
												<th width="5%">Attendance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql1="SELECT * FROM lectureassign_details INNER JOIN subject_master ON lectureassign_details.subject_key=subject_master.subject_key
																						   INNER JOIN course_master ON subject_master.course_key=course_master.course_key
																						   INNER JOIN year_master ON subject_master.year_key=year_master.year_key
																						   INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																						   INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
																						   INNER JOIN cur_statusofbatch_details ON lectureassign_details.cur_statusbatch_key=cur_statusofbatch_details.curstatusbatch_detail_key
																						   INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																						   WHERE cur_statusofbatch_details.acadamic_yer='$cur_yr'
																							 AND lecture_master.lecturemas_key='$lec_key'
																						     AND cur_statusofbatch_details.status=0";
												$result1=mysqli_query($link,$sql1);
												while($row1=mysqli_fetch_array($result1)){
													$noofcourseday=0;
													$stuattedday=0;
													$avgattendstu=0;
													
													$sql2="SELECT * FROM student_master WHERE batch_key='$row1[batch_mas_key]' AND status=0";
													$result2=mysqli_query($link,$sql2);
													while($row2=mysqli_fetch_array($result2)){
														
														$sql3="SELECT * FROM lecturedtemgt_details WHERE subject_key='$row1[subject_key]' AND curstateofbatch_key='$row1[curstatusbatch_detail_key]' AND (pending_status IS NULL OR pending_status=1) AND status=0";
														$result3=mysqli_query($link,$sql3);
														$noofcourseday=mysqli_num_rows($result3);
														
														$sql4="SELECT * FROM attendance_details WHERE student_key='$row2[student_key]' AND subject_key='$row1[subject_key]' AND curstatusofbatch_key='$row1[curstatusbatch_detail_key]' AND status=0";
														$result4=mysqli_query($link,$sql4);
														$stuattedday=mysqli_num_rows($result4);
														
														
														
													
														if($noofcourseday>0){
															
															$avgattendstu=($stuattedday/$noofcourseday)*100;
															
															if($avgattendstu<=40){
													
											?>
																<tr>
																	<td><div class="tcontents"><?php echo $row2['student_id']; ?></div></td>
																	<td><div class="tcontents"><?php echo $row2['initial_nme'] ?></div></td>
																	<td><div class="tcontents"><?php echo $row1['subject_name']?></div></td>
																	<td><div class="tcontents"><?php echo $row1['course_nme']."-".$row1['facalty_nme']?></div></td>
																	<td><div class="tcontents"><?php echo $row1['batch_code']?></div></td>
																	<td><div class="tcontents"><?php echo $row1['year_nme']?></div></td>
																	<td><div class="tcontents"><?php echo $avgattendstu;?>%</div></td>
																</tr>
											<?php
															}
														}
													}
												}
											?>
										
										
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                    </div>
					
					<div class="row">
                            <section class="panel panel-transparent">
                               
                                <div class="panel-body panel-transparent">
									<div style="font-weight:bold;font-size:20px;">Week Assignment Marks</div>
									<br>
                                    <table class="tables display" id="example3" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
                                               <th width="15%">Student ID</th>
                                                <th width="15%">Student Name</th>
											    <th width="18%">Subject</th>
												<th width="30%">Course</th>
												<th width="10%">Batch</th>
												<th width="12%">Semester</th>
												<th width="5%"> Average Marks</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
											$sql5="SELECT * FROM lectureassign_details INNER JOIN subject_master ON lectureassign_details.subject_key=subject_master.subject_key
																						   INNER JOIN course_master ON subject_master.course_key=course_master.course_key
																						   INNER JOIN year_master ON subject_master.year_key=year_master.year_key
																						   INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																						   INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
																						   INNER JOIN cur_statusofbatch_details ON lectureassign_details.cur_statusbatch_key=cur_statusofbatch_details.curstatusbatch_detail_key
																						   INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																						   WHERE cur_statusofbatch_details.acadamic_yer='$cur_yr'
																							 AND lecture_master.lecturemas_key='$lec_key'
																						     AND cur_statusofbatch_details.status=0";
												$result5=mysqli_query($link,$sql5);
												while($row5=mysqli_fetch_array($result5)){
													$totassignment=0;
													$noofmarksassignmet=0;
													$avgmarkstu=0;
													
													$sql6="SELECT * FROM student_master WHERE batch_key='$row5[batch_mas_key]' AND status=0";
													$result6=mysqli_query($link,$sql6);
													while($row6=mysqli_fetch_array($result6)){
														
														$sql9="SELECT SUM(marks) AS totassignment1 FROM assignmentmgt_master WHERE subject_key='$row5[subject_key]' AND curstateofbatch_key='$row5[curstatusbatch_detail_key]' AND status=0";
														$result9=mysqli_query($link,$sql9);
														while($row9=mysqli_fetch_array($result9)){
															$totassignment=$row9['totassignment1'];
														}
														
														$sql10="SELECT SUM(marks) AS noofmarksassignmet1 FROM assignment_details WHERE student_key='$row6[student_key]' AND subject_key='$row5[subject_key]' AND curstatusofbatch_key='$row5[curstatusbatch_detail_key]' AND status=0";
														$result10=mysqli_query($link,$sql10);
														while($row10=mysqli_fetch_array($result10)){
															$noofmarksassignmet=$row10['noofmarksassignmet1'];
														}
														
														
														
													
														if($totassignment>0){
															
															$avgmarkstu=($noofmarksassignmet/$totassignment)*100;
															
															if($avgmarkstu<=40){
													
											?>
																<tr>
																	<td><div class="tcontents"><?php echo $row6['student_id']."  -".$totassignment."-".$noofmarksassignmet; ?></div></td>
																	<td><div class="tcontents"><?php echo $row6['initial_nme'] ?></div></td>
																	<td><div class="tcontents"><?php echo $row5['subject_name']?></div></td>
																	<td><div class="tcontents"><?php echo $row5['course_nme']."-".$row5['facalty_nme']?></div></td>
																	<td><div class="tcontents"><?php echo $row5['batch_code']?></div></td>
																	<td><div class="tcontents"><?php echo $row5['year_nme']?></div></td>
																	<td><div class="tcontents"><?php echo $avgmarkstu;?>%</div></td>
																</tr>
											<?php
															}
														}
													}
												}
											?>
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                    </div>
		
		


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
						//......................................................................
						
							$('#example2 thead th').each( function () {
								 var title1 = $('#example2 thead th').eq( $(this).index() ).text();
								
								$(this).html( '<label style="font-size:18px;color:white">'+title1+'</label><input type="text" placeholder="'+title1+'" style="color:black;" class="form-control input-sm" />' );
							} );
			 
							var table1 = $('#example2').DataTable({
							});
						
							
					
							table1.columns().eq( 0 ).each( function ( colIdx ) {
								$( 'input', table1.column( colIdx ).header() ).on( 'keyup change', function () {
									table1
										.column( colIdx )
										.search( this.value )
										.draw();
								} );
							} );
						
						//.......................................................................
						
							$('#example3 thead th').each( function () {
								 var title2 = $('#example3 thead th').eq( $(this).index() ).text();
								
								$(this).html( '<label style="font-size:18px;color:white">'+title2+'</label><input type="text" placeholder="'+title2+'" style="color:black;" class="form-control input-sm" />' );
							} );
			 
							var table3 = $('#example3').DataTable({
							});
						
							
					
							table3.columns().eq( 0 ).each( function ( colIdx ) {
								$( 'input', table3.column( colIdx ).header() ).on( 'keyup change', function () {
									table3
										.column( colIdx )
										.search( this.value )
										.draw();
								});
							} );
						//.....................................................................
							$(".clickable-row").click(function() {
								window.location = $(this).data("href");
							  });
							});
				
			</script>
    </body>
</html>