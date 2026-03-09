<?php

if (!isset($_GET['id']) || getUserById($_GET['id']) === null) {
    header('Location: ./?page=user/list');
    exit;
}

if (deleteUser($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">
          User deleted successfully! <a href="./?page=user/list" class="alert-link">View Users</a>
          </div>';
} else {
    echo '<div class="alert alert-danger" role="alert">
          Failed to delete user. Please try again.
          </div>';
}

?>