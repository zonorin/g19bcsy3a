<?php
// function getUsers()
// {
//     global $db;
//     $query = $db->query("SELECT id, name, level FROM tbl_users WHERE level = 'User'"); // or level <> 'Admin' depending on your user level system
//     if ($query->num_rows) {
//         return $query;
//     }
//     return null;
// }

function getUsers()
{
    global $db;
    $query = $db->prepare("SELECT id, name, level, photo FROM tbl_users WHERE level <> 'Admin'"); // or level <> 'Admin' depending on your user level system
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return $result;
    }
    return null;
}

function getUserById($id)
{
    global $db;
    $query = $db->query("SELECT id, name, level, photo FROM tbl_users WHERE id = '$id' AND level = 'User'"); // or level <> 'Admin' depending on your user level system
    if ($query->num_rows) {
        return $query->fetch_object();
    }
    return null;
}

function updateUser($id, $name, $username, $passwd, $photo = null)
{
    global $db;

    // if (empty($username)) {
    //     $username_query = "";
    // } else {
    //     $username_query = ", username = '$username'";
    // }

    $username_query = empty($username) ? "" : ", username = '$username'"; // shorthand for the above if-else

    // if (empty($passwd)) {
    //     $passwd_query = "";
    // } else {
    //     $passwd_query = ", passwd = '$passwd'";
    // }

    $passwd_query = empty($passwd) ? "" : ", passwd = '$passwd'";         // shorthand for the above if-else

    // Handle photo upload
    $photo_query = "";
    if (!empty($photo['name'])) {
        $image_path = uploadImage($photo);
        if ($image_path) {
            // Delete old photo if exists
            $old_user = getUserById($id);
            if ($old_user && !empty($old_user->photo) && file_exists($old_user->photo)) {
                unlink($old_user->photo);
            }
            $photo_query = ", photo = '$image_path'";
        }
    }

    $db->query("UPDATE tbl_users SET name = '$name'" . $username_query . $passwd_query . $photo_query . " WHERE id = '$id'");

    if ($db->affected_rows) {
        return true;
    }
    return false;
}


function deleteUser($id)
{
    global $db;
    $db->query("DELETE FROM tbl_users WHERE id = '$id' AND level = 'User'"); // or level <> 'Admin' depending on your user level system
    if ($db->affected_rows) {
        return true;
    }
    return false;
}


?>