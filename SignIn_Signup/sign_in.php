<?php
session_start();

//Database Connection Start
$conn = mysqli_connect("localhost", "root", "", "PMS");
if ($conn->connect_errno > 0) {
    die("Unable to connect: " . $conn->connect_error);
}//Database Connection End

//Fetch All the info from sign in form start
if (isset($_POST['signin'])) {
    //fetch user email and password
    $users_email = $_POST['patients_email'];
    $users_password = $_POST['patients_password'];

    //fetch Patients all info using his email and password
    $sql_patients = "SELECT * from patients where patients_email='" . $users_email . "' and patients_password='" . $users_password . "' ";
    $results_patients=mysqli_query($conn, $sql_patients);


     //fetch user all info using his email and password
    $sql_doctors = "SELECT * from doctors where doctors_email='" . $users_email . "' and doctors_password='" . $users_password . "' ";
    $results_doctors=mysqli_query($conn, $sql_doctors);
    $row_doctors=mysqli_fetch_row($results_doctors);
    $doctors_id = $row_doctors[0];
    $doctors_firstName = $row_doctors[1];
    $doctors_lastName = $row_doctors[2];
    $doctors_email = $row_doctors[5];
    $doctors_password = $row_doctors[7];
    $doctors_phnNumber = $row_doctors[6];
   
    //Patient login
    if (mysqli_num_rows($results_patients) >= 1 && $patients_firstName != "Dr") {
        $_SESSION['patients_firstName'] = $patients_firstName;
        $_SESSION['patients_lastName'] = $patients_lastName;
        $_SESSION['patients_email'] = $users_email;
        $_SESSION['patients_password'] = $users_password;
        $_SESSION['patients_phnNumber'] = $patients_phnNumber;
        header('Location: http://localhost/Patient%20Managment%20System/home.php');
    }
    //doctors login
    else if (mysqli_num_rows($results_doctors) >= 1 && $doctors_firstName == "Dr"){
        $_SESSION['doctors_id'] = $doctors_id;
       $_SESSION['doctors_firstName'] = $doctors_firstName;
        $_SESSION['doctors_lastName'] = $doctors_lastName;
        $_SESSION['doctors_email'] = $doctors_email;
        $_SESSION['doctors_password'] = $doctors_password;
        $_SESSION['doctors_phnNumber'] = $doctors_phnNumber;
        header('Location: http://localhost/Patient%20Managment%20System/Doctors/doctors_home.php');
    }
    //false login
    else {
        echo '<script>';
        echo 'alert("Please Provide Right Information")';
        echo '</script>';
        
    }
}


if (isset($_POST['forget'])) {
//fetch user email and password
    $patients_email = $_POST['forget_email'];
    $forget_phnNumber = $_POST['forget_phnNumber'];

    $sql_forget = "SELECT * FROM users where user_email='" . $user_email . "' 
    and user_phnNumber='" . $forget_phnNumber . "'";

    $querry_forget = mysqli_query($conn, $sql_forget);
    $row_forget = mysqli_fetch_row($querry_forget);
    $user_forget_id = $row_forget[0];

    if (mysqli_num_rows($querry_forget) >= 1) {
        $_SESSION['user_forget_id'] = $user_forget_id;
        header('Location: http://localhost/project_dbms/user_forgetpassword.php');
    }
    else{
        echo "Wrong!!";
    }


}
?>
<html>
<!--/**-->
<!--* Created by PhpStorm.-->
<!--* User: Tajul Islam Parvaz-->
<!--* Date: 9/3/2017-->
<!--* Time: 12:19 PM-->
<!--*/-->
<head>
    <meta charset="UTF-8">
    <title>Please Sign In First</title>
    <link href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" rel="stylesheet"
          integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
          integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <link rel="stylesheet" type="text/css" href="css/sign_in.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <style>
        a {
            text-decoration: none !important;
        }
    </style>
    <script>
    </script>
</head>
<body style="background-color: #002141;">
<br><br><br><br><br><br><br>
<!--Sign In form Start-->

