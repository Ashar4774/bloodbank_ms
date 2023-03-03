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
                                            <h4>Add blood detail</h4>
                                        </div>
                                        <div class="card-body">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="abo_type">ABO Type</label>
                                                    <select id="abo_type" class="form-control" name="abo_type" required>
                                                        <option >Select organization</option>
                                                        <option value="A">A</option>
                                                        <option value="B">B</option>
                                                        <option value="AB">AB</option>
                                                        <option value="O">O</option>
                                                    </select>
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="rh_system">RH system</label>
                                                    <select id="rh_system" class="form-control" name="rh_system" required>
                                                        <option >Select organization</option>
                                                        <option value="+">+</option>
                                                        <option value="-">-</option>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-12">
                                                    <label for="org_id">Organization</label>
                                                    <select id="org_id" class="form-control" name="org_id" required>
                                                        <option >Select organization</option>
                                                        <?php
                                                        include_once('./database/connection.php');
                                                        $query = "SELECT * FROM `organizations`";
                                                        $results = $conn->query($query);
                                                        $count = 1;
                                                        while ($row = $results->fetch_assoc()) {
                                                        ?>
                                                            <option value="<?php echo $row['id'] ?>"><?php echo $row['name'] ?></option>
                                                        <?php } ?>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="card-footer">
                                            <button class="btn btn-primary" name="add_blood_detail_btn">Submit</button>
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
    <script>
        $(document).ready(function() {
            // var org_id = $('#org_id').html();
            // console.log(org_id);
            // $.ajax({
            //     method: 'GET',
            //     url: './database/process.php',
            //     success: function(data) {
            //         console.log(data);
            //     }
            // })
        })
    </script>
    <!-- Footerscript end -->
</body>
<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>