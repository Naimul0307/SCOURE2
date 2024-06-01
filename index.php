<?php 
  session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Task</title>
    <!-- CSS only -->
    <link rel="stylesheet" href="asset/bootstrap/css/bootstrap.min.css">
    <!-- Add your custom CSS -->
    <style>
        body {
            background-color: #f8f9fa;
            background-image: url('images/background2.jpg');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center
        }

        .card {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
        }

        label {
            color: #495057;
        }

        input[type="text"],
        input[type="email"] {
            border-radius: 5px;
            border: 1px solid #ced4da;
            padding: 10px;
            width: 100%;
            margin-bottom: 20px;
        }

        input[type="submit"] {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            transition: background-color 0.3s;
            width: 100%;
        }

        a {
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            padding: 10px 20px;
            cursor: pointer;
            margin-top: 2px;
            transition: background-color 0.3s;
            width: 100%;
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 100px;
            margin-bottom: 10px;
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

        @media (max-width: 768px) {
            .card {
                margin: 20px;
                padding: 15px;
            }

            .title h2 {
                font-size: 24px;
            }
        }

        @media (max-width: 576px) {
            .card {
                margin: 10px;
                padding: 10px;
            }

            .title h2 {
                font-size: 20px;
            }

            input[type="text"],
            input[type="email"] {
                padding: 8px;
                margin-bottom: 15px;
            }

            input[type="submit"], a {
                padding: 8px 16px;
            }
        }
    </style>
</head>

<body>
    <?php include('message.php') ?>
    
    <div class="container">
        <div class="row justify-content-center mt-5">
            <div class="col-lg-8 col-md-10 col-sm-12">
                <section>
                    <div class="card p-4">
                        <div class="logo">
                            <img src="images/logo.jpg" alt="Logo">
                        </div>
                        <div class="title">
                            <h2>DATA INPUT</h2>
                        </div>
                        <form id="myForm">
                            <div class="form-group">
                                <label for="firstname">First Name</label>
                                <input type="text" name="firstname" id="firstname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="lastname">Last Name</label>
                                <input type="text" name="lastname" id="lastname" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <label for="phone">Phone</label>
                                <input type="text" name="phone" id="phone" class="form-control" required>
                            </div>
                            <div class="form-group">
                                <input type="submit" id="submit" class="btn btn-primary" value="Submit">
                            </div>
                            <div class="form-group">
                                <a href="login.php" type="button" class="btn btn-light">Admin Log In</a>
                            </div>
                        </form>
                    </div>
                </section>
            </div>
        </div>
    </div>

    <script src="asset/jquery.js"></script>
    <script>
        $(document).ready(function() {
            $('#myForm').on('submit', function(e) {
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: 'user.php',
                    data: $(this).serialize(),
                    dataType: 'json',
                    success: function(response) {
                        if (response.success) {
                            window.location.href = 'result_details.php';
                        } else {
                            alert('Error creating user.');
                        }
                    }
                });
            });
        });
    </script>
</body>
</html>
