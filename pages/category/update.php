<?php
// empty string
$nameErr = $slugErr = $passwdErr = '';
$name = $slug = '';

if (isset($_GET['success'])) {
    echo '<div class="alert alert-success" role="alert">
               Create successful!
          </div>';
}

if (isset($_POST['name'], $_POST['slug'])) {
    $name       = trim($_POST['name']);
    $slug       = trim($_POST['slug']);

    if (empty($name)){
        $nameErr = 'Name is required!';
    }
    
    if (empty($slug)){
        $slugErr = 'Slug is required!';
    }
    
    if (categorySlugExists($slug)) {
        $slugErr = 'Slug already exists!';
    }

    if (empty($nameErr) && empty($slugErr)) {
        try {
            if (createCategory($name, $slug)) {
                echo '<div class="alert alert-success" role="alert">
                  Category Create successful! <a href="./?page=category/list" class="alert-link">View Category</a>
                  </div>';
                $name = $slug = '';
                unset($_POST['name'], $_POST['slug']);

            } else {
                echo '<div class="alert alert-danger" role="alert">
                       Category Create failed. Please try again.
                  </div>';
            }
        } catch (Exception $e) {
            echo '<div class="alert alert-danger" role="alert">
                    Category Create Failded!
                  </div>';
        }
    }
}
?>


<form method="post" action="./?page=category/update" enctype="multipart/form-data" class="col-md-8 col-lg-6 mx-auto">
    <h3>Update Category</h3>
    <div class="mb-3">
        <label for="name" class="form-label">Name</label>
        <input name="name" value="<?php echo $name ?>" type="text" class="form-control 
                <?php echo empty($nameErr) ? '' : "is-invalid" ?>">
        <div class="invalid-feedback"><?php echo $nameErr ?></div>
    </div>

    <div class="mb-3">
        <label for="slug" class="form-label">Slug</label>
        <input name="slug" value="<?php echo $slug ?>" type="text" class="form-control
                <?php echo empty($slugErr) ? '' : 'is-invalid' ?>">
        <div class="invalid-feedback"><?php echo $slugErr ?></div>
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="./?page=category/list" role="submit" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-success">UPDATE</button>
    </div>

</form>