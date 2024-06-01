<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Display Results</title>
    <link href="asset/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('images/background2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
            margin-bottom: 10px;
        }

        .container {
            width: 60%;
            margin: auto;
        }

        .card {
            margin-top: 40px; /* Adjust as needed */
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        .title h2 {
            position: relative;
        }

        .title h2::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%;
            height: 2px;
            background-color: #007bff;
        }

        .table-medium {
            font-size: medium;
        }

        .table-title {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            text-transform: uppercase;
        }

        .table-body {
            font-size: 20px;
            font-weight: bold;
            text-align: center;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        @media (max-width: 768px) {
            .table-medium {
                font-size: small;
            }

            .table-title {
                font-size: 18px;
            }

            .table-body {
                font-size: 18px;
            }
        }

        @media (max-width: 576px) {
            .table-medium {
                font-size: small;
            }

            .table-title {
                font-size: 16px;
            }

            .table-body {
                font-size: 16px;
            }
        }
    </style>
</head>
<body>
<?php include('message.php'); ?>
<div class="container">
    <div class="row justify-content-center mt-5">
        <div class="col-lg-8 col-md-10 col-sm-12">
            <div class="card p-4">
                <section>
                    <div class="logo">
                        <img src="images/logo.jpg" alt="Logo">
                    </div>
                    <div class="title">
                        <h2>SCOREBOARD</h2>
                    </div>
                    <div id="scoreboard"></div>
                </section>
            </div>
        </div>
    </div>
</div>
<script>
    function fetchScores() {
        $.ajax({
            url: 'fetch_scores.php',
            method: 'GET',
            dataType: 'json',
            success: function(data) {
                var scoreboard = $('#scoreboard');
                scoreboard.empty();
                data.forEach(function(scoreType) {
                    var table = '<div class="card"><div class="card-body">';
                    table += '<h2 class="table-title">' + scoreType.type.toUpperCase() + '</h2>';
                    table += '<table class="table table-bordered table-striped table-medium">';
                    table += '<thead class="table-dark"><tr><th>Customer Name</th><th>Display Data</th></tr></thead><tbody>';
                    scoreType.results.forEach(function(result) {
                        table += '<tr><td>' + result.customer_name + '</td><td>' + result.display_data.toUpperCase() + '</td></tr>';
                    });
                    table += '</tbody></table></div></div>';
                    scoreboard.append(table);
                });
            }
        });
    }

    $(document).ready(function() {
        fetchScores();
        setInterval(fetchScores,0);
    });
</script>
<script src="asset/bootstrap/js/bootstrap.min.js"></script>
</body>
</html>
