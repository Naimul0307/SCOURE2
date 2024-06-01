<?php
session_start();
require_once "dbcon.php";

// Check if user is logged in and their role is 'admin'
if (!isset($_SESSION['email']) || $_SESSION['role'] !== 'admin') {
    // Redirect to the login page or any other page
    header("Location: login.php");
    exit(); // Stop further execution of the script
}

// Fetch distinct score types
$sql_score_types = "SELECT DISTINCT score_type FROM results";
$result_score_types = $con->query($sql_score_types);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task Meter</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('images/background2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center
        }

    .meter {
        width: 100%;
        height: 300px;
        border-radius: 20px;
        display: flex;
        align-items: center;
        justify-content: center;
        font-weight: bold;
        font-size: 60px;
        text-align: center;
        color: #000000;
        text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.5);
        box-shadow: 0px 0px 20px rgba(0, 123, 255, 0.5);
    }

    .meter-inner {
        height: 100%;
        width: 100%;
        border-radius: 20px;
    }

    .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
            margin-bottom: 10px;
        }
        
    h2 {
        text-align: center;
        background-color: #f0f0f0;
        padding: 10px;
        border-radius: 10px;
    }

    .logo {
        text-align: center;
        margin-bottom: 20px;
    }
    .logo img {
        width: 150px;
        margin-bottom: 10px;
    }
    @media (max-width: 768px) {
            .meter {
                font-size: 40px;
                height: 200px;
            }

            .card {
                padding: 10px;
            }

            h2 {
                font-size: 18px;
                padding: 8px;
            }

            .btn {
                font-size: 14px;
            }
        }

        @media (max-width: 576px) {
            .meter {
                font-size: 30px;
                height: 150px;
            }

            .card {
                padding: 5px;
            }

            h2 {
                font-size: 16px;
                padding: 6px;
            }

            .btn {
                font-size: 12px;
            }
        }

    </style>
</head>
<body>
<?php include('message.php') ?>
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-6 col-md-8 col-sm-10">
                <div class="card p-4" id="adminSection">
                    <section>
                        <div class="logo">
                            <img src="images/logo.jpg" alt="Logo">
                        </div>
                        <h1 class="text-center mb-5">Setting</h1>
                        <form id="myForm" method="post">
                            <div class="row g-3">
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                <label for="userSelect" class="form-label">Customer Name</label>
                                <select class="form-select" id="userSelect" name="customer">
                                    <!-- Options will be populated by AJAX -->
                                </select>
                                </div>
                                <div class="col-lg-6 col-md-6 col-sm-12">
                                    <label for="optionSelect" class="form-label">Grade</label>
                                    <select class="form-select" id="optionSelect" onchange="startMeter()" name="option">
                                        <option value="">Select an option</option>
                                        <option value="time">Time</option>
                                        <option value="count">Counter</option>
                                    </select>
                                </div>
                            </div>

                            <div class="row mt-3">
                                <div class="col-12">
                                    <div class="card">
                                        <div id="timeContainer" class="d-none">
                                            <h2>Time:</h2>
                                            <div id="timeDisplay" class="meter display-text">00:00:00 SEC</div>
                                            <input type="hidden" id="timeDisplayValue" name="timeDisplay" value="">
                                        </div>
                                        <div id="countContainer" class="d-none">
                                            <h2>Count:</h2>
                                            <div id="countDisplay" class="meter display-text">0</div>
                                            <input type="hidden" id="countDisplayValue" name="countDisplay" value="">
                                        </div>
                                        <button id="stopButton" class="btn btn-danger d-none mt-2 mb-2" type="button" onclick="stopMeter()">Stop</button>
                                    </div>
                                </div>
                                <div class="col-12 mt-3">
                                    <button type="submit" class="btn btn-primary w-100">Submit</button>
                                </div>
                            </div>
                        </form>
                        <div class="col-12 mt-4">
                        <button class="btn btn-success w-100 mt-2" onclick="refreshPage()">Refresh</button>
                        </div>
                    </section>
                </div>
            </div>
        </div>
    </div>
    <!-- Bootstrap JS Bundle with Popper -->
    <script src="asset/bootstrap/js/bootstrap.min.js"></script>
    <script src="asset/function.js"></script>
    <script src="asset/jquery.js"></script>
    <script>
    function fetchCustomers() {
        // Fetch customers from the server
        $.ajax({
            url: 'fetch_customers.php',
            type: 'GET',
            dataType: 'json',
            success: function(data) {
                var userSelect = $('#userSelect');
                userSelect.empty(); // Clear the existing list

                data.forEach(function(customer) {
                    userSelect.append(
                        $('<option>', {
                            value: customer.customer_id,
                            text: customer.firstname + ' ' + customer.lastname
                        })
                    );
                });
            },
            error: function(xhr, status, error) {
                console.error('Error fetching customers:', error);
            }
        });
    }

    $(document).ready(function() {
        fetchCustomers();
        setInterval(fetchCustomers,0); // Fetch new customers every 5 seconds
    });

    $(document).ready(function() {
    $('#myForm').on('submit', function(e) {
        e.preventDefault();
        
        console.log("Form submitted");

        var formData = $(this).serialize();
        console.log("Form data:", formData);
        
        $.ajax({
            type: 'POST',
            url: 'code.php',
            data: formData,
            dataType: 'json',
            success: function(response) {
                if (response.success) {
                    window.location.href = 'setting.php';
                } else {
                    alert('Error creating user.');
                }
            },
            error: function(xhr, status, error) {
                alert('An error occurred while processing your request.');
            }
        });
    });
});

function refreshPage() {
    location.reload();
}

</script>
</script>
</body>
</html>
