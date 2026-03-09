<?php
function categorySlugExists($slug) 
{

    global $db;
    $query = $db -> prepare("SELECT id_category FROM tbl_category WHERE slug = '$slug'");
    $query -> execute();
    $result = $query -> get_result();

    if ($result -> num_rows) {
        return true;
    }
    return false;
}

function getCategories()
{
    global $db;
    $query = $db->prepare("SELECT * FROM tbl_category");
    $query->execute();
    $result = $query->get_result();
    if ($result->num_rows) {
        return $result;
    }
    return null;
}

function createCategory($name, $slug) 
    {
        global $db;

        $query = $db -> prepare("INSERT INTO tbl_category (name, slug) VALUES ('$name', '$slug')");
        if($query -> execute()) {
            return true;
        }
        return false;
    }