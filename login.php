<?php
session_start();
require_once "dbcon.php";

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Validate user credentials
    $sql = "SELECT * FROM customers WHERE email = '$email' AND role = 'admin'";
    $result = $con->query($sql);

    if ($result->num_rows > 0) {
        // User with admin role found
        $_SESSION['email'] = $email;
        $_SESSION['role'] = 'admin';
        header("Location: setting.php");
        exit();
    } else {
        $error = "User not found or not an admin";
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
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
            width: 100%; /* Set width to 100% */
        }

        input[type="submit"]:hover {
            background-color: #0056b3;
        }

        .logo {
            text-align: center;
            margin-bottom: 20px;
        }

        .logo img {
            width: 150px;
            margin-bottom: 10px;
        }

        .title {
            text-align: center;
            margin-bottom: 30px;
        }

        /* Add underline to the title */
        .title h2 {
            position: relative;
        }

        .title h2::after {
            content: "";
            position: absolute;
            bottom: -5px;
            left: 0;
            width: 100%; /* Change width to 100% */
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

            input[type="submit"] {
                padding: 8px 16px;
            }
        }

    </style>
</head>

<body>
    <?php include('message.php') ?>
    
    <div class="container">
        <div class=" row justify-content-center mt-5">
            <div class="col-lg-6 col-md-8 col-sm-10">
            <section>
        <div class="card p-4">
            <div class="logo">
                <img src="images/logo.jpg" alt="Logo">
            </div>
            <div class="title">
                <h2>Login</h2>
                <?php if(isset($error)) echo "<p>$error</p>"; ?>
            </div>
    
    <form method="post" action="">
        <label>Email:</label><br>
        <input type="text" name="email" required><br><br>
        <input type="submit" value="Login">
    </form>
        </div>
    </section>
            </div>
        </div>
    </div>
</body>
</html>