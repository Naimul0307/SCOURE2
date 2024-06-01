<?php
// Include database connection
require_once "dbcon.php";

// Fetch customers from the database
$sql = "SELECT customer_id, firstname, lastname 
        FROM customers 
        WHERE role = 'user' 
        ORDER BY customer_id DESC";
$result = $con->query($sql);

$customers = array();

// Fetch results into associative array
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $customers[] = array(
            'customer_id' => $row['customer_id'],
            'firstname' => $row['firstname'],
            'lastname' => $row['lastname']
        );
    }
}

// Return JSON response
header('Content-Type: application/json');
echo json_encode($customers);
?>
