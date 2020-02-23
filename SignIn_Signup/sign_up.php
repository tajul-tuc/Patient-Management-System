<?php


session_start();
//Database Connection Start
$conn = mysqli_connect("localhost", "root", "", "pms");
if ($conn->connect_errno > 0) {
    die("Unable to connect: " . $conn->connect_error);
}//Database Connection End

//fetch user information using sign up form
if (isset($_POST['signup'])) {
    $patients_firstName = $_POST['patients_firstName'];
    $patients_lastName = $_POST['patients_lastName'];
    $patients_address = $_POST['patients_address'];
    $patients_city = $_POST['patients_city'];
 
    $patients_email = $_POST['patients_email'];
    $patients_phnNumber = $_POST['patients_phnNumber'];
    $patients_password = $_POST['patients_password'];
 
    //Insert new user info into the database table
    if ($patients_firstName != "Dr") {
        # code...
        $query_patients = "INSERT INTO patients (patients_firstName, patients_lastName,patients_address,patients_city,patients_email,patients_phnNumber,patients_password)
              VALUES ('" . $_POST["patients_firstName"] . "','" . $_POST["patients_lastName"] . "','" . $_POST['patients_address'] . "',
              '" . $_POST['patients_city'] . "','" . $_POST["patients_email"] . "','" . $_POST["patients_phnNumber"] . "',"
        . "'" . $_POST["patients_password"] . "')";
        $result_patients = mysqli_query($conn, $query_patients);
    }
    else if($patients_firstName == "Dr"){
        $query_doctors = "INSERT INTO doctors (doctors_firstName, doctors_lastName,doctors_address,doctors_city,doctors_email,doctors_phnNumber,doctors_password)
              VALUES ('" . $_POST["patients_firstName"] . "','" . $_POST["patients_lastName"] . "','" . $_POST['patients_address'] . "',
              '" . $_POST['patients_city'] . "','" . $_POST["patients_email"] . "','" . $_POST["patients_phnNumber"] . "',"
        . "'" . $_POST["patients_password"] . "')";
    $result_doctors = mysqli_query($conn, $query_doctors);

    }
    

    //fetch this new user info
    $sql_patients = "SELECT * from patients where patients_email='" . $patients_email . "' and patients_password='" . $patients_password . "' ";
    $results_patients = mysqli_query($conn, $sql_patients);

     //fetch this new user info
    $sql_doctors = "SELECT * from doctors where doctors_email='" . $patients_email . "' and doctors_password='" . $patients_password . "' ";
    $results_doctors = mysqli_query($conn, $sql_doctors);

    if (mysqli_num_rows($results_patients) >= 1 && $patients_firstName != "admin") {
        $_SESSION['patients_firstName'] = $patients_firstName;
        $_SESSION['patients_lastName'] = $patients_lastName;
        $_SESSION['patients_email'] = $patients_email;
        $_SESSION['patients_password'] = $patients_password;
        $_SESSION['patients_phnNumber'] = $patients_phnNumber;
        header('Location: http://localhost/Patient%20Managment%20System/home.php');
    }
    elseif (mysqli_num_rows($results_patients) == 0 && $patients_firstName == "Dr"){
        $_SESSION['doctors_firstName'] = $patients_firstName;
        $_SESSION['doctors_lastName'] = $patients_lastName;
        $_SESSION['doctors_email'] = $patients_email;
        $_SESSION['doctors_password'] = $patients_password;
        $_SESSION['doctors_phnNumber'] =  $patients_phnNumber;
        header('Location: http://localhost/Patient%20Managment%20System/Doctors/doctors_home.php');
    }
    else {
        echo 'alert("Something wrong in Sign_up.php")';
    }
}
?>
<!DOCTYPE html>
<!--
/**
 * Created by PhpStorm.
 * User: Tajul Islam Parvaz
 * Date: 9/3/2017
 * Time: 12:19 PM
 */
-->
<html>
<head>
    <meta charset="UTF-8">
    <title>Please Sign Up For Free</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/sign_up.css">
    <script src="js/sign_up.js"></script>
  
         <script type="text/javascript">
           
    </script>
</head>
<body style="background-color: #002141;">
<!--Sign Up Form Start-->
<div class="container" style="background: skyblue; border: white solid medium;">
    <h1 class="well">Registration Form</h1>
    <div class="col-lg-12 well" style="background: skyblue;">
        <div class="row">
            <form method="POST" id="insert_form" name="form1" style="background: skyblue;" onsubmit="return checkforSignup()">
                <div class="col-sm-12">
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>First Name</label>
                            <input type="text" placeholder="Enter First Name Here.." class="form-control"
                                   name="patients_firstName" id="patients_firstName">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Last Name</label>
                            <input type="text" placeholder="Enter Last Name Here.." class="form-control"
                                   name="patients_lastName" id="patients_lastName">
                        </div>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <textarea placeholder="Enter Address Here.." rows="3" class="form-control address"
                                  name="patients_address" id="patients_address"></textarea>
                    </div>
                    <div class="row">
                        <div class="col-sm-4 form-group">
                            <label>City</label>
                            <input type="text" placeholder="Enter City Name Here.." class="form-control city"
                                   name="patients_city" id="patients_city">
                        </div>
                       
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                            <label>Password</label>
                            <input type="password" placeholder="Enter at least a 6 digit password"
                                   class="form-control pass" name="patients_password" id="patients_password" id="patients_password">
                        </div>
                        <div class="col-sm-6 form-group">
                            <label>Confirm Password</label>
                            <input type="password" placeholder="Re enter your password" class="form-control con_pass"
                                   name="con_pass" id="con_pass">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-6 form-group">
                        <label>Phone Number</label>
                        <input type="text" placeholder="Enter Phone Number Here.." class="form-control phn_number"
                               name="patients_phnNumber" id="patients_phnNumber">
                    </div>
                        <div class="col-sm-6 form-group">
                        <label>Email Address</label>
                        <input type="text" placeholder="Enter Email Address Here.." class="form-control email"
                               id="patients_email" name="patients_email" onblur="return checkform()">
                        <span id="user-availability-status" style="font-size:12px;"></span>
                    </div>
                    </div>
                    <input type="submit" name="signup" id="submit" class="btn btn-lg btn-primary"
                             value="Submit">
                    
                </div>
            </form>
        </div>
    </div>
</div>
<!--User Sign Up Form End-->

<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script type="text/javascript" src="js/bootstrap.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
<script type="text/javascript" src="js/jquery-1.11.3.min.js">

<script type="text/javascript">
    
    function checkforSignup(){
        var patients_firstName = document.getElementById('patients_firstName');
        var patients_lastName = document.getElementById("patients_lastName");
        var patients_email = document.getElementById("patients_email");
        var patients_address = document.getElementById("patients_address");

        var patients_password = document.getElementById("patients_password");
        var con_pass = document.getElementById("con_pass");

        var filter= /^([A-Za-z0-9]+)@([A-Za-z0-9]+).([A-Za-z0-9]{2,4})$/;
        if (patients_firstName.value.length == 0 || patients_lastName.value.length) {
            alert("Enter A Value!!");
            return false;
        }

        else if (!filter.test(patients_email.value)) {
            alert("Not Valid Email!!");
            return false;
        }
        


    }
</script>  
    </body>
    < /html>
