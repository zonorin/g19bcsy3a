<?php
    if(isset($_POST['username'])) {
        echo $_POST['username'];
    }
?>
    
    <form method="post" action="./?page=register">
        <div class="col-md-8 col-lg-6 mx-auto">
            <h3>Register Page</h3>
            <div class="mb-3">
                <label for="exampleInputEmail1" class="form-label">Username</label>
                <input name="username" class="form-control" id="exampleInputEmail1" aria-describedby="emailHelp">
                <div class="form-text">We'll never share your email with anyone else.</div>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Password</label>
                <input name="passwd" class="form-control" id="exampleInputPassword1">
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1" class="form-label">Confirm Password</label>
                <input name="confirm_passwd" class="form-control" id="exampleInputPassword1">
            </div>
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>