<?php
session_start();
$conn = mysqli_connect("localhost", "root", "", "pms");
if ($conn->connect_errno > 0) {
    die("Unable to connect: " . $conn->connect_error);
}
//fetch patient_id using hyperlink in doctors_home.php
$patients_id = intval($_GET['patients_id']);
$sql_patients = "SELECT * from patients where patients_id='" . $patients_id . "' ";
$results_patients = mysqli_query($conn, $sql_patients);
$row_patients= mysqli_fetch_row($results_patients);

//pick doctors list 
$doctors_id = $_SESSION['doctors_id'];
$sql_doctor = "SELECT * from doctors where doctors_id='".$doctors_id."' ";
$results_doctor = mysqli_query($conn, $sql_doctor);
$row_doctor= mysqli_fetch_row($results_doctor);

$sql_doctors = "SELECT * from doctors where 1";
$results_doctors = mysqli_query($conn, $sql_doctors);
// $row_patients= mysqli_fetch_row($results_patients)
if (isset($_POST['prescriptionForm'])) {

	    $prescription = $_POST['prescription'];
	    
	    $query_prescription = "INSERT INTO prescription (patients_id, doctors_id, prescription)
              VALUES ('".$patients_id."','".$doctors_id."','".$prescription."')";
        $result_prescription = mysqli_query($conn, $query_prescription);

 //fetch this new user info
    $sql_prescription = "SELECT * from prescription where patients_id='" . $patients_id . "' and doctors_id='" . $doctors_id . "' ";
    $results_prescription = mysqli_query($conn, $sql_prescription);

    if (mysqli_num_rows($results_prescription) >=1) {
        $_SESSION['doctors_id']= $doctors_id;
        $_SESSION['doctors_email'] = $row_doctor[5];
        $_SESSION['doctors_password'] = $row_doctor[7];
        header('Location: http://localhost/Patient%20Managment%20System/Doctors/doctors_home.php');
    }
     else {
        echo 'alert("Something wrong in Prescription.php")'.$prescription.$doctors_id.$patients_id;
    }
}
 ?>

<html lang="en">
<head>
<link href="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
<script src="//maxcdn.bootstrapcdn.com/bootstrap/3.3.0/js/bootstrap.min.js"></script>

<!------ Include the above in your HEAD tag ---------->

    <link href="https://fonts.googleapis.com/css?family=Oleo+Script:400,700" rel="stylesheet">
   	<link href="https://fonts.googleapis.com/css?family=Teko:400,700" rel="stylesheet">
   	<link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">

<!-- //Date And Time picker -->
   	
    <link href="css/bootstrap-datetimepicker.min.css" rel="stylesheet" media="screen">
   	
  <link href="css/style.css" rel="stylesheet"/>
</head>
<body>
<section id="contact">
			<div class="section-content">
				<h1 class="section-header"><span class="content-header wow fadeIn " data-wow-delay="0.2s" data-wow-duration="2s">
					<?php echo "$row_patients[1]"." "."$row_patients[2]";?> </span></h1>
				<h3><?php echo "$row_patients[3]";?></h3>
			</div>
			<div class="contact-section">
			<div class="container">
				<form method="POST" name="form1">
					<div class="col-md-6 form-line">
						 <div class="form-group">
						      <label for="inputState">State</label>
						      <select id="inputState" class="form-control">
						        <?php while ($row_doctors = mysqli_fetch_row($results_doctors)) {
                            ?>
						        <option>
						        	<a href="prescription.php?patients_id=<?php echo "$row_doctors[0]"; ?>">
						        	<?php echo "$row_doctors[1]"." "."$row_doctors[2]";?>
						        		</a>
						        </option>
						             <?php } ?>
						      </select>
						  </div>
						  <div class="form-group">
                				<label for="dtp_input1" class="control-label">Appointment Date</label>
                				<div class="input-group date form_datetime" data-date="2018-05-12T05:25:07Z" data-date-format="yyyy-M-dd HH:ii" data-link-field="dtp_input1">
                   				 <input class="form-control" size="16" type="text" value="" readonly>
                  			  <span class="input-group-addon"><span class="glyphicon glyphicon-remove"></span></span>
							<span class="input-group-addon"><span class="glyphicon glyphicon-th"></span></span>
                			</div>
							<input type="hidden" id="dtp_input1" value="" /><br/>
            				</div>
             
			  		</div>
			  		<div class="col-md-6">
			  			<div class="form-group">
			  				<label for ="description"> Prescription</label>
			  			 	<textarea  class="form-control" id="prescription" name="prescription" placeholder="Enter Your Message"></textarea>
			  			</div>	
			  			<button type="submit" name="prescriptionForm" id="submit" class="btn btn-default submit"><i class="fa fa-paper-plane" aria-hidden="true"></i>  Send Message</button>		  			
					</div>

				</form>
			</div>
		</section>

<script type="text/javascript" src="jquery/jquery-1.8.3.min.js" charset="UTF-8"></script>
<script type="text/javascript" src="bootstrap/js/bootstrap.min.js"></script>
<script type="text/javascript" src="../js/bootstrap-datetimepicker.js" charset="UTF-8"></script>
<script type="text/javascript" src="../js/locales/bootstrap-datetimepicker.fr.js" charset="UTF-8"></script>
<script type="text/javascript">
    $('.form_datetime').datetimepicker({
        //language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		forceParse: 0,
        showMeridian: 1
    });
	$('.form_date').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 2,
		minView: 2,
		forceParse: 0
    });
	$('.form_time').datetimepicker({
        language:  'fr',
        weekStart: 1,
        todayBtn:  1,
		autoclose: 1,
		todayHighlight: 1,
		startView: 1,
		minView: 0,
		maxView: 1,
		forceParse: 0
    });
</script>
	</body>
	</html>