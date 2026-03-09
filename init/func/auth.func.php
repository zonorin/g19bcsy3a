<?php

function username_exists($username) 
{

    global $db;
    $query = $db -> prepare('SELECT * FROM tbl_users WHERE username = ?');
    $query -> bind_param('s', $username);
    $query -> execute();
    $result = $query -> get_result();

    if ($result -> num_rows) {
        return true;
    }
    return false;
}


function register_user($name, $username, $passwd) 
{
    global $db;

    $passwd_hashed = password_hash($passwd, PASSWORD_DEFAULT);

    $query = $db -> prepare('INSERT INTO tbl_users (name, username, passwd) VALUES (?, ?, ?)');
    $query -> bind_param('sss', $name, $username, $passwd_hashed);
    $query -> execute();
    if($db -> affected_rows) {
        return true;
    }
    return false;
}

// column = key e.g. id, name, username, passwd
// we get user object and false
function logUserIn($username, $passwd) 
{
    global $db;
    $query = $db -> prepare('SELECT * FROM tbl_users WHERE username = ? AND passwd = ?');
    $query -> bind_param('ss', $username, $passwd);
    $query -> execute();
    $result = $query -> get_result();

    if ($result -> num_rows) {
        return $result->fetch_object();
    }
    return false;
}


function loggedInUser() 
{
    global $db;
    if (!isset($_SESSION['user_id'])) {
        return null;
    }
    $user_id = $_SESSION['user_id'];
    $query = $db -> prepare('SELECT * FROM tbl_users WHERE id = ?');  // select id, name, username, level from tbl_users where id = ?
    $query -> bind_param('d', $user_id);
    $query -> execute();
    $result = $query -> get_result();
    if ($result -> num_rows) {
        return $result->fetch_object();
    }
    return null;
}


function isAdmin() {
    $user = loggedInUser();
    if ($user && $user->level === 'Admin') {
        return true;
    }
    return false;
}


function isUserHasPassword($passwd) {
    global $db;
    $user = loggedInUser();
    if (!$user) {
        return false;
    }

    $query = $db -> prepare(
        'SELECT * FROM tbl_users WHERE id = ? AND passwd = ?'
    );
    $query -> bind_param('ss', $user->id, $passwd);
    $query -> execute();
    $result = $query -> get_result();
    if ($result -> num_rows) {
        return true;
    } else {
        return false;
    }
}


function setUserNewPassword($passwd) 
{
    global $db;
    $user = loggedInUser();
    if (!$user) {
        return false;
    }
    $query = $db -> prepare(
        'UPDATE tbl_users SET passwd = ? WHERE id = ?'
    );
    $query -> bind_param('ss', $passwd, $user->id);
    $query -> execute();
    if ($db -> affected_rows) {
        return true;
    }
        return false;
}


function changeProfileImage($image) 
{
    global $db;
    $user = loggedInUser();
    if (!$user) {
        return false;
    }
    $image_path = uploadImage($image);
    if ($image_path && $user->photo) {
        unlink($user->photo);
    }

    $query = $db -> prepare(
        'UPDATE tbl_users SET photo = ? WHERE id = ?'
    );
    $query -> bind_param('ss', $image_path, $user->id);
    $query -> execute();
    if ($db -> affected_rows) {
        return true;
    }
    return false;
}


function deleteProfileImage() 
{
    global $db;
    $user = loggedInUser();
    if (!$user) {
        return false;
    }
    if ($user->photo) {
        unlink($user->photo);
    }

    $query = $db -> prepare('UPDATE tbl_users SET photo = NULL WHERE id = ?');
    $query -> bind_param('d', $user->id);
    $query -> execute();
    if ($db -> affected_rows) {
        return true;
    }
    return false;
}


function uploadImage($image) 
{
    $img_name = $image['name'];
    $img_size = $image['size'];
    $tmp_name = $image['tmp_name'];
    $error    = $image['error'];

    $dir = './assets/images/';

    $allow_exs = ['jpg', 'jpeg', 'png', 'gif'];
    $image_ex  = pathinfo($img_name, PATHINFO_EXTENSION);
    $image_lowercase_ex = strtolower($image_ex);

    $max_size = 5 * 1024 * 1024; // 5MB
    if ($img_size > $max_size) {
        throw new Exception('File size is too large! Maximum size is 5MB.');
    }

    if (!in_array($image_lowercase_ex, $allow_exs)) {
        throw new Exception('File extension is not allowed! Only JPG, JPEG, PNG are accepted.');
    }

    if ($error !== 0) {
        throw new Exception('Unknown error occurred while uploading!');
    }

    $new_img_name = uniqid('PI-') . '.' . $image_lowercase_ex;
    $image_path = $dir . $new_img_name;
    move_uploaded_file($tmp_name, $image_path);
    return $image_path;
}






