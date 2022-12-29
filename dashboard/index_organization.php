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
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Organization(s)</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php
                                            if (isset($_SESSION['org_success'])) {
                                                echo '<div class="alert alert-success mb-0" role="alert">';
                                                echo    $_SESSION['org_success'];
                                                echo '</div>';
                                                unset($_SESSION['org_success']);
                                            }
                                            if (isset($_SESSION['org_delete'])) {
                                                echo '<div class="alert alert-danger mb-0" role="alert">';
                                                echo    $_SESSION['org_delete'];
                                                echo '</div>';
                                                unset($_SESSION['org_delete']);
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
                                                        <th>Phone #</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include_once "./database/connection.php";
                                                    $query = "SELECT * FROM `organizations`";
                                                    $results = $conn->query($query);
                                                    $count = 1;
                                                    while ($row = $results->fetch_assoc()) {
                                                        krsort($row);
                                                    ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $count++ ?>
                                                            </td>
                                                            <td><?php echo $row['name'] ?></td>
                                                            <td class="align-middle">
                                                                <?php echo $row['address'] ?>
                                                            </td>
                                                            <td>
                                                                <?php echo $row['phone_no'] ?>
                                                            </td>
                                                            <td>
                                                                <a href="#" class="btn btn-primary">Edit</a>
                                                                <a href="./database/process.php?dlt_org=<?php echo $row['id']; ?>" onclick="return confirm('Delete this record?')" class="btn btn-danger">Delete</a>
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