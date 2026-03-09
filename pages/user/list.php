<div class="container mt-5">
    <div class="d-flex justify-content-between">
        <h3>User List</h3>
        <div>
            <a href="./?page=user/create" class="btn btn-sm btn-success">CREATE USER</a>
        </div>
    </div>
    <div class="card">
        <div class="card-body">
            <table class="table table-hover">
                <tr>
                    <th>ID</th>
                    <th>Photo</th>
                    <th>Name</th>
                    <!-- <th>Level</th> -->
                    <th>Action</th>
                </tr>

                <?php
                // $manage_users = getUsers();
                // if ($manage_users !== null) {
                //     while ($row = $manage_users->fetch_object()) {
                //         echo '<tr>
                //                       <td>' . $row->id . '</td>
                //                       <td>' . $row->name . '</td>
                //                       <td>' . $row->level . '</td>
                //                       </tr>';
                //     }
                // }
                ?>

                <?php
                $manage_users = getUsers();
                if ($manage_users !== null) {
                    while ($row = $manage_users->fetch_object()) {
                        ?>

                        <tr>
                            <td><?php echo $row->id ?></td>
                            <td>
                                <img src="<?php echo !empty($row->photo) ? $row->photo : './assets/images/emptyuser.png' ?>" alt="User Photo" 
                                class="rounded-circle" style="max-width: 50px;">
                            </td>
                            <td><?php echo $row->name ?></td>
                            <!-- <td><?php echo $row->level ?></td> -->
                            <td>
                                <a class="btn btn-primary" href="./?page=user/update&id=<?php echo $row->id ?>">Update</a>
                                <a class="btn btn-danger"  href="./?page=user/delete&id=<?php echo $row->id ?>">Delete</a>
                            </td>
                        </tr>
                <?php
                    }
                }
                ?>
            </table>
        </div>
    </div>
</div>