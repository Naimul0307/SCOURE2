<?php
session_start();

require_once "dbcon.php";

$data = [];

// Fetch distinct score types
$sql_score_types = "SELECT DISTINCT score_type FROM results";
$result_score_types = $con->query($sql_score_types);

while ($row_score_types = $result_score_types->fetch_assoc()) {
    $score_type = $row_score_types['score_type'];
    
    if ($score_type === "count") {
        $sql_query = "SELECT result_id, CONCAT(customers.firstname, ' ', customers.lastname) AS customer_name, results.display_data
                      FROM results
                      INNER JOIN customers ON results.customer_id = customers.customer_id
                      WHERE results.score_type = '$score_type'
                      ORDER BY CAST(results.display_data AS DECIMAL) DESC";
    } elseif ($score_type === "time") {
        $sql_query = "SELECT result_id, CONCAT(customers.firstname, ' ', customers.lastname) AS customer_name, results.display_data
                      FROM results
                      INNER JOIN customers ON results.customer_id = customers.customer_id
                      WHERE results.score_type = '$score_type'
                      ORDER BY results.display_data DESC";
    }
    
    $result = $con->query($sql_query);
    $scores = [];

    while ($row = $result->fetch_assoc()) {
        $scores[] = [
            'customer_name' => $row['customer_name'],
            'display_data' => $row['display_data']
        ];
    }

    $data[] = [
        'type' => $score_type,
        'results' => $scores
    ];
}

header('Content-Type: application/json');
echo json_encode($data);
?>
