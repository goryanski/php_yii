<?php

const PHOTOS_PATH = 'photos.txt';
const USERS_PATH = 'people.txt';

function readPhotos() {
    return file_exists(PHOTOS_PATH) ? json_decode(file_get_contents(PHOTOS_PATH)) : [];
}
function printError($errors, $errorName) {
    return isset($errors[$errorName]) ? $errors[$errorName] : '';
}

function readUsers() {
    return file_exists(USERS_PATH) ? json_decode(file_get_contents(USERS_PATH)) : [];
}
function getFoundUser($email, $password)
{
    $users = readUsers();
    if($users === null) {
        // file with users is empty
        return null;
    }
    else {
        $foundUser = array_filter($users, function ($user) use($email, $password) {
            return $user->email === $email && $user->password === $password;
        });
        if(count($foundUser) === 0) {
            // user is not found
            return null;
        }
        else {
            // we can't just return $foundUser[0], so
            $std = new stdClass();
            foreach($foundUser as $user) {
                $std->name = $user->name;
                $std->email = $user->email;
                $std->password = $user->password;
            }
            return $std;
        }
    }
}