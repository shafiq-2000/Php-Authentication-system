<?php
include 'layouts/head.php';
include 'config.php';
?>

<?php

if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<?php
if (isset($_POST['login'])) {
    try {

        if ($_POST['email'] == '') {
            throw new Exception("Email can not be empty");
        }
        // if(empty($_POST['email'])){
        //     throw new Exception("Email can not be empty"); 
        // }
        if ($_POST['password'] == '') {
            throw new Exception("Password can not be empty");
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email is invalid");
        }

        $query = $pdo->prepare("SELECT * FROM users WHERE email=? AND status=?");
        $query->execute([$_POST['email'], 1]);
        $total = $query->rowcount();
        if (!$total) {
            throw new Exception("Email is not found");
        } else {
            $users = $query->fetchAll(PDO::FETCH_ASSOC);

            foreach ($users as $row) {
                $password = $row['password'];
                if ($_POST['password'] !== $password) {
                    throw new Exception("Password does not match");
                }
            }
        }

        echo "<script>alert('Login successfull')</script>";

        $_SESSION['user'] = $row;
        header('location:dashboard.php');
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}


?>



<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-3">
    <div class="col mx-auto mt-5">
        <div class="card mt-5">
            <div class="card-body">
                <div class="border p-4 rounded">
                    <!--     displaye message-->
                    <?php
                    if (isset($error_message)) { ?>
                        <div class="alert alert-danger" role="alert">
                            <?php echo $error_message; ?>
                        </div>
                    <?php } ?>

                    <div class="text-center">
                        <h3 class="">Sign in</h3>
                        <p>Don't have an account yet? <a href="register.php">Sign up here</a>
                        </p>
                    </div>
                    <div class="d-grid">
                        <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                                <img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
                                <span>Sign in with Google</span>
                            </span>
                        </a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign in with Facebook</a>
                    </div>
                    <div class="login-separater text-center mb-4"> <span>OR SIGN IN WITH EMAIL</span>
                        <hr>
                    </div>
                    <div class="form-body">
                        <form class="row g-3" method="post">
                            <div class="col-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="Enter your email">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Eneter Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter your pasword">
                            </div>
                            <div class="col-md-6">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked" checked="">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">Remember Me</label>
                                </div>
                            </div>
                            <div class="col-md-6 text-end"> <a href="forgate_password.php">Forgot Password ?</a>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" name="login" class="btn btn-primary"><i class="bx bxs-lock-open"></i>Sign in</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>


<?php
//nclude 'layouts/footer.php';
?>