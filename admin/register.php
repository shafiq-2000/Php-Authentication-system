<?php
include 'layouts/head.php';
// include 'layouts/header.php';
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
define('BASE_URL', 'http://localhost/Authentication_system_php/');
?>
<?php
if (isset($_SESSION['user'])) {
    header('Location: dashboard.php');
    exit();
}
?>

<?php
if (isset($_POST['register'])) {
    try {

        if ($_POST['name'] == '') {
            throw new Exception("Name can not be empty");
        }
        if ($_POST['email'] == '') {
            throw new Exception("Email can not be empty");
        }
        if (!filter_var($_POST['email'], FILTER_VALIDATE_EMAIL)) {
            throw new Exception("Email is invalid");
        }

        $statement = $pdo->prepare("SELECT * FROM users WHERE email=?");
        $statement->execute([$_POST['email']]);
        $total = $statement->rowcount();
        if ($total) {
            throw new Exception("Email alredy exits");
        }


        if ($_POST['phone'] == '') {
            throw new Exception("phone can not be empty");
        }
        if ($_POST['password'] == '' || $_POST['confirmpassword'] == '') {
            throw new Exception("Password can not be empty");
        }
        if ($_POST['password'] != $_POST['confirmpassword']) {
            throw new Exception("Password not match");
        }

        $name = ucwords($_POST['name']);
        $email = $_POST['email'];
        $phone = $_POST['phone'];
        $password = $_POST['password'];
        // $password = password_hash($_POST['password'], PASSWORD_BCRYPT);
        $token = time();
        $status = 0;


        $insert = $pdo->prepare("INSERT INTO users (name, email, password, phone, token, status) VALUES (?, ?, ?, ?, ?, ?)");
        $query = $insert->execute([$name, $email, $password, $phone, $token, $status]);

        if ($query) {
            echo "<script>alert('Check your email for verified!! ')</script>";
        }

        //email setup
        $mail = new PHPMailer(true);

        try {

            $mail->isSMTP(); //Send using SMTP
            $mail->Host = 'smtp.mailtrap.io'; //Set the SMTP server to send through
            $mail->SMTPAuth = true;
            $mail->Username = '84193dfc990e5e'; //sent email
            $mail->Password = '3a8456715629c7'; //password this email(app password)
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
            $mail->Port = 2525;

            //Recipients
            $mail->setFrom('abc@gmail.com', 'Shafiq'); //sent email
            $mail->addAddress($_POST['email']); // Receiver email

            //Content
            $mail->isHTML(true); //Set email format to HTML
            $mail->Subject = 'Registration Verification email';
            $mail->Body = 'Please click on this link to verify your registration:<br> <a href="' . BASE_URL . 'registration-verify.php?token=' . $token . '">Click here</a>';
            $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

            $mail->send();
        } catch (Exception $e) {
            echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    } catch (Exception $e) {
        $error_message = $e->getMessage();
    }
}
?>
<div class="row row-cols-1 row-cols-lg-2 row-cols-xl-2">
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
                        <h3 class="">Registration</h3>
                        <p>Already have an account? <a href="login.php">Sign in here</a>
                        </p>
                    </div>
                    <div class="d-grid">
                        <a class="btn my-4 shadow-sm btn-white" href="javascript:;"> <span class="d-flex justify-content-center align-items-center">
                                <img class="me-2" src="assets/images/icons/search.svg" width="16" alt="Image Description">
                                <span>Sign Up with Google</span>
                            </span>
                        </a> <a href="javascript:;" class="btn btn-facebook"><i class="bx bxl-facebook"></i>Sign Up with Facebook</a>
                    </div>
                    <div class="login-separater text-center mb-4"> <span>OR SIGN UP WITH EMAIL</span>
                        <hr>
                    </div>
                    <div class="form-body">
                        <form class="row g-3" method="post">
                            <div class="col-sm-6">
                                <label class="form-label">Name</label>
                                <input type="text" class="form-control" name="name" placeholder="Enter your name" value="<?php if (isset($_POST['name'])) {
                                                                                                                                echo $_POST['name'];
                                                                                                                            } ?>">
                            </div>
                            <div class="col-6">
                                <label class="form-label">Email Address</label>
                                <input type="email" class="form-control" name="email" placeholder="enter your email" value="<?php if (isset($_POST['email'])) {
                                                                                                                                echo $_POST['email'];
                                                                                                                            } ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Phone</label>
                                <input type="number" class="form-control" name="phone" placeholder="Enter your name" value="<?php if (isset($_POST['phone'])) {
                                                                                                                                echo $_POST['phone'];
                                                                                                                            } ?>">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Password</label>
                                <input type="password" class="form-control" name="password" placeholder="Enter your password">
                            </div>
                            <div class="col-sm-6">
                                <label class="form-label">Confirm Password</label>
                                <input type="password" class="form-control" name="confirmpassword" placeholder="Enter your Confirm password">
                            </div>

                            <div class="col-12">
                                <div class="form-check form-switch">
                                    <input class="form-check-input" type="checkbox" id="flexSwitchCheckChecked">
                                    <label class="form-check-label" for="flexSwitchCheckChecked">I read and agree to Terms &amp; Conditions</label>
                                </div>
                            </div>
                            <div class="col-12">
                                <div class="d-grid">
                                    <button type="submit" name="register" class="btn btn-primary"><i class="bx bx-user"></i>Sign up</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>