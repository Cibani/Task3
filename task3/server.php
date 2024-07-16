<?php
session_start();
// initialising variables
$username ="";
$email ="";
$errors ="";

//connect to the database
$db = mysqli_connect("127.0.0.1", "root", "Cibani3003#","test");
if (!$db)
    die("could not connect".mysqli_connect_error()); 

//REGISTER USER
if (isset($_POST['reg_user'])) {
    //receive all input values from the form
    $username = mysqli_real_escape_string($db, $_POST['username']);
    $email = mysqli_real_escape_string($db, $_POST['email']);
    $password_1 = mysqli_real_escape_string($db, $_POST['password_1']);
    $password_2 = mysqli_real_escape_string($db, $_POST['password_2']);

    //form validation: ensure that form is correctly filled...
    //by adding (array_push()) corresponding error unto $errors array
    if (empty($username)) {array_push($errors, "Username is required"); }
    if (empty($email)) {array_push($errors, "Email is required"); }
    if (empty($password_1)) {array_push($errors, "Password is required"); }
    if ($password_1 != $password_2) {array_push($errors, "Password mismatch"); }
    
    // first check the databasse to make sure
    // a user does not already exist with the same wsername and/or email
    $user_check_query = "SELCT * FROM users_new WHERE username='$username' OR email='$email";
    $result = mysqli_query($sd, $usser_check_query);
    $user = mysqli_fetch_assoc($result);
    
    if ($user) {//if user exists
    if ($user ['username'] === $username) {
        array_push($errors, "Username already exists");
    }
    if ($user['email'] === $email) {
        array_push($errors, "email already exists");
    }
    }
    //Finally, register user if there are no errors in the form
    if (count($errors) == 0) {
        $password =md5($password_1); //encrypt the password before storing in the database
        
    }


}


