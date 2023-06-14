
<?php
include 'conn.php';	
include 'sessionhandaler.php';
 //error_reporting(0);
?>

<?php
$cur_dte=date("Y-m-d");

?>

<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>Reports</title>
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
			font-size:15px;
		}
		</style>
    </head>
    <body class="bc" style="background-image: url('images/a2.jpg')">
	   <?php include('navi.php') ?>
       <br>
	   <br>
	   <br>
		
			<div class="row">
                <div class="col-md-2">
				
				</div>
				<div class="col-md-8">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
						
							<a href="report_personaltimetable.php" target="_blank"><button class="btn btn-md btn-primary btn-block">Personal Time table for Lecturer </button></a>
							
						</div>
					</section>
				</div>
			</div>
				<?php
												$sql1="SELECT * FROM lectureassign_details INNER JOIN subject_master ON lectureassign_details.subject_key=subject_master.subject_key
																						   INNER JOIN course_master ON subject_master.course_key=course_master.course_key
																						   INNER JOIN year_master ON subject_master.year_key=year_master.year_key
																						   INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																						   INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
																						   INNER JOIN cur_statusofbatch_details ON lectureassign_details.cur_statusbatch_key=cur_statusofbatch_details.curstatusbatch_detail_key
																						   INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																						   WHERE lecture_master.lecturemas_key='$lec_key'
																						     AND cur_statusofbatch_details.status=0";
												$result1=mysqli_query($link,$sql1);
												while($row1=mysqli_fetch_array($result1)){
													$y1=$row1['facalty_nme'];
													$y2=$row1['course_nme'];
													$y3=$row1['batch_code'];
													$y4=$row1['year_nme'];
													$y5=$row1['subject_name'];
										?>
						
						
			<div class="row">
                <div class="col-md-2">
				
				</div>
				<div class="col-md-8">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
										
									
						
										<div class="panel-body panel-transparent">
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y1." - ".$y2." - ".$y4;?></h2>
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y3." - ".$y5;?></h2>
										<!--<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y11;?></h2>
										<h2 style="font-weight:bold;font-size:18px;" align="center"><?php echo $y12;?></h2>-->
										
										<div class="row">
											<div class="col-md-4">
												
												<div class="form-group">
													<a href="tcpdf/reports/studailyattend.php?cs=<?php echo $row1['course_key']; ?>&curyr=<?php echo $row1['curstatusbatch_detail_key']; ?>&sub=<?php echo $row1['subject_key']; ?>" target="_blank"><button class="btn btn-md btn-block text-light" style="background-color:#0099cc;color:#ffffff;">Student Daily Attendance</button></a>
												</div>
												<div class="form-group">
													<a href="tcpdf/reports/yearplan.php?cs=<?php echo $row1['course_key']; ?>&curyr=<?php echo $row1['curstatusbatch_detail_key']; ?>&sub=<?php echo $row1['subject_key']; ?>" target="_blank"><button class="btn btn-md btn-block" style="background-color:#4dd2ff;color:#ffffff;">Year Plan</button></a>
												</div>
																																			
											</div>
											<div class="col-md-4">
											
												<div class="form-group">
													<a href="tcpdf/reports/termnote.php?cs=<?php echo $row1['course_key']; ?>&curyr=<?php echo $row1['curstatusbatch_detail_key']; ?>&sub=<?php echo $row1['subject_key']; ?>" target="_blank"><button class="btn btn-md btn-block" style="background-color:#0099cc;color:#ffffff;">Term Note</button></a>
												</div>	
												
												<div class="form-group">
													<a href="tcpdf/reports/schmeoftraning.php?cs=<?php echo $row1['course_key']; ?>&curyr=<?php echo $row1['curstatusbatch_detail_key']; ?>&sub=<?php echo $row1['subject_key']; ?>" target="_blank"><button class="btn btn-md btn-block" style="background-color:#006080;color:#ffffff;">Scheme of Training</button></a>
												</div>	
												
												<div class="form-group">
													<a href="tcpdf/reports/lessonplan.php?cs=<?php echo $row1['course_key']; ?>&curyr=<?php echo $row1['curstatusbatch_detail_key']; ?>&sub=<?php echo $row1['subject_key']; ?>" target="_blank"><button class="btn btn-md btn-block" style="background-color:#99e6ff;color:#ffffff;">Lesson Plan</button></a>
														
												</div>	
												
											</div>
											<div class="col-md-4">
												
												<div class="form-group">
													<a href="tcpdf/reports/dailyteachingrecord.php?cs=<?php echo $row1['course_key']; ?>&curyr=<?php echo $row1['curstatusbatch_detail_key']; ?>&sub=<?php echo $row1['subject_key']; ?>" target="_blank"><button class="btn btn-md btn-block" style="background-color:#0099cc;color:#ffffff;">Daily Teaching Record</button></a>
												</div>	
																								
												<div class="form-group">
													<a href="tcpdf/reports/assignmentplan.php?cs=<?php echo $row1['course_key']; ?>&curyr=<?php echo $row1['curstatusbatch_detail_key']; ?>&sub=<?php echo $row1['subject_key']; ?>" target="_blank"><button class="btn btn-md btn-block" style="background-color:#094173;color:#ffffff;">Assignment Plan</button></a>
														
												</div>	
													
											</div>
											
											
										
										
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
