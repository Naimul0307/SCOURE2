<?php
session_start();
require_once "dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $customer = mysqli_real_escape_string($con, $_POST['customer']);
    $option = mysqli_real_escape_string($con, $_POST['option']);
    $displayData = $option === 'time' ? mysqli_real_escape_string($con, $_POST['timeDisplay']) : mysqli_real_escape_string($con, $_POST['countDisplay']);

    if ($customer != "" && $option != "" && $displayData != "") {
        $sql = "INSERT INTO results (customer_id, score_type, display_data) VALUES ('$customer', '$option', '$displayData')";
        if (mysqli_query($con, $sql)) {
            echo "Data saved successfully.";
        } else {
            echo "Error saving data.";
        }
    } else {
        echo "Customer, option, and display data cannot be empty!";
    }
}
?>
