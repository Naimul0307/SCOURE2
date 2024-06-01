<?php 
session_start();

require_once "dbcon.php";

// Save Score
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer = mysqli_real_escape_string($con, $_POST['customer']);
    $option = mysqli_real_escape_string($con, $_POST['option']);
    $displayData = $option === 'time' ? mysqli_real_escape_string($con, $_POST['timeDisplay']) : mysqli_real_escape_string($con, $_POST['countDisplay']);
    
    if ($customer != "" && $option != "" && $displayData != "") {
        $sql = "INSERT INTO results (customer_id, score_type, display_data) VALUES ('$customer', '$option', '$displayData')";
        $query_run = mysqli_query($con, $sql); // Corrected variable name to $sql

        if($query_run) {
            $_SESSION['message'] = "Data saved successfully!";
            $response = array("success" => true);
        } else {
            $_SESSION['message'] = "Error saving data.";
            $response = array("success" => false);
        }
        echo json_encode($response);
    } else {
        // Send JSON response indicating error
        $_SESSION['message'] = "Customer, option, and display data cannot be empty!";
        $response = array("success" => false);
        echo json_encode($response);
    }
}
?>
