<?php

    // or
    // $host = '127.0.0.1'
    $db_host = 'localhost';
    $db_name = 'webtesting';
    $db_user = 'root';
    $db_pass = '';
    $db_port = 3306;

    // new mysqli() can use until we turn on extention
    // extension=pdo_mysql
    $db = new mysqli($db_host, $db_user, $db_pass, $db_name, $db_port);

    if($db->connect_error) {
        echo $db->connect_error;
        die();
    }

?>