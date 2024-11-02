<?php
include 'layouts/header.php';
include 'layouts/sidebar.php';
?>

<!--page-content -->
<div class="page-wrapper">
	<div class="page-content">

		<!--end row-->
		<div class="text-center">
			<h2 class="text-danger">Welcome to Your Dashboard</h2>
			<h3 class="text-success lead">We're glad to have you here. Feel free to explore your dashboard and manage your settings.</h3>

			<br><br><br>
			<div class="row">

				<div class="card">
					<div class="card-header">
						<h2 class="text-danger"> Name: <?php echo $_SESSION['user']['name']; ?></h2>
					</div>
					<div class="card-body">
						<h3 class="text-info">Email: <?php echo $_SESSION['user']['email']; ?></h3>
						<h3 class="text-primary">Phone: <?php echo $_SESSION['user']['phone']; ?></h3>


					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<!--end page content -->



<?php
include 'layouts/footer.php';
?>