<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<!-- start head_html.php -->
<?php include('./includes/head_html.php'); ?>
<!-- end head_html.php -->

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <!-- Navbar start -->
            <?php include('./includes/navbar.php'); ?>
            <!-- Navbar end -->

            <!-- Sidebr start -->
            <?php include('./includes/sidebar.php') ?>
            <!-- Sidebr end -->

            <!-- Main Content -->
            <div class="main-content">
                <section class="section">
                    <div class="section-body">
                        <div class="row">
                            <div class="col-12 col-md-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Donar's detail</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php
                                            if (isset($_SESSION['donar_success'])) {
                                                echo '<div class="alert alert-success mb-0" role="alert">';
                                                echo    $_SESSION['donar_success'];
                                                echo '</div>';
                                                unset($_SESSION['donar_success']);
                                            }
                                            if (isset($_SESSION['dlt_delete'])) {
                                                echo '<div class="alert alert-danger mb-0" role="alert">';
                                                echo    $_SESSION['dlt_delete'];
                                                echo '</div>';
                                                unset($_SESSION['dlt_delete']);
                                            }
                                            ?>
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            #
                                                        </th>
                                                        <th>Name</th>
                                                        <th>Address</th>
                                                        <th>Phone No</th>
                                                        <th>Organization Name</th>
                                                        <th>Blood type</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include_once "./database/connection.php";
                                                    $sql_donar = "SELECT * FROM `donars`";
                                                    $result_donar = $conn->query($sql_donar);
                                                    if (mysqli_num_rows($result_donar) > 0) {
                                                        $count = 1;
                                                        while ($row = $result_donar->fetch_assoc()) {
                                                            $org_id = $row['org_id'];
                                                            $sql_org = "SELECT `name` FROM `organizations` WHERE `id` = $org_id";
                                                            $result_org = $conn->query($sql_org);
                                                            $row_org = $result_org->fetch_array();
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $count++ ?>
                                                                </td>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td><?php echo $row['address']; ?></td>
                                                                <td><?php echo $row['phone_no']; ?></td>
                                                                <td><?php echo $row_org['name']; ?></td>
                                                                <td><?php echo $row['abo_type'] . '<sup>' . $row['rh_system'] . '</sup>'; ?></td>
                                                                <td>
                                                                    <a href="#" class="btn btn-primary">Edit</a>
                                                                    <a href="./database/process.php?dlt_donar=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?')" class="btn btn-danger">Delete</a>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr>
                                                            <td colspan="7" class="text-center">
                                                                No data inserted yet
                                                            </td>
                                                        </tr>
                                                    <?php } ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
            <!-- Main Content ends -->

            <!-- footer start -->
            <?php include('./includes/footer.php') ?>
            <!-- footer end -->
        </div>
    </div>
    <!-- Footerscript start -->
    <?php include('./includes/footer_script.php') ?>
    <!-- Footerscript end -->
</body>
<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>