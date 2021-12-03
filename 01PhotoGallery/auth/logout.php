<?php session_start();
if(isset($_POST['log-out'])) {
    $_SESSION['user'] = '';
    session_destroy();
    header('location: ../index.php');
}