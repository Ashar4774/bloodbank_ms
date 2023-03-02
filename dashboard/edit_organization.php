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
                                        <?php
                                        include_once('./database/connection.php');
                                        // Edit
                                        if (isset($_GET['edit_org'])) {
                                            $edit_org = $_GET['edit_org'];
                                            $query = "SELECT * FROM `organizations` WHERE `id` = $edit_org";
                                            $result = $conn->query($query);
                                            $row = $result->fetch_assoc();
                                        ?>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="org_name">Name</label>
                                                    <input type="hidden" class="form-control" id="org_id" name="org_id" value="<?php echo $row['id'] ?>">
                                                    <input type="text" class="form-control" id="org_name" name="org_name" value="<?php echo $row['name'] ?>">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="org_address">Address</label>
                                                    <input type="text" class="form-control" id="org_address" name="org_address" value="<?php echo $row['address'] ?>">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="org_phone">Phone #</label>
                                                    <input type="text" class="form-control" id="org_phone" name="org_phone" value="<?php echo $row['phone_no'] ?>">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" name="edit_org_btn">Submit</button>
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