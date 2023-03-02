<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">


<!-- index.html  21 Nov 2019 03:44:50 GMT -->
<!-- start head_html.php -->
<?php include('./includes/head_html.php');
if (isset($_SESSION['user']['id'])) {
    // $_SESSION['unauth'] = "You have to login first!";
    header('location: index.php');
    exit;
} ?>
<!-- end head_html.php -->

<body>
    <div class="loader"></div>
    <div id="app">
        <div class="main-wrapper main-wrapper-1">
            <div class="navbar-bg"></div>
            <!-- Navbar start -->
            <?php include('./includes/login_navbar.php'); ?>
            <!-- Navbar end -->

            <!-- Main Content -->
            <div class="main-content" style="padding-left: 30px">
                <div class="content p-5">
                    <section class="section">
                        <!-- Login form here -->
                        <div class="col-lg-6 mx-auto">
                            <?php
                            if (isset($_SESSION['login_error'])) {
                                echo '<div class="alert alert-danger mb-0" role="alert">';
                                echo $_SESSION['login_error'];
                                echo '</div>';
                                unset($_SESSION['login_error']);
                            }
                            if (isset($_SESSION['unauth'])) {
                                echo '<div class="alert alert-danger mb-0" role="alert">';
                                echo $_SESSION['unauth'];
                                echo '</div>';
                                unset($_SESSION['unauth']);
                            }
                            ?>
                            <form method="POST" action="./database/process.php">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Admin Login</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="form-group row">
                                            <label for="email" class="col-sm-3 col-form-label">Email</label>
                                            <div class="col-sm-9">
                                                <input type="email" class="form-control" id="email" name="email" placeholder="Email" required>
                                            </div>
                                        </div>
                                        <div class="form-group row">
                                            <label for="password" class="col-sm-3 col-form-label">Password</label>
                                            <div class="col-sm-9">
                                                <input type="password" class="form-control" id="password" name="password" placeholder="Password" required>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="card-footer">
                                        <button type="submit" class="btn btn-primary" name="login">Sign in</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </section>
                </div>
            </div>
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