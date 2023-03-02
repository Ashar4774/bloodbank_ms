<!DOCTYPE html>
<html lang="en">

<!-- html header -->
<?php
session_start();
include('./partials/html_header.php');
?>
<!-- end of html header -->

<body>
    <!-- Topbar Start -->
    <?php include('./partials/topbar.php'); ?>
    <!-- Topbar End -->

    <!-- Navbar Start -->
    <?php include('./partials/navbar.php'); ?>
    <!-- Navbar End -->


    <!-- Appointment Start -->
    <div class="container-fluid py-5">
        <div class="container">
            <div class="row gx-5">
                <div class="col-lg-6 mx-auto">
                    <div class="bg-light text-center rounded p-5">
                        <?php
                        if (isset($_SESSION['receiver_request'])) {
                            echo '<div class="alert alert-success mb-0" role="alert">';
                            echo    $_SESSION['receiver_request'];
                            echo '</div>';
                            unset($_SESSION['receiver_request']);
                        }
                        if (isset($_SESSION['redceiver_error'])) {
                            echo '<div class="alert alert-danger mb-0" role="alert">';
                            echo    $_SESSION['redceiver_error'];
                            echo '</div>';
                            unset($_SESSION['redceiver_error']);
                        }
                        ?>
                        <h1 class="mb-4">Login yourself to see record</h1>
                        <form method="POST" action="./database/process.php">
                            <div class="row g-3">
                                <div class="col-12 col-sm-6">
                                    <input type="email" class="form-control bg-white border-0" name="email" placeholder="Your Email" style="height: 55px;">
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="password" class="form-control bg-white border-0" name="password" placeholder="Password" style="height: 55px;">
                                </div>
                                
                                <div class="col-12 col-sm-12">
                                    <select class="form-select bg-white border-0" style="height: 55px;" name="role">
                                        <option selected disabled>Choose your role</option>
                                        <option value="1">Donar</option>
                                        <option value="2">Receiver</option>
                                    </select>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit" name="login">Login</button>
                                    <p>Don't have account? <a href="register.php">Register</a> </p>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- Appointment End -->


    <!-- Footer Start -->
    <?php include('./partials/footer.php'); ?>
    <!-- Footer End -->


    <!-- Back to Top -->
    <a href="#" class="btn btn-lg btn-primary btn-lg-square back-to-top"><i class="bi bi-arrow-up"></i></a>


    <!-- JavaScript Libraries -->
    <?php include('./partials/script.php'); ?>
</body>

</html>