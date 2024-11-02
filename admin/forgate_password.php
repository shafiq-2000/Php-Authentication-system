<?php
include 'layouts/head.php';
include 'config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require '../PHPMailer/Exception.php';
require '../PHPMailer/PHPMailer.php';
require '../PHPMailer/SMTP.php';
define('BASE_URL', 'http://localhost/Authentication_system_php/');
?>
<?php
if (isset($_POST['form1'])) {
	try {
		if (empty($_POST['femail'])) {
			throw new Exception("Input filled can not empty");
		}

		if (!filter_var($_POST['femail'], FILTER_VALIDATE_EMAIL)) {
			throw new Exception("Email is invalid");
		}

		$query = $pdo->prepare("SELECT * FROM users WHERE email=? AND status=?");
		$query->execute([$_POST['femail'], 1]);
		$total = $query->rowcount();
		if (!$total) {
			throw new Exception("Email is not found");
		}

		$token = time();


		$statement = $pdo->prepare("UPDATE users SET token=? WHERE email=?");
		$statement->execute([$token, $_POST['femail']]);

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
			$mail->addAddress($_POST['femail']); // Receiver email

			//Content
			$mail->isHTML(true); //Set email format to HTML
			$mail->Subject = 'Reset Password Verify';
			$mail->Body = 'Please click on this link to Reset your Password:<br> <a href="' . BASE_URL . 'admin/resetPassword-verify.php?token=' . $token . '">Reset here</a>';
			$mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

			$mail->send();
		} catch (Exception $e) {
			echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}

		echo "<script>alert('Please check your email and click reset button')</script>";
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
				<h4 class="mt-5 font-weight-bold">Forgot Password?</h4>
				<p class="text-muted">Enter your registered email ID to reset the password</p>
				<form action="" method="post">

					<div class="my-4">
						<label class="form-label">Email id</label>
						<input type="email" name="femail" class="form-control form-control-lg" placeholder="example@user.com">
					</div>
					<div class="d-grid gap-2">
						<button type="submit" name="form1" class="btn btn-primary btn-lg">Send</button> <a href="login.php" class="btn btn-light btn-lg"><i class="bx bx-arrow-back me-1"></i>Back to Login</a>
					</div>

				</form>
			</div>
		</div>
	</div>
</div>

<?php
//include 'layouts/footer.php';
?>