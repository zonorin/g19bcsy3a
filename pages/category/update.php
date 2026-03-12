<?php

if (!isset($_GET['id']) || getCategoryById($_GET['id']) === null) {
    header('Location: ./?page=category/list');
    exit;
}

$manage_category  = getCategoryById($_GET['id']);

$nameErr = $slugErr = '';
if (isset($_POST['name'], $_POST['slug'])) {
    $id_category = $_GET['id'];
    $name        = trim($_POST['name']);
    $slug        = trim($_POST['slug']);

    if (empty($name)){
        $nameErr = 'Name is required!';
    }
    
    if (empty($slug)){
        $slugErr = 'Slug is required!';
    } else {
        if ($slug !== $manage_category->slug && categorySlugExists($slug)) {
            $slugErr = 'Slug already exists!';
        }
    }

    if (empty($nameErr) && empty($slugErr)) {
        try {
            if (updateCategory($id_category, $name, $slug)) {
                echo '<div class="alert alert-success" role="alert">
                  Category Update successful! <a href="./?page=category/list" class="alert-link">View Category</a>
                  </div>';
                $nameErr = $slugErr = '';
                unset($_POST['name'], $_POST['slug']);

            } else {
                echo '<div class="alert alert-danger" role="alert">
                       Category Update failed. Please try again.
                  </div>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">
                    Category Update Failded!
                  </div>';
        }
    }
}

$manage_category  = getCategoryById($_GET['id']);

?>


<form method="post" action="./?page=category/update&id=<?php echo $manage_category->id_category ?>" enctype="multipart/form-data" class="col-md-8 col-lg-6 mx-auto">
    <h3>Update Category</h3>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $manage_category->name ?>" type="text" class="form-control 
                <?php echo empty($nameErr) ? '' : "is-invalid" ?>">
        <div class="invalid-feedback"><?php echo $nameErr ?></div>
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input name="slug" value="<?php echo isset($_POST['slug']) ? $_POST['slug'] : $manage_category->slug ?>" type="text" class="form-control
                <?php echo empty($slugErr) ? '' : 'is-invalid' ?>">
        <div class="invalid-feedback"><?php echo $slugErr ?></div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="./?page=category/list" role="submit" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-success">UPDATE</button>
    </div>

</form>