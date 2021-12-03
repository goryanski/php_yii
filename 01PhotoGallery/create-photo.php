<?php
require_once ('shared.php');

const UPLOADS_PATH = 'uploads';
$errors = [];

if (isset($_POST['new-photo'])) {
    $title = isset($_POST['title']) ? htmlentities($_POST['title']) : '';
    $description = isset($_POST['description']) ? htmlentities($_POST['description']) : '';
    $author = isset($_POST['author']) ? htmlentities($_POST['author']) : '';
    $genre = isset($_POST['genre']) ? htmlentities($_POST['genre']) : '';

    // Validation
    $errors = getNewPhotoValidationErrors($title, $description, $author);

    if (count($errors) === 0 && isset($_FILES['picture']) && $_FILES['picture']['error'] === UPLOAD_ERR_OK) {
        $savePath = UPLOADS_PATH . '\\' . $_FILES['picture']['name'];
        move_uploaded_file($_FILES['picture']['tmp_name'], $savePath);
        savePhoto($title, $description, $author, $genre, $savePath);
    }
}

function savePhoto($title, $description, $author, $genre, $savePath)
{
    $tmp = readPhotos();
    $tmp[] = [
        'title' => $title,
        'description' => $description,
        'author' => $author,
        'genre' => $genre,
        'savePath' => $savePath,
    ];
    file_put_contents(PHOTOS_PATH, json_encode($tmp));
    header("location: index.php");
    exit;
}
function getNewPhotoValidationErrors($title, $description, $author)
{
    $errors = [];
    if(!preg_match("/^[a-zA-Z0-9.,! ]{3,36}$/", $title)) {
        $errors['titleError'] = 'title must be 3-36 symbols, English language, only letters. digits, symbols ,.!';
    }
    if(!preg_match("/^[a-zA-Z0-9.,! ]{3,66}$/", $description)) {
        $errors['descriptionError'] = 'description must be 3-66 symbols, English language, only letters. digits, symbols ,.!';
    }
    if(!preg_match("/^[a-zA-Z0-9_ ]{3,66}$/", $author)) {
        $errors['authorError'] = 'author must be 3-66 symbols, English language, only letters. digits, symbol _';
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
    <link rel="stylesheet" href="styles/create-photo.css">
    <title>Create photo</title>
</head>
<body>
<div class="container">
    <form method="post" enctype="multipart/form-data">
        <div class="form-group">
            <label for="inputTitle">Title</label>
            <input type="text" name="title" value="Fall" required class="form-control" id="inputTitle" placeholder="Enter title">
            <div id="help" class="form-text error-style"><?= printError($errors, 'titleError') ?></div>
        </div>
        <div class="form-group">
            <label for="inputDescription">Description</label>
            <input type="text" name="description" value="Beautiful fall trees" required class="form-control" id="inputDescription" placeholder="Enter description">
            <div id="help" class="form-text error-style"><?= printError($errors, 'descriptionError') ?></div>
        </div>
        <div class="form-group">
            <label for="inputAuthor">Author</label>
            <input type="text" name="author" value="Igor" required class="form-control" id="inputAuthor" placeholder="Enter author name">
            <div id="help" class="form-text error-style"><?= printError($errors, 'authorError') ?></div>
        </div>
        <div class="form-group">
            <label for="selectGenre">Genre</label>
            <select class="form-select" name="genre" multiple size="10" aria-label="Default select" id="selectGenre">
                <option value="Landscape">Landscape</option>
                <option value="Wildlife">Wildlife</option>
                <option value="Nature" selected>Nature</option>
                <option value="Macro">Macro</option>
                <option value="Underwater">Underwater</option>
                <option value="Astrophotography">Astrophotography</option>
                <option value="Aerial Photography">Aerial Photography</option>
                <option value="Scientific">Scientific</option>
                <option value="Portraits">Portraits</option>
                <option value="Weddings">Weddings</option>
                <option value="Documentary">Documentary</option>
                <option value="Sports">Sports</option>
                <option value="Fashion">Fashion</option>
                <option value="Commercial">Commercial</option>
                <option value="Street Photography">Street Photography</option>
                <option value="Event Photography">Event Photography</option>
                <option value="Travel">Travel</option>
                <option value="Pet Photography">Pet Photography</option>
            </select>
        </div>
        <div class="form-group">
            <label for="fileInput" class="form-label">Picture</label>
            <input type="file" name="picture" required class="form-control" id="fileInput">
            <div id="help" class="form-text error-style"><?= printError($errors, 'pictureError') ?></div>
        </div>

        <button name="new-photo" type="submit" class="btn btn-primary">Save</button>
    </form>
</div>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>
</body>
</html>