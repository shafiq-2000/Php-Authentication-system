<?php
include 'layouts/head.php';
include 'config.php';
?>
<?php
$statement = $pdo->prepare("SELECT * FROM users WHERE token=?");
$statement->execute([$_REQUEST['token']]);
$total = $statement->rowCount();

if (!$total) {
    header("location:../index.php");
    exit();
}
?>

<?php
if (isset($_POST['form2'])) {
    try {
        if ($_POST['password'] == '' || $_POST['confirmpassword'] == '') {
            throw new Exception("Password can not be empty");
        }
        if ($_POST['password'] != $_POST['confirmpassword']) {
            throw new Exception("Password not match");
        }

        $statement = $pdo->prepare("UPDATE users SET password = ? WHERE token = ?");
        $statement->execute([$_POST['password'], $_REQUEST['token']]);
        echo "<script>alert('Registration successful')</script>";
        header("location:login.php");
    } catch (Throwable $th) {
        $error_message = $th->getMessage();
    }
}

?>


<div class="authentication-forgot d-flex align-items-center justify-content-center">
    <div class="card forgot-box">
        <div class="card-body">
            <!--     displaye message-->
            <?php
            if (isset($error_message)) { ?>
                <div class="alert alert-danger" role="alert">
                    <?php echo $error_message; ?>
                </div>
            <?php } ?>

            <div class="p-4 rounded  border">
                <div class="text-center">
                    <img src="assets/images/icons/forgot-2.png" width="120" alt="">
                </div>
                <h4 class="mt-5 font-weight-bold">Reset Password?</h4>
                <p class="text-muted">Enter your registered email ID to reset the password</p>
                <form action="" method="post">

                    <div class="my-4">
                        <label class="form-label">New Password</label>
                        <input type="password" name="password" class="form-control form-control-lg">
                    </div>
                    <div class="my-4">
                        <label class="form-label">Confirm Password</label>
                        <input type="password" name="confirmpassword" class="form-control form-control-lg">
                    </div>
                    <div class="d-grid gap-2">
                        <button type="submit" name="form2" class="btn btn-primary btn-lg">Send</button>
                    </div>

                </form>
            </div>
        </div>
    </div>
</div>

<?php
//include 'layouts/footer.php';
?>