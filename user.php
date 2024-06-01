<?php 
session_start();

require_once "dbcon.php";

// User Creation
if(isset($_POST['firstname']) && isset($_POST['lastname']) && isset($_POST['email']) && isset($_POST['phone'])) {
    $firstname = mysqli_real_escape_string($con, $_POST['firstname']);
    $lastname = mysqli_real_escape_string($con, $_POST['lastname']);
    $email = mysqli_real_escape_string($con, $_POST['email']);
    $phone = mysqli_real_escape_string($con, $_POST['phone']);

    $query = "INSERT INTO customers (firstname, lastname, email, phone) VALUES ('$firstname','$lastname', '$email', '$phone')";
    
    $query_run = mysqli_query($con, $query);
    
    if($query_run) {
        $_SESSION['message'] = "User saved successfully!";
        $response = array("success" => true);
    } else {
        $_SESSION['message'] = "Error saving user data.";
        $response = array("success" => false);
    }
    echo json_encode($response);
} else {
    $_SESSION['message'] = "Form data cannot be empty!";
    $response = array("success" => false);
    echo json_encode($response);
}
?>