<div class="container col-sm-8 col-sm-offset-2" style="background-color: skyblue; margin-top: -15px; border: white solid medium;">
    <div class="omb_login">
        <h3 class="omb_authTitle">Login or <a href="http://localhost/Patient%20Managment%20System/SignIn_Signup/sign_up.php"
                                              style="font-size: 25px;">Sign up</a></h3>
        <div class="row omb_row-sm-offset-3 omb_socialButtons">
            <div class="col-xs-4 col-sm-2">
                <a href="https://www.facebook.com/" class="btn btn-lg btn-block omb_btn-facebook">
                    <i class="fa fa-facebook visible-xs"></i>
                    <span class="hidden-xs">Facebook</span>
                </a>
            </div>
            <div class="col-xs-4 col-sm-2">
                <a href="https://twitter.com/" class="btn btn-lg btn-block omb_btn-twitter">
                    <i class="fa fa-twitter visible-xs"></i>
                    <span class="hidden-xs">Twitter</span>
                </a>
            </div>
            <div class="col-xs-4 col-sm-2">
                <a href="https://www.google.com/" class="btn btn-lg btn-block omb_btn-google">
                    <i class="fa fa-google-plus visible-xs"></i>
                    <span class="hidden-xs">Google+</span>
                </a>
            </div>
        </div>
        <div class="row omb_row-sm-offset-3 omb_loginOr">
            <div class="col-xs-12 col-sm-6">
                <hr class="omb_hrOr">
                <span class="omb_spanOr">or</span>
            </div>
        </div>
        <div class="row omb_row-sm-offset-3">
            <div class="col-xs-12 col-sm-6">
                <form class="omb_loginForm" action="" autocomplete="off" method="POST">
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                        <input type="text" class="form-control" name="patients_email" placeholder="email address">
                    </div>
                    <span class="help-block"></span>
                    <div class="input-group">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                        <input  type="password" class="form-control" name="patients_password" placeholder="Password">
                    </div>
                    <br>
                    <button id="sign_in" class="btn btn-lg btn-primary btn-block" type="submit" name="signin">Login</button>
                </form>
            </div>
        </div>
        <div class="row omb_row-sm-offset-3  col-sm-offset-1">
            <div class="col-xs-12 col-sm-3">
                <label class="checkbox">
                    <input type="checkbox" value="remember-me">Remember Me
                </label>
            </div>
            <div class="col-xs-12 col-sm-3">
                <p class="omb_forgotPwd" id="demo">
                <h5><b><a href="#" data-toggle="modal" data-target="#fp">Forgot password?</a></b></h5>
                </p>
            </div>
        </div>
    </div>
</div>  <!--Sign In form End-->

<div class="container" >
    <div class="col-sm-12">
        <div class="modal" id="fp">
            <div class="modal-dialog" style="border: white solid medium;">
                <div class="modal-content">
                    <div class="modal-header" style="background: skyblue;">
                        <h1 class="text-center">Password Recovery!!</h1>
                    </div>
                    <div class="modal-body" style="background: skyblue;">
                        <form method="post">
                            <div class="form-group">
                                <label for="email"> Email Address </label>
                                <input  type="text" placeholder="Enter your Email Address" name="forget_email" class="form-control">
                            </div>
                            <div class="form-group">
                                <label for="email"> Phone Number </label>
                                <input  type="text" placeholder="Enter your Phone Number" name="forget_phnNumber" class="form-control">
                            </div>
                           <div class="form-group">
                               <input type="submit" class="btn-primary" name="forget" href="#" data-toggle="modal" data-target="#fpass">
                           </div>
                        </form>
                    </div>
                    <div class="modal-footer" style="background: skyblue;">
                        <button class="close" data-dismiss="modal" >&times;</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<!---->
<!--<div class="container">-->
<!--    <div class="col-sm-12">-->
<!--        <div class="modal" id="fpass">-->
<!--            <div class="modal-dialog">-->
<!--                <div class="modal-content">-->
<!--                    <div class="modal-header">-->
<!--                        <h1 class="text-center">Password Recovery!!</h1>-->
<!--                    </div>-->
<!--                    <div class="modal-body">-->
<!--                        <form class="form-horizontal" name="" method="POST" style="color: white;">-->
<!--                            <div class="form-group">-->
<!--                                <label class="col-lg-3 control-label">New Password:</label>-->
<!--                                <div class="col-lg-8">-->
<!--                                    <input class="form-control" name="new_password" type="text"-->
<!--                                           value="--><?php //echo "Enter Your New Password" ?><!--">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label class="col-lg-3 control-label">Confirm Password:</label>-->
<!--                                <div class="col-lg-8">-->
<!--                                    <input class="form-control" name="confirm_password" type="text"-->
<!--                                           value="--><?php //echo "Confirm Password" ?><!--">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                            <div class="form-group">-->
<!--                                <label class="col-md-3 control-label"></label>-->
<!--                                <div class="col-md-8">-->
<!--                                    <input type="submit" name="submit_forgetpass" class="btn btn-primary"-->
<!--                                           value="Save Changes">-->
<!--                                    <input type="reset" data-dismiss="modal" class="btn btn-default" value="Cancel" href="sign_in.php">-->
<!--                                </div>-->
<!--                            </div>-->
<!--                        </form>-->
<!--                    </div>-->
<!--                </div>-->
<!--            </div>-->
<!--        </div>-->
<!--    </div>-->
<!--</div>-->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/js/bootstrap.min.js"
        integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa"
        crossorigin="anonymous"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
</body>
</html>