<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<!-- start head_html.php -->
<?php include('./includes/head_html.php');
if (!isset($_SESSION['user']['id'])) {
    $_SESSION['unauth'] = "You have to login first!";
    header('location: login.php');
    exit;
} ?>
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
                            <div class="col-12 col-md-6 col-lg-11 mx-auto">
                                <form method="POST" action="./database/process.php">
                                    <div class="card">
                                        <div class="card-header">
                                            <h4>Add Organization</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="org_name">Name</label>
                                                    <input type="text" class="form-control" id="org_name" name="org_name" placeholder="Name">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="org_address">Address</label>
                                                    <input type="text" class="form-control" id="org_address" name="org_address" placeholder="Address">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="org_phone">Phone #</label>
                                                    <input type="text" class="form-control" id="org_phone" name="org_phone" placeholder="Phone No">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" name="add_org_btn">Submit</button>
                                        </div>
                                    </div>
                                </form>
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