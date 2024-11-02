<div class="sidebar-wrapper" data-simplebar="true">
    <div class="sidebar-header">
        <div>
            <img src="assets/images/logo-icon.png" class="logo-icon" alt="logo icon">
        </div>
        <div>
            <h4 class="logo-text">Shafiq</h4>
        </div>
        <div class="toggle-icon ms-auto"><i class='bx bx-arrow-to-left'></i>
        </div>
    </div>
    <!--navigation-->
    <ul class="metismenu" id="menu">
        <li> <a href="dashboard.php"><i class=""></i>Dashboard</a>

            <?php if (!isset($_SESSION['user'])) { ?>
        <li> <a href="login.php"><i class=""></i>Login</a>
        <li> <a href="register.php"><i class=""></i>Register</a>
        <?php } ?>

        <li> <a href="../index.php"><i class=""></i>Home</a>

    </ul>
    <!--end navigation-->
</div>