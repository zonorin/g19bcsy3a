<?php
    $oldPasswd    = $newPasswd    = $confirmNewPasswd = '';
    $oldPasswdErr = $newPasswdErr = '';

    if (isset($_POST['changePasswd'], $_POST['oldPasswd'], $_POST['newPasswd'], $_POST['confirmNewPasswd'])) {
        $oldPasswd        = trim($_POST['oldPasswd']);
        $newPasswd        = trim($_POST['newPasswd']);
        $confirmNewPasswd = trim($_POST['confirmNewPasswd']);

        if (empty($oldPasswd)) {
            $oldPasswdErr = 'Please input your old password';
        }

        if (empty($newPasswd)) {
            $newPasswdErr = 'Please input your new password';
        }

        if ($newPasswd !== $confirmNewPasswd) {
            $newPasswdErr = 'Password does not match';
        } else {
            if (empty($oldPasswdErr) && !isUserHasPassword($oldPasswd)) {
                $oldPasswdErr = 'Old password is incorrect';
            }
        }

        if (empty($oldPasswdErr) && empty($newPasswdErr)) {
            if (setUserNewPassword($newPasswd)) {
                header('Location: ./?page=logout');
            } else {
                echo '<div class="alert alert-danger" role="alert">
                Something went wrong, please try again!
                </div>';
            }
        }
    }    
?>



<div class="row">
    <div class="col-6">
        <form method="post" action="./?page=profile">
            <div class="d-flex justify-content-center">
                <input name="photo" type="file" id="profileUpload" hidden>
                <label role="button" for="profileUpload">
                    <img src="./assets/images/emptyuser.png" width="200" class="rounded-circle mt-3" alt="Profile Photo">
                </label>
            </div>
            <div class="d-flex justify-content-center gap-2 mt-3">
                <button type="submit" name="deletePhoto" class="btn btn-danger">Delete  </button>
                <button type="submit" name="uploadPhoto" class="btn btn-success">Upload </button>
            </div>
        </form>
    </div>

    <div class="col-6">
        <form method="post" action="./?page=profile" class="col-md-8 col-lg-6 mx-auto">
            <h3>Change Password</h3>
            <div class="mb-3">
                <label class="form-label">Old Password</label>
                <input value="<?php echo $oldPasswd ?>" name="oldPasswd" type="password" class="form-control
                <?php echo empty($oldPasswdErr) ? '' : 'is-invalid' ?>">
                <div class="invalid-feedback">
                    <?php echo $oldPasswdErr ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">New Password</label>
                <input value="<?php echo $newPasswd ?>" name="newPasswd" type="password" class="form-control
                <?php echo empty($newPasswdErr) ? '' : 'is-invalid' ?>">
                <div class="invalid-feedback">
                    <?php echo $newPasswdErr ?>
                </div>
            </div>

            <div class="mb-3">
                <label class="form-label">Confirm New Password</label>
                <input name="confirmNewPasswd" type="password" class="form-control"> 
            </div>

            <button type="submit" name="changePasswd" class="btn btn-primary">Change Password</button>
        </form>
    </div>
</div>