<?php
session_start();
?>
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
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Blood group detail</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <?php
                                            if (isset($_SESSION['blood_success'])) {
                                                echo '<div class="alert alert-success mb-0" role="alert">';
                                                echo    $_SESSION['blood_success'];
                                                echo '</div>';
                                                unset($_SESSION['blood_success']);
                                            }
                                            if (isset($_SESSION['blood_update'])) {
                                                echo '<div class="alert alert-success mb-0" role="alert">';
                                                echo    $_SESSION['blood_update'];
                                                echo '</div>';
                                                unset($_SESSION['blood_update']);
                                            }
                                            if (isset($_SESSION['blood_delete'])) {
                                                echo '<div class="alert alert-danger mb-0" role="alert">';
                                                echo    $_SESSION['blood_delete'];
                                                echo '</div>';
                                                unset($_SESSION['blood_delete']);
                                            }
                                            ?>
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            #
                                                        </th>
                                                        <th>Organization Name</th>
                                                        <th>Blood type</th>
                                                        <th>Qty</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include_once "./database/connection.php";
                                                    $sql_blood = "SELECT *, count(`org_id`) AS `count` FROM `blood_types` GROUP BY org_id, abo_type, rh_system ORDER BY id ASC";
                                                    $result_blood = $conn->query($sql_blood);
                                                    if (mysqli_num_rows($result_blood) > 0) {
                                                        // $row_blood = $result_blood->fetch_assoc();

                                                        $count = 1;
                                                        while ($row = $result_blood->fetch_assoc()) {
                                                            $org_id = $row['org_id'];
                                                            $sql_org = "SELECT `name` FROM `organizations` WHERE `id` = $org_id";
                                                            $result_org = $conn->query($sql_org);
                                                            $row_org = $result_org->fetch_array();
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $count++; ?>
                                                                </td>
                                                                <td><?php echo $row_org['name']; ?></td>
                                                                <td class="align-middle">
                                                                    <?php echo $row['abo_type'] . '<sup>' . $row['rh_system'] . '</sup>'; ?>
                                                                </td>
                                                                <td><?php echo $row['count'] ?></td>
                                                                <td>
                                                                    <a href="./edit_blood_detail.php?edit_blood_detail=<?php echo $row['id']; ?>" class="btn btn-primary " onclick="return confirm('Edit this record?')">Edit</a>
                                                                    <a href="./database/process.php?dlt_blood_detail=<?php echo $row['id']; ?>" class="btn btn-danger" onclick="return confirm('Delete this record?')">Delete</a>
                                                                </td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr>
                                                            <td colspan="4">
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
                            <div class="col-12 col-md-12 col-lg-12">
                                <div class="card">
                                    <div class="card-header">
                                        <h4>Blood group detail from donar</h4>
                                    </div>
                                    <div class="card-body">
                                        <div class="table-responsive">
                                            <table class="table table-striped" id="table-1">
                                                <thead>
                                                    <tr>
                                                        <th>
                                                            #
                                                        </th>
                                                        <th>CNIC</th>
                                                        <th>Donar name</th>
                                                        <th>Phone #</th>
                                                        <th>Organization Name</th>
                                                        <th>Blood type</th>
                                                        <th>Qty</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    include_once "./database/connection.php";
                                                    $sql_blood = "SELECT *, count(`name`) AS `count` FROM `donars` GROUP BY `cnic` ORDER BY id ASC";
                                                    $result_blood = $conn->query($sql_blood);
                                                    if (mysqli_num_rows($result_blood) > 0) {
                                                        // $row_blood = $result_blood->fetch_assoc();

                                                        $count = 1;
                                                        while ($row = $result_blood->fetch_assoc()) {
                                                            $org_id = $row['org_id'];
                                                            if ($org_id) {
                                                                $sql_org = "SELECT `name` FROM `organizations` WHERE `id` = $org_id";
                                                                $result_org = $conn->query($sql_org);
                                                                $row_org = $result_org->fetch_array();
                                                            }
                                                    ?>
                                                            <tr>
                                                                <td>
                                                                    <?php echo $count++; ?>
                                                                </td>
                                                                <td><?php echo $row['cnic']; ?></td>
                                                                <td><?php echo $row['name']; ?></td>
                                                                <td><?php echo $row['phone_no']; ?></td>
                                                                <td><?php echo (($org_id)) ? $row_org['name'] : 'Indivisual'; ?></td>
                                                                <td class="align-middle">
                                                                    <?php echo $row['abo_type'] . '<sup>' . $row['rh_system'] . '</sup>'; ?>
                                                                </td>
                                                                <td><?php echo $row['count'] ?></td>
                                                            </tr>
                                                        <?php }
                                                    } else { ?>
                                                        <tr>
                                                            <td colspan="4">
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

            <!-- Edit Modal with form -->
            <!-- <div class="modal fade" id="edit_blood_detail_modal" tabindex="-1" role="dialog" aria-labelledby="formModal" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title" id="formModal">Update Blood detail</h5>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <form class="" method="POST" action="./database/process.php">
                                <div class="form-row">
                                <input type="hidden" class="form-control" name="update_id" id="update_id">
                                    <div class="form-group col-md-6" id="edit_abo_type">
                                        <label>ABO Type</label>
                                        <input type="text" class="form-control" name="update_abo_type" id="update_abo_type">
                                    </div>
                                    <div class="form-group col-md-6" id="edit_rh_system">
                                        <label>RH system</label>
                                        <input type="text" class="form-control" name="update_rh_system" id="update_rh_system">
                                    </div>
                                </div>
                                <div class="form-row">
                                    <div class="form-group col-md-12" id="edit_org">
                                        <label>Organization</label>
                                        <input type="text" class="form-control" name="update_org" id="update_org">
                                    </div>
                                </div>
                                <button type="submit" class="btn btn-primary m-t-15 waves-effect" name="update_blood_detail">Update</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div> -->

            <!-- footer start -->
            <?php include('./includes/footer.php') ?>
            <!-- footer end -->
        </div>
    </div>
    <!-- Footerscript start -->
    <?php include('./includes/footer_script.php') ?>
    <!-- <script>
        $(document).ready(function() {
            $('.edit_blood_detail').on('click', function(e) {
                e.preventDefault();
                var id = $(this).data('id');
                console.log(id);
                $.ajax({
                    url: './database/process.php',
                    method: 'GET',
                    dataType: "json",
                    contentType: "application/json; charset=utf-8",
                    data: {
                        edit_blood_detail_id: id
                    },
                    success: function(response) {
                        console.log(response);
                        var update_id = $('#update_id').val(response['blood_detail'][0]);
                        var update_abo_type = $('#update_abo_type').val(response['blood_detail'][2]);
                        var update_rh_system = $('#update_rh_system').val(response['blood_detail'][3]);
                        var update_org = $('#update_org').val(response['org'][1]);
                        $('#edit_blood_detail_modal').modal('show');
                    }
                });
            })
        });
    </script> -->
    <!-- Footerscript end -->
</body>
<!-- index.html  21 Nov 2019 03:47:04 GMT -->

</html>