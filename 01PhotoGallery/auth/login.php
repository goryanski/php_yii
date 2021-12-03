<?php session_start();
    require_once ('../shared.php');
    $errors = [];

if (isset($_POST['submit'])) {
        $email = isset($_POST['email']) ? htmlentities($_POST['email']) : '';
        $password = isset($_POST['password']) ? htmlentities($_POST['password']) : '';
        $password = hash('md5', $password);

        $user = getFoundUser($email, $password);
        if ($user != null) {
            if(!isset($_SESSION['user'])) {
                $_SESSION['user'] = $email;
            }
            if(isset($_SESSION['user'])) {
                header('location: ../index.php');
                exit;
            }
        }
        else {
            echo "<h4 class='error-style'>user not found<h4>";
        }
    }
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <link rel="stylesheet" href=styles/auth.css>
    <title>Create photo</title>
</head>
<body>
<div class="container">
    <h1>login</h1>
    <form method="post">
        <div class="form-group mb-3">
            <label for="inputEmail">Email</label>
            <input type="email" name="email" required class="form-control" id="inputEmail" placeholder="Enter Email">
        </div>
        <div class="form-group mb-3">
            <label for="inputPassword">Password</label>
            <input type="text" name="password" required class="form-control" id="inputPassword" placeholder="Enter password">
        </div>

        <button name="submit" type="submit" class="btn btn-primary">Login</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>