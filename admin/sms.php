
<?php
ob_start();	
include 'conn.php';	
include 'sessionhandaler.php';
 require_once('notifylk/autoload.php');
// Please specify your Mail Server - Example: mail.example.com.
//ini_set("SMTP","txtlocal.co.uk");

// Please specify an SMTP Number 25 and 8889 are valid SMTP Ports.
//ini_set("smtp_port","25");

// Please specify the return address to use
//ini_set('sendmail_from', 'example@YourDomain.com');
?>

<?php
$cur_dte=date("Y-m-d");
$cur_yr=date("Y");
$twoweeksago=date('Y-m-d', strtotime('+14 days'));
?>
<?php
	if(isset($_POST['btn_sms'])){
		
		$sql11="SELECT * FROM shedule_details WHERE shedule_dte='$cur_dte' AND status=0";
		$result11 = mysqli_query($link,$sql11);
		while($row11=mysqli_fetch_array($result11)){
														
			$sql12="SELECT * FROM lecturedtemgt_details WHERE datos='$cur_dte' AND subject_key='$row11[subject_key]' AND curstateofbatch_key='$row11[curstausofbatch_key]' AND status=0";
			$result12 = mysqli_query($link,$sql12);
			if(mysqli_num_rows($result12)==0){
																
				$sql13="SELECT * FROM subject_master INNER JOIN shedule_details ON shedule_details.subject_key=subject_master.subject_key
													INNER JOIN cur_statusofbatch_details ON shedule_details.curstausofbatch_key=cur_statusofbatch_details.curstatusbatch_detail_key
													INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
													INNER JOIN course_master ON cur_statusofbatch_details.coursemas_key=course_master.course_key
													INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
													INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
													WHERE  shedule_details.sheduledetail_key='$row11[sheduledetail_key]'
													AND shedule_details.status=0";
				$result13 = mysqli_query($link,$sql13);
				while($row13=mysqli_fetch_array($result13)){
						$sql14="SELECT * FROM lecture_master INNER JOIN lectureassign_details ON lecture_master.lecturemas_key=lectureassign_details.lecture_key
											WHERE lectureassign_details.cur_statusbatch_key='$row13[curstausofbatch_key]'
											AND lectureassign_details.subject_key='$row13[subject_key]'
											AND lectureassign_details.status=0";
						$result14 = mysqli_query($link,$sql14);
						while($row14=mysqli_fetch_array($result14)){
							$lec_nme1=$row14['lecture_nme'];
							$lec_tp1=$row14['contact_no'];
							$lec_email1=$row14['email_address'];
							
						}
																	
						$sql15="SELECT MIN(shedule_dte)AS minsheduledte FROM shedule_details WHERE curstausofbatch_key='$row13[curstausofbatch_key]' AND subject_key='$row13[subject_key]' AND complete_status IS NULL AND shedule_dte<='$cur_dte' AND status=0";
						$result15 = mysqli_query($link,$sql15);
						while($row15=mysqli_fetch_array($result15)){
								$minsd1=$row15['minsheduledte'];
						}
																	
						$sql16="SELECT * FROM shedule_details WHERE curstausofbatch_key='$row13[curstausofbatch_key]' AND subject_key='$row13[subject_key]' AND complete_status IS NULL AND shedule_dte='$minsd1' AND status=0";
						$result16 = mysqli_query($link,$sql16);
						while($row16=mysqli_fetch_array($result16)){
																			
							$modulenme1=$row16['lesson_nme'];
						}
							
							$message = $row13['course_nme'].'-'.$row13['batch_code'].'-'.$row13['subject_name'].'- Pending Module :'.$modulenme1; // string | Text of the message. 320 chars max.
							
							$api_instance = new NotifyLk\Api\SmsApi();
							$user_id = "12454"; // string | API User ID - Can be found in your settings page.
							$api_key = "Oj8yJ8DNvAp8t76kCvAJ"; // string | API Key - Can be found in your settings page.
							
							$to = $lec_tp1; // string | Number to send the SMS. Better to use 9471XXXXXXX format.
							$sender_id = "NotifyDEMO"; // string | This is the from name recipient will see as the sender of the SMS. Use \\\"NotifyDemo\\\" if you have not ordered your own sender ID yet.
							$contact_fname = $lec_nme1; // string | Contact First Name - This will be used while saving the phone number in your Notify contacts.
							$contact_lname = $lec_nme1; // string | Contact Last Name - This will be used while saving the phone number in your Notify contacts.
							$contact_email = $lec_email1; // string | Contact Email Address - This will be used while saving the phone number in your Notify contacts.
							$contact_address = "ssd"; // string | Contact Physical Address - This will be used while saving the phone number in your Notify contacts.
							$contact_group = 0; // int | A group ID to associate the saving contact with

							try {
								$api_instance->sendSMS($user_id, $api_key, $message, $to, $sender_id, $contact_fname, $contact_lname, $contact_email, $contact_address, $contact_group);
							} catch (Exception $e) {
								echo 'Exception when calling SmsApi->sendSMS: ', $e->getMessage(), PHP_EOL;
							}
				}
			}
															
		}
		
		$sql8="SELECT * FROM subject_master INNER JOIN assignmentmgt_master ON subject_master.subject_key=assignmentmgt_master.subject_key
																						  INNER JOIN lectureassign_details ON lectureassign_details.subject_key=subject_master.subject_key
																						  INNER JOIN course_master ON subject_master.course_key=course_master.course_key
																						   INNER JOIN year_master ON subject_master.year_key=year_master.year_key
																						   INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																						   INNER JOIN lecture_master ON lectureassign_details.lecture_key=lecture_master.lecturemas_key
																						   INNER JOIN cur_statusofbatch_details ON lectureassign_details.cur_statusbatch_key=cur_statusofbatch_details.curstatusbatch_detail_key
																						   INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																						   WHERE cur_statusofbatch_details.acadamic_yer='$cur_yr'
																						     AND cur_statusofbatch_details.status=0
																							 AND assignmentmgt_master.complete_status IS NULL 
																							 AND assignmentmgt_master.status=0
																							 AND assignmentmgt_master.datos='$twoweeksago'
																							 ORDER BY assignmentmgt_master.datos ASC";
		$result8=mysqli_query($link,$sql8);
		while($row8=mysqli_fetch_array($result8)){
			
							$message = 'Reminder: Assignment Upcoming to '.$row8['datos'].'-'.$row8['course_nme'].'-'.$row8['batch_code'].'-'.$row8['subject_name']; // string | Text of the message. 320 chars max.
							
							$api_instance = new NotifyLk\Api\SmsApi();
							$user_id = "12454"; // string | API User ID - Can be found in your settings page.
							$api_key = "Oj8yJ8DNvAp8t76kCvAJ"; // string | API Key - Can be found in your settings page.
							
							$to = $row8['contact_no']; // string | Number to send the SMS. Better to use 9471XXXXXXX format.
							$sender_id = "NotifyDEMO"; // string | This is the from name recipient will see as the sender of the SMS. Use \\\"NotifyDemo\\\" if you have not ordered your own sender ID yet.
							$contact_fname = $row8['lecture_nme']; // string | Contact First Name - This will be used while saving the phone number in your Notify contacts.
							$contact_lname = $row8['lecture_nme']; // string | Contact Last Name - This will be used while saving the phone number in your Notify contacts.
							$contact_email = $row8['email_address']; // string | Contact Email Address - This will be used while saving the phone number in your Notify contacts.
							$contact_address = "ssd"; // string | Contact Physical Address - This will be used while saving the phone number in your Notify contacts.
							$contact_group = 0; // int | A group ID to associate the saving contact with

							try {
								$api_instance->sendSMS($user_id, $api_key, $message, $to, $sender_id, $contact_fname, $contact_lname, $contact_email, $contact_address, $contact_group);
							} catch (Exception $e) {
								echo 'Exception when calling SmsApi->sendSMS: ', $e->getMessage(), PHP_EOL;
							}
			
		}
		
		
	}

