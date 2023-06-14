<?php
//error_reporting(0);
include 'conn.php';	
include 'sessionhandaler.php';
?>
<?php



$cur_dte=date("Y-m-d");
$cur_yr=date("Y");

?>


<!DOCTYPE html>
<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Student Panel</title>
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
		<!-- newly added -->
		<script type="text/javascript" src="js/jquery.min.js"></script>
		<script type="text/javascript" src="js/Chart.min.js"></script>
		<!-- newly added end -->
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
									<div style="font-weight:bold;font-size:20px;">Manage Courses - <?php echo $cur_yr;?></div>
									<br>
                                    <table class="table display" id="example" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
												<th width="20%">Department</th>
												<th width="20%">Course</th>
												<th width="10%">Batch</th>
												<th width="10%">Semester</th>
												<th width="25%">Subject</th>
												<th width="10%">Lecture</th>
												<th width="5%">View Info</th>
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
																						   INNER JOIN student_master ON cur_statusofbatch_details.batchmas_key=student_master.batch_key
																						   WHERE cur_statusofbatch_details.acadamic_yer='$cur_yr'
																						     AND student_master.student_key='$ukey'
																							 AND cur_statusofbatch_details.status=0";
												$result1=mysqli_query($link,$sql1);
												while($row1=mysqli_fetch_array($result1)){
											?>
													<tr class="clickable-row" data-href="stu_info.php?suk=<?php echo $row1['subject_key'];?>&curyr=<?php echo $row1['curstatusbatch_detail_key'];?>">
														<td><div class="tcontents"><?php echo $row1['facalty_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row1['course_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row1['batch_code']?></div></td>
														<td><div class="tcontents"><?php echo $row1['year_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row1['subject_name']?></div></td>
														<td><div class="tcontents"><?php echo $row1['lecture_nme']?></div></td>
														<td><a href="stu_info.php?suk=<?php echo $row1['subject_key'];?>&curyr=<?php echo $row1['curstatusbatch_detail_key'];?>"><button class='btn btn-sm btn-primary btn-block'>View Info</button></a></td>
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
									<div style="font-weight:bold;font-size:20px;">Old Academic Year Courses</div>
									<br>
                                    <table class="tables display" id="example2" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
                                               	<th width="20%">Department</th>
												<th width="20%">Course</th>
												<th width="10%">Batch</th>
												<th width="10%">Semester</th>
												<th width="25%">Subject</th>
												<th width="10%">Lecture</th>
												<th width="5%">View Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql2="SELECT * FROM lectureassign_details INNER JOIN subject_master ON lectureassign_details.subject_key=subject_master.subject_key
																						   INNER JOIN course_master ON subject_master.course_key=course_master.course_key
																						   INNER JOIN year_master ON subject_master.year_key=year_master.year_key
																						   INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																						   INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
																						   INNER JOIN cur_statusofbatch_details ON lectureassign_details.cur_statusbatch_key=cur_statusofbatch_details.curstatusbatch_detail_key
																						   INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																						   WHERE cur_statusofbatch_details.acadamic_yer<'$cur_yr'
																						     AND cur_statusofbatch_details.status=0";
												$result2=mysqli_query($link,$sql2);
												while($row2=mysqli_fetch_array($result2)){
											?>
													<tr class="clickable-row" data-href="subject_main_info.php?suk=<?php echo $row2['subject_key'];?>&curyr=<?php echo $row2['curstatusbatch_detail_key'];?>">
														<td><div class="tcontents"><?php echo $row2['facalty_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row2['course_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row2['batch_code']?></div></td>
														<td><div class="tcontents"><?php echo $row2['year_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row2['subject_name']?></div></td>
														<td><div class="tcontents"><?php echo $row2['lecture_nme']?></div></td>
														<td><a href="subject_main_info.php?suk=<?php echo $row2['subject_key'];?>&curyr=<?php echo $row2['curstatusbatch_detail_key'];?>"><button class='btn btn-sm btn-primary btn-block'>View Info</button></a></td>
													</tr>
											<?php
												}
											?>
										
										
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                    </div>
					
					<!--<div class="row">
                            <div class="panel panel-default">
                                <div class="panel-heading">
                                    <div class="text-muted bootstrap-admin-box-title">Complete Vacancies</div>
                                </div>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table display" id="example3" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
                                               <th width="20%">Post Date</th>
												<th width="40%">Job Title</th>
												<th width="20%">Salary</th>
												<th width="10%">Closing Date</th>
												<th width="10%">View Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql3="SELECT * FROM vacancy_master WHERE finact=0 AND complete_status=1 ORDER BY date DESC";
												$result3=mysqli_query($link,$sql3);
												while($row3=mysqli_fetch_array($result3)){
											?>
													<tr class="clickable-row" data-href="vacancy_info.php?pcd=<?php echo $row3['vacancymas_key']?>">
														<td><div class="tcontents"><?php echo $row3['date']?></div></td>
														<td><div class="tcontents"><?php echo $row3['job_titel']?></div></td>
														<td><div class="tcontents"><?php echo $row3['salary']?></div></td>
														<td><div class="tcontents"><?php echo $row3['closing_date']?></div></td>
														<td><a href="vacancy_info.php?pcd=<?php echo $row3['vacancymas_key'];?>"><button class='btn btn-sm btn-primary btn-block'>View Info</button></a></td>
													</tr>
											<?php
												}
											?>
										
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>-->

		
		


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
						
							var state3 = table3.state.loaded();
							if ( state3 ) {
							  table3.columns().eq( 0 ).each( function ( colIdx ) {
								var colSearch3= state3.columns[colIdx].search;
								
								if ( colSearch3.search ) {
								  $( 'input', table3.column( colIdx ).header() ).val( colSearch3.search );
								}
							  } );
							  
							  table3.draw();
							}
							// Apply the search
					
							table3.columns().eq( 0 ).each( function ( colIdx ) {
								$( 'input', table3.column( colIdx ).header() ).on( 'keyup change', function () {
									table
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