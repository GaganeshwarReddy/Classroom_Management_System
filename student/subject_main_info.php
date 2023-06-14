<?php
error_reporting(0);
include 'conn.php';	
include 'sessionhandaler.php';
?>
<?php



$cur_dte=date("Y-m-d");
$cur_yr=date("Y");

?>


<!DOCTYPE html>
<html>
    <head>
        <title>Subject Information</title>
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
        <!-- small navbar -->
        <?php include('navi.php') ?>

        

        <div class="container">
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
									</div>
								</section>
							</div>
					</div>

					<div class="row">
                            <section class="panel panel-transparent">
								<div class="panel-body panel-transparent">
                                <h3>Pending Modules</h3>
                                <div class="bootstrap-admin-panel-content">
                                    <table class="table display" id="example" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
												<th width="15%">Schedule Date</th>
												<th width="65%">Module</th>
												<th width="10%">Academic Week</th>
												<th width="10%">Hours</th>
												
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql1="SELECT * FROM shedule_details WHERE subject_key='$_GET[suk]' AND curstausofbatch_key='$_GET[curyr]' AND complete_status IS NULL AND status=0";
												$result1=mysqli_query($link,$sql1);
												while($row1=mysqli_fetch_array($result1)){
											?>
													<tr class="clickable-row" data-href="module_info.php?suk=<?php echo $row1['sheduledetail_key'];?>">
														<td><div class="tcontents"><?php echo $row1['shedule_dte']?></div></td>
														<td><div class="tcontents"><?php echo $row1['lesson_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row1['acadamic_week']?></div></td>
														<td><div class="tcontents"><?php echo $row1['hours']?> Hours</div></td>
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
                                    <h3>Complete Modules</h3>
                               
                                    <table class="tables display" id="example2" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
                                               	<th width="15%">Schedule Date</th>
												<th width="35%">Module</th>
												<th width="10%">Academic Week</th>
												<th width="10%">Hours</th>
												<th width="15%">Complete Date</th>
												<th width="10%">Complete Hours</th>
												<th width="5%">View Infos</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												$sql2="SELECT * FROM shedule_details WHERE subject_key='$_GET[suk]' AND curstausofbatch_key='$_GET[curyr]' AND complete_status=1 AND status=0";;
												$result2=mysqli_query($link,$sql2);
												while($row2=mysqli_fetch_array($result2)){
											?>
													<tr class="clickable-row" data-href="module_info.php?suk=<?php echo $_GET['suk'];?>&curyr=<?php echo $_GET['curyr'];?>&shk=<?php echo $row2['sheduledetail_key'];?>">
														<td><div class="tcontents"><?php echo $row2['shedule_dte']?></div></td>
														<td><div class="tcontents"><?php echo $row2['lesson_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row2['acadamic_week']?></div></td>
														<td><div class="tcontents"><?php echo $row2['hours']?> Hours</div></td>
														<td><div class="tcontents"><?php echo $row2['complete_dte']?></div></td>
														<td><div class="tcontents"><?php echo $row2['complete_hours']?> Hours</div></td>
														<td><a href="module_info.php?suk=<?php echo $_GET['suk'];?>&curyr=<?php echo $_GET['curyr'];?>&shk=<?php echo $row2['sheduledetail_key'];?>"><button class='btn btn-sm btn-primary btn-block'>View Info</button></a></td>
													</tr>
											<?php
												}
											?>
										
										
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                    </div>
					
					
					<?php
					$sql6="SELECT * FROM assignmentmgt_master WHERE subject_key='$_GET[suk]' AND curstateofbatch_key='$_GET[curyr]' AND status=0";
					$result6=mysqli_query($link,$sql6);
					if(mysqli_num_rows($result6)>0){
					?>
					<div class="row">
                             <section class="panel panel-transparent">
								<div class="panel-body panel-transparent">
                                    <h3>Assignment of Subject</h3>
                                
                                    <table class="table display" id="example3" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
                                               <th width="20%">Assignment Date</th>
												<th width="70%">Description</th>
												<th width="10%">View Info</th>
                                            </tr>
                                        </thead>
                                        <tbody>
											<?php
												while($row6=mysqli_fetch_array($result6)){
											?>
													<tr class="clickable-row" data-href="assignment_info.php?pcd=assignment_info.php?suk=<?php echo $_GET['suk'];?>&curyr=<?php echo $_GET['curyr'];?>&ask=<?php echo $row6['assignmentmgtmas_key'];?>">
														<td><div class="tcontents"><?php echo $row6['datos']?></div></td>
														<td><div class="tcontents"><?php echo $row6['description']?></div></td>
														<td><a href="assignment_info.php?suk=<?php echo $_GET['suk'];?>&curyr=<?php echo $_GET['curyr'];?>&ask=<?php echo $row6['assignmentmgtmas_key'];?>"><button class='btn btn-sm btn-primary btn-block'>View Info</button></a></td>
													</tr>
											<?php
												}
											?>
										
                                        </tbody>
                                    </table>
                                </div>
                            </section>
                    </div>
				<?php
						}
				}
				?>
		</div> 
		


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
						
							
							// Apply the search
					
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