?>


<!DOCTYPE html>

<html class="bootstrap-admin-vertical-centered">
    <head>
        <title>SMS</title>
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
                <div class="col-md-3">
				
				</div>
				<div class="col-md-6">
					<section class="panel panel-transparent">
						<div class="panel-body panel-transparent">
							<form role="form" method="post" name="f1">
									
									<button type="submit" name="btn_sms" class="btn btn-primary btn-lg btn-block">SMS</button>
									
								</form>
						</div>
					</section>
				</div>
			</div>
			
			
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-1">
								
					</div>
					<div class="col-md-10">
						<section class="panel panel-transparent">
							<div class="panel-body panel-transparent">
								<h4>Missing Lecturer Notification</h4>
								<table class="table table-striped table-bordered" width="100%">
									<thead>
										<tr>
											<th><font color="red">&lowast;</font>Faculty</th>
											<th><font color="red">&lowast;</font>Course</th>
											<th><font color="red">&lowast;</font>Batch</th>
											<th><font color="red">&lowast;</font>Semester</th>
											<th><font color="red">&lowast;</font>Subject</th>
											<th><font color="red">&lowast;</font>Lecturer</th>
											<th><font color="red">&lowast;</font>Module</th>
											
										</tr>
									</thead>
									<tbody>
										
													<?php
														$sql1="SELECT * FROM shedule_details WHERE shedule_dte='$cur_dte' AND status=0";
														$result1 = mysqli_query($link,$sql1);
														while($row1=mysqli_fetch_array($result1)){
														
															$sql2="SELECT * FROM lecturedtemgt_details WHERE datos='$cur_dte' AND subject_key='$row1[subject_key]' AND curstateofbatch_key='$row1[curstausofbatch_key]' AND status=0";
															$result2 = mysqli_query($link,$sql2);
															if(mysqli_num_rows($result2)==0){
																
																$sql3="SELECT * FROM subject_master INNER JOIN shedule_details ON shedule_details.subject_key=subject_master.subject_key
																									INNER JOIN cur_statusofbatch_details ON shedule_details.curstausofbatch_key=cur_statusofbatch_details.curstatusbatch_detail_key
																									INNER JOIN batch_master ON cur_statusofbatch_details.batchmas_key=batch_master.batch_mas_key
																									INNER JOIN course_master ON cur_statusofbatch_details.coursemas_key=course_master.course_key
																									INNER JOIN year_master ON cur_statusofbatch_details.semester_key=year_master.year_key
																									INNER JOIN facalty_master ON course_master.facalty_key=facalty_master.facalty_key
																									WHERE  shedule_details.sheduledetail_key='$row1[sheduledetail_key]'
																										AND shedule_details.status=0";
																$result3 = mysqli_query($link,$sql3);
																while($row3=mysqli_fetch_array($result3)){
																	$sql4="SELECT * FROM lecture_master INNER JOIN lectureassign_details ON lecture_master.lecturemas_key=lectureassign_details.lecture_key
																									WHERE lectureassign_details.cur_statusbatch_key='$row3[curstausofbatch_key]'
																									AND lectureassign_details.subject_key='$row3[subject_key]'
																									AND lectureassign_details.status=0";
																	$result4 = mysqli_query($link,$sql4);
																	while($row4=mysqli_fetch_array($result4)){
																		$lec_nme=$row4['lecture_nme'];
																		$lec_tp=$row4['contact_no'];
																	}
																	
																	$sql5="SELECT MIN(shedule_dte)AS minsheduledte FROM shedule_details WHERE curstausofbatch_key='$row3[curstausofbatch_key]' AND subject_key='$row3[subject_key]' AND complete_status IS NULL AND shedule_dte<='$cur_dte' AND status=0";
																	$result5 = mysqli_query($link,$sql5);
																	while($row5=mysqli_fetch_array($result5)){
																		$minsd=$row5['minsheduledte'];
																	}
																	
																	$sql6="SELECT * FROM shedule_details WHERE curstausofbatch_key='$row3[curstausofbatch_key]' AND subject_key='$row3[subject_key]' AND complete_status IS NULL AND shedule_dte='$minsd' AND status=0";
																	$result6 = mysqli_query($link,$sql6);
																	while($row6=mysqli_fetch_array($result6)){
																			
																			$modulenme=$row6['lesson_nme'];
																	}
																	
																	echo "<tr>
																		<td>".$row3['facalty_nme']."</td>
																		<td>".$row3['course_nme']."</td>
																		<td>".$row3['batch_code']."</td>
																		<td>".$row3['year_nme']."</td>
																		<td>".$row3['subject_name']."</td>
																		<td>".$lec_nme."</td>
																		<td>".$modulenme."</td>
																		
																	</tr>";
																}
															}
															
														}
													?>
										
									</tbody>
								</table>
							</div>
						</section>
					</div>
				</div>
			</div>
			
			<div class="row">
				<div class="col-md-12">
					<div class="col-md-1">
								
					</div>
					<div class="col-md-10">
						<section class="panel panel-transparent">
							<div class="panel-body panel-transparent">
								<h4>Assignment Information Notification  <?php echo  $twoweeksago;?></h4>
								<table class="table table-striped table-bordered" width="100%">
									<thead>
										<tr>
												<th width="8%">Date</th>
												<th width="20%">Course</th>
												<th width="10%">Batch</th>
												<th width="14%">Semester</th>
												<th width="12%">Subject</th>
												<th width="11%">Method</th>
												<th width="17%">Description</th>
												<th width="8%">Total Marks</th>
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
																						     AND cur_statusofbatch_details.status=0
																							 AND assignmentmgt_master.complete_status IS NULL 
																							 AND assignmentmgt_master.status=0
																							 AND assignmentmgt_master.datos='$twoweeksago'
																							 ORDER BY assignmentmgt_master.datos ASC";
												$result7=mysqli_query($link,$sql7);
												while($row7=mysqli_fetch_array($result7)){
											?>
													<tr>
														<td><div class="tcontents"><?php echo $row7['datos']?></div></td>
														<td><div class="tcontents"><?php echo $row7['course_nme']."-".$row7['facalty_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row7['batch_code']?></div></td>
														<td><div class="tcontents"><?php echo $row7['year_nme']?></div></td>
														<td><div class="tcontents"><?php echo $row7['subject_name']?></div></td>
														<td><div class="tcontents"><?php echo $row7['method']?></div></td>
														<td><div class="tcontents"><?php echo $row7['description']?></div></td>
														<td><div class="tcontents"><?php echo $row7['marks']?>%</div></td>
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
			</div>
		   <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
			<script type="text/javascript" src="js/jquery-2.0.3.min.js"></script>
			<script type="text/javascript" src="js/bootstrap.min.js"></script>
			<script type="text/javascript" src="js/twitter-bootstrap-hover-dropdown.min.js"></script>
			<script type="text/javascript" src="js/bootstrap-admin-theme-change-size.js"></script>
			<script type="text/javascript" src="vendors/easypiechart/jquery.easy-pie-chart.js"></script>
    </body>
</html>
