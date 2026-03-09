<?php

if (!isset($_GET['id']) || getUserById($_GET['id']) === null) {
    header('Location: ./?page=user/list');
    exit;
}

$manage_user  = getUserById($_GET['id']);
$nameErr      = $usernameErr = '';
$name         = $username = '';

if (isset($_POST['name'], $_POST['username'], $_POST['passwd']) && isset($_FILES['photo'])) {
    $id       = $_GET['id'];
    $name     = trim($_POST['name']);
    $username = trim($_POST['username']);
    $passwd   = trim($_POST['passwd']);
    $photo    = $_FILES['photo'];

    if (empty($name))
        $nameErr = 'Please input name!';

    if (!empty($username) && username_exists($username)) {
        $usernameErr = 'Username already exists!';
    }

    if (empty($nameErr) && empty($usernameErr)) {
        if (updateUser($id, $name, $username, $passwd, $photo)) {
            echo '<div class="alert alert-success" role="alert">
                  Update successful! <a href="./?page=user/list" class="alert-link">View Users</a>
                  </div>';

        } else {
            echo '<div class="alert alert-danger" role="alert">
                       Update failed. Please try again.
                  </div>';
        }

    }
}
?>

<form method="post" action="./?page=user/update&id=<?php echo $manage_user->id ?>" enctype="multipart/form-data" class="col-md-8 col-lg-6 mx-auto">
    <h3>Update User ID : <?php echo $manage_user->id ?></h3>
    <div class="d-flex justify-content-center">
        <input name="photo" type="file" id="profileUpload" hidden>
        <label role="button" for="profileUpload">
            <img src="<?php echo loggedInUser()->photo ?? './assets/images/emptyuser.png' ?>"
                class="rounded-circle mt-3" alt="Profile Photo" style="max-width: 200px;">
        </label>
    </div>
    <div class="mb-3">
        <label class="form-label">Name</label>
        <input name="name" value="<?php echo isset($_POST['name']) ? $_POST['name'] : $manage_user->name ?>" type="text" class="form-control 
                <?php echo empty($nameErr) ? '' : "is-invalid" ?>">
        <div class="invalid-feedback"><?php echo $nameErr ?></div>
    </div>

    <div class="mb-3">
        <label class="form-label">Username</label>
        <input name="username" placeholder="(optional) input username to update" value="<?php echo isset($_POST['name']) ? $_POST['name'] : '' ?>" type="text" class="form-control
                <?php echo empty($usernameErr) ? '' : 'is-invalid' ?>">
        <div class="invalid-feedback"><?php echo $usernameErr ?></div>
    </div>

    <div class="mb-3">
        <label class="form-label">Password</label>
        <input name="passwd" placeholder="(optional) input new password to update" type="password" class="form-control">
    </div>

    <div class="d-flex justify-content-end gap-2">
        <a href="./?page=user/list" role="submit" class="btn btn-danger">Cancel</a>
        <button type="submit" class="btn btn-success">Update</button>
    </div>

</form>