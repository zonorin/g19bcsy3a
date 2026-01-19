<?php 
    require_once './init/db.init.php';

    include './includes/header.inc.php';
    include './includes/nav.inc.php';

    $available_pages = ['login', 'register'];

    // echo $_GET['page'];
    // include './pages/' . $_GET['page'] . '.php';
    if (isset($_GET['page'])) {

        $page = $_GET['page'];

        if (in_array($page, $available_pages)) {
            include './pages/' . $page . '.php';
        } else {
            echo '<h1>Error 404</h1>';
        }
        
    } else {
        echo '<h1>Welcome to the Home Page</h1>';
    }


    include "./includes/footer.inc.php";
?>