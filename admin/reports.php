
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
    </head>
    <body class="bc" style="background-image: url('images/a2.jpg')">
	   <?php include('navi.php') ?>
       <br>
	   <br>
	   <br>
			
			<div class="row">
                <div class="col-md-2">
				
				</div>
				<div class="col-md-3">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
						
							<a href="report_personaltimetable.php" target="_blank"><button class="btn btn-md btn-primary btn-block">Personal Time table for Lecturer </button></a>
							<br>
							<a href="report_classtimetable.php" target="_blank"><button class="btn btn-md btn-info btn-block">Class(Course)  Time table </button></a>
							<br>
							<a href="report_personaltimetable.php" target="_blank"><button class="btn btn-md btn-primary btn-block">Curryculum </button></a>
							<br>
							<a href="report_classtimetable.php" target="_blank"><button class="btn btn-md btn-info btn-block">Class Teacher Apoinment </button></a>
							<br>
						</div>
					</section>
				</div>
				
					<div class="col-md-3">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
						
							<a href="report_termnote.php" target="_blank"><button class="btn btn-md btn-primary btn-block">Term Note </button></a>
							<br>
							<a href="report_yearplane.php" target="_blank"><button class="btn btn-md btn-info btn-block">Year Plan </button></a>
							<br>
							<a href="report_schmeoftraning.php" target="_blank"><button class="btn btn-md btn-primary btn-block">Scheme of Training </button></a>
							<br>
							<a href="report_lessonplan.php" target="_blank"><button class="btn btn-md btn-info btn-block">Lesson Plan </button></a>
							<br>
							<a href="report_dailyteachrecord.php" target="_blank"><button class="btn btn-md btn-primary btn-block">Daily Teaching Record </button></a>
							<br>
							<a href="report_monthlyteachprogress.php" target="_blank"><button class="btn btn-md btn-info btn-block">Monthly Teaching Progress </button></a>
							<br>
							<a href="report_assignmentplan.php" target="_blank"><button class="btn btn-md btn-primary btn-block">Assignment Plan </button></a>
							<br>
							<a href="report_assignmentsummary.php" target="_blank"><button class="btn btn-md btn-info btn-block">Contuses Assessment Summery Sheet </button></a>
						</div>
					</section>
				</div>
				
					<div class="col-md-3">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
						
							<a href="report_studailyattend.php" target="_blank"><button class="btn btn-md btn-primary btn-block">Student Daily Attendance  </button></a>
							<br>
							<a href="report_presentageattend.php" target="_blank"><button class="btn btn-md btn-info btn-block">Parentage of Attendance </button></a>
							<br>
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
