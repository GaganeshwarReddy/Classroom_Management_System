
<?php
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
		<div class="row">
				<div class="col-md-1">
				
				</div>
				<div class="col-md-12">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<div style="font-size:16px;font-weight:bold;"align="center">Subject Modulation and scheduling </div>
						</div>
					</section>
				</div>
			</div>
		
			<div class="row">
                <div class="col-md-1">
				
				</div>
				<div class="col-md-12">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<table class="table display" id="example" width="100%">
                                        <thead>
                                            <tr style="background-color:  #1b4f72 ">
												<th width="17%">Department</th>
												<th width="20%">Course</th>
												<th width="9%">Batch</th>
												<th width="15%">Semester</th>
												<th width="25%">Subject</th>
												<th width="13%">Lecture</th>
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
																						   WHERE cur_statusofbatch_details.acadamic_yer='$cur_yr'
																						    AND lecture_master.lecturemas_key='$lec_key'
																						     AND cur_statusofbatch_details.status=0";
												$result1=mysqli_query($link,$sql1);
												while($row1=mysqli_fetch_array($result1)){
											?>
													<tr class="clickable-row" data-href="subject_modulationandshedue.php?suk=<?php echo $row1['subject_key'];?>&curyr=<?php echo $row1['curstatusbatch_detail_key'];?>">
														<td><div class="tcontents"><?php echo $row1['facalty_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row1['course_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row1['batch_code']?></div></td>
														<td><div class="tcontents"><?php echo $row1['year_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row1['subject_name']?></div></td>
														<td><div class="tcontents"><?php echo $row1['lecture_nme']?></div></td>
														<td><a href="subject_modulationandshedue.php?suk=<?php echo $row1['subject_key'];?>&curyr=<?php echo $row1['curstatusbatch_detail_key'];?>"><button class='btn btn-sm btn-primary btn-block'>Modeling And Scheduling</button></a></td>
													</tr>
											<?php
												}
											?>
										
                                        </tbody>
                            </table>
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
