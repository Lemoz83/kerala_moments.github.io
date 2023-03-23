<?php
include('security.php');
include('includes/header.php');
include('includes/navbar.php');
?>



<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add Admin Data</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form action="code.php" method="post">
                <div class="modal-body">
                    <div class="form-group">
                        <label>Username</label>
                        <input type="text" name="username" class="form-control" placeholder="Enter Username">
                    </div>
                    <div class="form-group">
                        <label>Email</label>
                        <input type="email" name="email" class="form-control" placeholder="Enter Email">
                    </div>
                    <div class="form-group">
                        <label>Password</label>
                        <input type="password" name="password" class="form-control" placeholder="Enter Password">
                    </div>
                    <div class="form-group">
                        <label>Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control"
                            placeholder="Renter Password">
                    </div>

                    <input type="hidden" name="usertype" value="admin">
                </div>
                <div class="modal-footer">
                    <button type="button" name='close' class="btn btn-secondary" data-dismiss="modal">Close</button>
                    <button type="submit" name='registeradmin' class="btn btn-primary">Save</button>
                </div>
            </form>

        </div>
    </div>
</div>

<div class="container-fluid">
    <!-- DataTables Example -->
    <div class="card shadow mb-4">
        <div class="card-header py-3">
            <ul style=" list-style: none;">
                <li>
                    <h6 class="m-0 font-wieght-bold text-primary"
                        style="text-align: center; font-size: 20px; text-decoration: underline; font-weight: bolder;">
                        Admin
                        Profile</h6>
                </li>
                <li>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#exampleModal">
                        Add Admin Profile
                    </button>
                </li>
            </ul>
        </div>

        <div class="card-body">
            <?php

            if (isset($_SESSION['success'])) {
                echo '<h4 style="color:#00ec97;"> ' . $_SESSION['success'] . ' </h4>';
                unset($_SESSION['success']);
            }

            if (isset($_SESSION['status'])) {
                echo '<h4 style="color:#e74a3b;"> ' . $_SESSION['status'] . ' </h4>';
                unset($_SESSION['status']);
            }

            ?>
            <div class="table-responsive">

                <?php
                $con = mysqli_connect('localhost', 'root', '', 'kerala_moments');
                $query = 'SELECT * FROM admin_registration';
                $insert_query = mysqli_query($con, $query);
                ?>
                <table class="table table-bordered" id="dataTable" width="100%" cellspacing="0">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>USERNAME</th>
                            <th>EMAIL</th>
                            <th>PASSWORD</th>
                            <th>USERTYPE</th>
                            <th>EDIT</th>
                            <th>DELETE</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        if (mysqli_num_rows($insert_query) > 0) {
                            while ($row = mysqli_fetch_assoc($insert_query)) {
                                ?>
                                <tr>
                                    <td>
                                        <?php echo $row['id']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['username']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['email']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['password']; ?>
                                    </td>
                                    <td>
                                        <?php echo $row['usertype']; ?>
                                    </td>
                                    <td>
                                        <form action="register_edit.php" method="post">
                                            <input type="hidden" name="edit_id" value="<?php echo $row['id']; ?>">
                                            <button type="submit" name="edit_btn" class="btn btn-success">EDIT</button>
                                    </td>
                                    </form>
                                    <td>
                                        <form action="code.php" method="post">
                                            <input type="hidden" name="delete_id" value="<?php echo $row['id'] ?>">
                                            <button type="submit" name="delete_btn" class="btn btn-danger">DELETE</button>
                                        </form>
                                    </td>
                                </tr>
                                <?php
                            }
                        } else {
                            echo "Record not found";
                        }

                        ?>
                    </tbody>
                </table>
            </div>
        </div>

    </div>
</div>
</div>





<!-- container-fluid -->
<?php
include('includes/script.php');
include('includes/footer.php');
?>