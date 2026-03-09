<?php

$baseUrl = '/webtesting/';

session_start();
// session_set_cookie_params(60 * 30); // 30 minutes

require_once './init/db.init.php';
require_once './init/func/user.func.php';
require_once './init/func/auth.func.php';

// manage user
require_once './init/func/manage/user.manage.php';
require_once './init/func/manage/category.manage.php';