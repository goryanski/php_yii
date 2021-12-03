<?php session_start();
require_once ('shared.php');
$photos = readPhotos();
?>

<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link rel="stylesheet" href="styles/home.css">
    <title>Home</title>
</head>
<body>
<header class="auth">
    <form action="./auth/registration.php" method="post">
        <button type="submit" class="btn btn-primary">Registration</button>
    </form>
    <form action="./auth/login.php" method="post">
        <button type="submit" class="btn btn-primary" style="display: <?= isset($_SESSION['user']) && $_SESSION['user'] != '' ? 'none' : 'block' ?>">Login</button>
    </form>
    <form action="./auth/logout.php" method="post">
        <button name="log-out" type="submit" class="btn btn-primary" style="display: <?= isset($_SESSION['user']) && $_SESSION['user'] != '' ? 'block' : 'none' ?>">Log out</button>
    </form>
</header>
<form action="create-photo.php" class="create-photo-btn" class="mb-5">
    <input type="submit" class="btn btn-primary" value="Add new photo" <?= isset($_SESSION['user']) && $_SESSION['user'] != '' ? '' : 'disabled' ?>>
</form>


<?php
    // if file is not empty
if($photos != null) {
?>
<div class="container carousel-container">
    <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel">
        <ol class="carousel-indicators">
            <?php
            // display indicators of photos
            $counter = 0;
            foreach ($photos as $photo) {
                // only the first photo will be active
                $isActive = $photo ===  $photos[0] ? 'active' : '';
                echo
                "   
                    <li data-target='#carouselIndicators' data-slide-to='$counter' class='$isActive'></li>
                ";
                ++$counter;
            }
            ?>
        </ol>
        <div class="carousel-inner">
            <?php
            // display photos with captions
            foreach ($photos as $photo) {
                $picture = isset($photo->savePath) ? $photo->savePath : '';
                $isActive = $photo ===  $photos[0] ? 'active' : '';
                $title = $photo->title;
                $description = $photo->description;
                $author = $photo->author;
                $genre = $photo->genre;
                echo
                "   
                    <div class='carousel-item $isActive'>
                        <img class='d-block w-100'  src='$picture' alt='photo slide'>
                        <div class='carousel-caption d-none d-md-block'>
                            <p>$title</p>
                            <p>$description</p>
                            <p>Genre: $genre; Author: $author</p>
                        </div>
                    </div>
                ";
            }
            ?>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev" >
            <span class="carousel-control-prev-icon arrow-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon arrow-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
    <?php
    }
    else {
        echo "<h1 class='no-photos'>There are no photos yet, be the first!</h1>";
    }

?>
</div>

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
</body>
</html>
