<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<!-- start head_html.php -->
<?php include('./includes/head_html.php');
if (!isset($_SESSION['user_id'])) {
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
                                        <?php
                                        include_once('./database/connection.php');
                                        // Edit
                                        if (isset($_GET['edit_donar'])) {
                                            $edit_donar = $_GET['edit_donar'];
                                            $query = "SELECT * FROM `donars` WHERE `id` = $edit_donar";
                                            $result = $conn->query($query);
                                            $row = $result->fetch_assoc();
                                        ?>
                                            <div class="card-header">
                                                <h4>Edit donar's detail</h4>
                                            </div>
                                            <div class="card-body">
                                                <div class="form-row">
                                                    <div class="form-group col-md-4">
                                                        <input type="hidden" class="form-control" id="donar_id" name="donar_id" value="<?php echo $row['id'] ?>">
                                                        <label for="donar_cnic">CNIC</label>
                                                        <input type="text" class="form-control" id="donar_cnic" name="donar_cnic" value="<?php echo $row['cnic'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="donar_name">Name</label>
                                                        <input type="text" class="form-control" id="donar_name" name="donar_name" value="<?php echo $row['name'] ?>">
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="donar_phone_no">Phone #</label>
                                                        <input type="text" class="form-control" id="donar_phone_no" name="donar_phone_no" value="<?php echo $row['phone_no'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6 col-lg-12">
                                                        <label for="donar_address">Address</label>
                                                        <input type="text" class="form-control" id="donar_address" name="donar_address" value="<?php echo $row['address'] ?>">
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-6">
                                                        <label for="abo_type">ABO Type</label>
                                                        <select id="abo_type" class="form-control" name="abo_type" required>
                                                            <option>Select organization</option>
                                                            <option value="A" <?php echo ($row['abo_type'] == 'A') ? 'selected' : '' ?>>A</option>
                                                            <option value="B" <?php echo ($row['abo_type'] == 'B') ? 'selected' : '' ?>>B</option>
                                                            <option value="AB" <?php echo ($row['abo_type'] == 'AB') ? 'selected' : '' ?>>AB</option>
                                                            <option value="O" <?php echo ($row['abo_type'] == 'O') ? 'selected' : '' ?>>O</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-6">
                                                        <label for="rh_system">RH system</label>
                                                        <select id="rh_system" class="form-control" name="rh_system" required>
                                                            <option>Select organization</option>
                                                            <option value="+" <?php echo ($row['rh_system'] == '+') ? 'selected' : ''  ?>>+</option>
                                                            <option value="-" <?php echo ($row['rh_system'] == '-') ? 'selected' : ''  ?>>-</option>
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="form-row">
                                                    <div class="form-group col-md-12">
                                                        <label for="org_id">Organization</label>
                                                        <select id="org_id" class="form-control" name="org_id">
                                                            <option disabled>Select organization</option>
                                                            <?php
                                                            $query = "SELECT * FROM `organizations`";
                                                            $results_org = $conn->query($query);
                                                            $count = 1;
                                                            while ($row_org = $results_org->fetch_assoc()) {
                                                            ?>
                                                                <option value="<?php echo $row_org['id'] ?>" <?php echo ($row_org['id'] == $row['org_id']) ? 'selected' : '' ?>>
                                                                    <?php echo $row_org['name'] ?>
                                                                </option>
                                                            <?php } ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="card-footer">
                                                <button type="submit" class="btn btn-primary" name="edit_donar_submit">Submit</button>
                                            </div>
                                        <?php } ?>
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