<?php session_start(); ?>
<!doctype html>
<html lang="en">

<head>
  <title>Auth||system</title>
  <!-- Required meta tags -->
  <meta charset="utf-8" />
  <meta
    name="viewport"
    content="width=device-width, initial-scale=1, shrink-to-fit=no" />

  <!-- Bootstrap CSS v5.2.1 -->
  <link
    href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css"
    rel="stylesheet"
    integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN"
    crossorigin="anonymous" />
</head>

<body class="container">
  <!-- navbar -->
  <nav class="navbar navbar-expand-lg shadow mt-3">
    <div class="container-fluid">
      <button class="navbar-toggler" data-bs-toggle="collapse" data-bs-target="#NavMenuPanel">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a href="index.php" class="navbar-brand">Shafiq</a>
      <div class="collapse navbar-collapse" id="NavMenuPanel">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">

          <li class="nav-item">
            <a href="index.php" class="nav-link">Home</a>
          </li>

          <?php if (!isset($_SESSION['user'])) { ?>
            <li class="nav-item">
              <a href="admin/login.php" class="nav-link">login</a>
            </li>
            <li class="nav-item">
              <a href="admin/register.php" class="nav-link">register</a>
            </li>
          <?php } ?>


          <li class="nav-item">
            <a href="admin/dashboard.php" class="nav-link">Dashboard</a>
          </li>
        </ul>
        <div>
          <form class="d-flex">
            <input type="text" class="form-control">
            <button class="btn btn-primary mx-1">Search</button>
          </form>
        </div>

      </div>

    </div>
  </nav>
  <div class="mt-5">
    <div class="row">
      <div class="col-lg-8 offset-lg-2">
        <h1 class="display-1 text-danger">Welcome To Our Website</h1>
      </div>
    </div>
  </div>
  <script
    src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
    integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
    crossorigin="anonymous"></script>

  <script
    src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.min.js"
    integrity="sha384-BBtl+eGJRgqQAUMxJ7pMwbEyER4l1g+O15P+16Ep7Q9Q+zqX6gSbd85u4mG4QzX+"
    crossorigin="anonymous"></script>
</body>

</html>