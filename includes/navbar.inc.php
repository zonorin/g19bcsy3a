<?php
$user = loggedInUser();
?>

<nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container">
        <a class="navbar-brand" href="<?php echo $baseUrl; ?>?page=dashboard">Navbar</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent"
            aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <?php
                if (isAdmin()) {
                    ?>
                    <li class="nav-item dropdown">
                        <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                            aria-expanded="false">
                            Manage
                        </a>
                        <ul class="dropdown-menu">
                            <li>
                                <a class="dropdown-item" href="<?php echo $baseUrl; ?>?page=user/list">User Account</a>
                                <a class="dropdown-item" href="<?php echo $baseUrl; ?>?page=category/list">Category Page</a>
                            </li>

                            <!-- <li>
                                <hr class="dropdown-divider" />
                            </li> -->

                            <!-- <li><a class="dropdown-item" href="<?php echo $baseUrl; ?>?page=profile">Profile</a></li>
                            <li><a class="dropdown-item" href="<?php echo $baseUrl; ?>?page=logout">Logout</a></li> -->
                        </ul>

                    </li>

                <?php
                }
                ?>



                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" role="button" data-bs-toggle="dropdown"
                        aria-expanded="false">
                        <?php echo (!$user ? 'Account' : $user->name) ?>
                    </a>
                    <ul class="dropdown-menu">
                        <?php if (empty($user)) { ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo $baseUrl; ?>?page=login">Login</a>
                            </li>
                            <li>
                                <hr class="dropdown-divider" />
                            </li>
                            <li>
                                <a class="dropdown-item" href="<?php echo $baseUrl; ?>?page=register">Register</a>
                            </li>
                        <?php } else { ?>
                            <li>
                                <a class="dropdown-item" href="<?php echo $baseUrl; ?>?page=profile">Profile</a>
                            </li>

                            <li>
                                <hr class="dropdown-divider" />
                            </li>

                            <li><a class="dropdown-item" href="<?php echo $baseUrl; ?>?page=logout">Logout</a></li>

                        <?php } ?>
                    </ul>

                </li>
            </ul>
            <!-- <form class="d-flex" role="search">
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" />
                <button class="btn btn-outline-success" type="submit">Search</button>
            </form> -->
        </div>
    </div>
</nav>