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
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Appointment</h5>
                        <h1 class="display-4">Make An Appointment For Your Family</h1>
                    </div>
                    <p class="mb-5">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5 me-3" href="">Find Doctor</a>
                    <a class="btn btn-outline-primary rounded-pill py-3 px-5" href="">Read More</a>
                </div>
                <div class="col-lg-6">
                    <div class="bg-light text-center rounded p-5">
                        <?php
                        if (isset($_SESSION['receiver_request'])) {
                            echo '<div class="alert alert-success mb-0" role="alert">';
                            echo    $_SESSION['receiver_request'];
                            echo '</div>';
                            unset($_SESSION['receiver_request']);
                        }
                        if (isset($_SESSION['receiver_request'])) {
                            echo '<div class="alert alert-success mb-0" role="alert">';
                            echo    $_SESSION['receiver_request'];
                            echo '</div>';
                            unset($_SESSION['receiver_request']);
                        }
                        if (isset($_SESSION['receiver_error'])) {
                            echo '<div class="alert alert-danger mb-0" role="alert">';
                            echo    $_SESSION['redceiver_error'];
                            echo '</div>';
                            unset($_SESSION['redceiver_error']);
                        }
                        ?>
                        <h1 class="mb-4">Request for blood</h1>
                        <form method="POST" action="./database/process.php">
                            <div class="row g-3">
                                <div class="col-12 col-sm-12">
                                    <input type="email" class="form-control bg-white border-0" name="receiver_email" placeholder="Email" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-white border-0" name="receiver_cnic" placeholder="CNIC" pattern="[0-9]{5}-[0-9]{7}-{0-9}{1}" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-white border-0" name="receiver_name" placeholder="Your Name" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-white border-0" name="receiver_phone_no" placeholder="Phone No" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-white border-0" name="receiver_bottle_qty" placeholder="Blood bottle qty" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-white border-0" style="height: 55px;" name="receiver_abo_type" required>
                                        <option value="" selected>Choose ABO Type</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                    <span class="check_avail d-none"><a href="#">check for availbility</a></span>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-white border-0" style="height: 55px;" name="receiver_rh_system" required>
                                        <option value="" selected>RH System</option>
                                        <option value="+">+</option>
                                        <option value="-">-</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12 div_avail d-none">
                                    <select class="form-select bg-white border-0" style="height: 55px;" name="avail_user">
                                        <option value="" selected>Available Users</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="" id="">
                                        <input type="text" class="form-control bg-white border-0" name="receiver_address" placeholder="Address" style="height: 55px;" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3" type="submit" name="request_submit">Make An Appointment</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="row gx-5 mt-5">
                <div class="col-lg-6">
                    <div class="bg-light text-center rounded p-5">
                        <?php
                        if (isset($_SESSION['donar_request'])) {
                            echo '<div class="alert alert-success mb-0" role="alert">';
                            echo    $_SESSION['donar_request'];
                            echo '</div>';
                            unset($_SESSION['donar_request']);
                        }
                        if (isset($_SESSION['donar_error'])) {
                            echo '<div class="alert alert-danger mb-0" role="alert">';
                            echo    $_SESSION['donar_error'];
                            echo '</div>';
                            unset($_SESSION['donar_error']);
                        }
                        ?>
                        <h1 class="mb-4">Become a donar</h1>
                        <form method="POST" action="./database/process.php">
                            <div class="row g-3">
                                <div class="col-12 col-sm-12">
                                    <input type="email" class="form-control bg-white border-0" name="donar_email" placeholder="Email" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-white border-0" name="donar_cnic" placeholder="CNIC" pattern="[0-9]{5}-[0-9]{7}-{0-9}{1}" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-white border-0" name="donar_name" placeholder="Your Name" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-white border-0" name="donar_phone_no" placeholder="Phone No" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <input type="text" class="form-control bg-white border-0" name="donar_bottle_qty" placeholder="Blood bottle qty" style="height: 55px;" required>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-white border-0" style="height: 55px;" name="donar_abo_type" required>
                                        <option value="" selected>Choose ABO Type</option>
                                        <option value="A">A</option>
                                        <option value="B">B</option>
                                        <option value="AB">AB</option>
                                        <option value="O">O</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-6">
                                    <select class="form-select bg-white border-0" style="height: 55px;" name="donar_rh_system" required>
                                        <option value="" selected>RH System</option>
                                        <option value="+">+</option>
                                        <option value="-">-</option>
                                    </select>
                                </div>
                                <div class="col-12 col-sm-12">
                                    <div class="" id="">
                                        <input type="text" class="form-control bg-white border-0" name="donar_address" placeholder="Address" style="height: 55px;" required>
                                    </div>
                                </div>
                                <div class="col-12">
                                    <button class="btn btn-primary w-100 py-3 text-capitalize" type="submit" name="donar_submit">Ask for donation</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
                <div class="col-lg-6 mb-5 mb-lg-0">
                    <div class="mb-4">
                        <h5 class="d-inline-block text-primary text-uppercase border-bottom border-5">Appointment</h5>
                        <h1 class="display-4">Become donar to help needy</h1>
                    </div>
                    <p class="mb-5">Eirmod sed tempor lorem ut dolores. Aliquyam sit sadipscing kasd ipsum. Dolor ea et dolore et at sea ea at dolor, justo ipsum duo rebum sea invidunt voluptua. Eos vero eos vero ea et dolore eirmod et. Dolores diam duo invidunt lorem. Elitr ut dolores magna sit. Sea dolore sanctus sed et. Takimata takimata sanctus sed.</p>
                    <a class="btn btn-primary rounded-pill py-3 px-5 me-3" href="">Find Doctor</a>
                    <a class="btn btn-outline-primary rounded-pill py-3 px-5" href="">Read More</a>
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
    <script>
        var receiver_bottle_qty;
        var receiver_abo_type;
        var receiver_rh_system;
        $('input[name=receiver_bottle_qty], select[name=receiver_abo_type],select[name=receiver_rh_system]').on('change', function() {
            receiver_bottle_qty = $('input[name=receiver_bottle_qty]').val();
            receiver_abo_type = $('select[name=receiver_abo_type]').val();
            receiver_rh_system = $('select[name=receiver_rh_system]').val();
            if (receiver_bottle_qty != '' && receiver_abo_type != '' && receiver_rh_system != '') {
                $('.check_avail').removeClass('d-none');
            } else {
                $('.check_avail').addClass('d-none');
            }
        });

        $('.check_avail').on('click', function(e){
            e.preventDefault();
            var div_avail = $('.div_avail');
            var div_avail_child = $('.div_avail').children();
            console.log(div_avail);
            console.log(div_avail_child);
            var check_avail = $('.check_avail').html();
            $.ajax({
                url: './database/process.php',
                type: 'POST',
                dataType: 'JSON',
                data: {
                    'check_avail': check_avail,
                    'receiver_rh_system': receiver_rh_system,
                    'receiver_abo_type': receiver_abo_type,
                },
                success: function(data){
                    $(div_avail).removeClass('d-none');
                    $(data['donars']).each(function(index, element){
                        var option = `<option value=`+element['id']+`>`+element['name']+`</option>`;
                        $(div_avail_child).append(option);
                    });
                    $(data['org']).each(function(index, element){
                        var option = `<option value=`+element['org']['id']+`>`+element['name']+`(count: `+element['org']['count']+`)</option>`;
                        $(div_avail_child).append(option);
                    });
                }
            });
        })
    </script>
</body>

</html>