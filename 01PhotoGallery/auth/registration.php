<?php
require_once ('../shared.php');
$errors = [];

if (isset($_POST['submit'])) {
    $name = isset($_POST['name']) ? htmlentities($_POST['name']) : '';
    $email = isset($_POST['email']) ? htmlentities($_POST['email']) : '';
    $password = isset($_POST['password']) ? htmlentities($_POST['password']) : '';

    // Validation
    $errors = getNewUserValidationErrors($name, $password);
    if (count($errors) === 0) {
        $password = hash('md5', $password);

        // check if such user exists already
        $user = getFoundUser($email, $password);
        if ($user === null) {
            saveUser($name, $email, $password);
        }
        else {
            $errors['userAlreadyExistsError'] = 'Such user already exists';
        }
    }
}

function saveUser($name, $email, $password)
{
    $tmp = readUsers();
    $tmp[] = [
        'name' => $name,
        'email' => $email,
        'password' => $password
    ];

    file_put_contents(USERS_PATH, json_encode($tmp));
    header("location: ../index.php");
    exit;
}
function getNewUserValidationErrors($name, $password)
{
    $errors = [];
    if(!preg_match("/^[a-zA-Z0-9_]{3,16}$/", $name)) {
        $errors['nameError'] = 'name must be 3-16 symbols, English language, only letters, digits, symbols _';
    }
    if(!preg_match("/^[a-zA-Z0-9]{3,16}$/", $password)) {
        $errors['passwordError'] = 'password must be 3-16 symbols, English language, only letters, digits';
    }
    return $errors;
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
    <h1>Registration</h1>
    <form method="post">
        <div class="form-group mb-3">
            <label for="inputName">Name</label>
            <input type="text" name="name" required class="form-control" id="inputName" placeholder="Enter name">
            <div id="help" class="form-text error-style"><?= printError($errors, 'nameError') ?></div>
        </div>
        <div class="form-group mb-3">
            <label for="inputEmail">Email</label>
            <input type="email" name="email" required class="form-control" id="inputEmail" placeholder="Enter Email">
        </div>
        <div class="form-group mb-3">
            <label for="inputPassword">Password</label>
            <input type="text" name="password" required class="form-control" id="inputPassword" placeholder="Enter password">
            <div id="help" class="form-text error-style"><?= printError($errors, 'passwordError') ?></div>
        </div>
        <button name="submit" type="submit" class="btn btn-primary">Save</button>
        <div class="error-style"><?= printError($errors, 'userAlreadyExistsError') ?></div>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>