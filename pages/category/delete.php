<?php

if (!isset($_GET['id']) || getCategoryById($_GET['id']) === null) {
    header('Location: ./?page=category/list');
    exit;
}

if (deleteCategory($_GET['id'])) {
    echo '<div class="alert alert-success" role="alert">
          Category deleted successfully! <a href="./?page=category/list" class="alert-link">View Category</a>
          </div>';
} else {
    echo '<div class="alert alert-danger" role="alert">
          Failed to delete category. Please try again. <a href="./?page=category/list" class="alert-link">View Category</a>
          </div>';
}

?>