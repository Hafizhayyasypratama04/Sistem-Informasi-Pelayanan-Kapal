<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Login Page</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f2f2f2; /* Background color for the body */
      margin: 0;
      overflow-x: hidden;
      display: flex;
      justify-content: center;
      align-items: center;
      height: 100vh;
    }

    .login-card {
      width: 600px; /* Adjusted width */
      padding: 50px; /* Adjusted padding */
      border-radius: 10px;
      box-shadow: 0 0 20px rgba(0, 0, 0, 0.1); /* Add shadow to card */
      background-color: #fff;
      text-align: center; /* Center align content */
    }

    .logo img {
      width: 250px; /* Adjust logo width */
    }

    .form-group {
      margin-bottom: 20px;
    }

    .form-control {
      border-radius: 5px;
    }

    .btn-primary {
      width: 100%;
      border-radius: 5px;
      background-color: #000; /* Black color */
      color: #fff; /* Text color */
    }

    .btn-google {
      width: 100%;
      border-radius: 5px;
      background-color: #f5f5f5; /* Google Red */
      color: #000; /* Text color */
    }

    .btn-google i {
      margin-right: 10px;
    }
  </style>
</head>
<body>

<div class="login-card">
  <div class="logo mb-4"> <!-- Added margin bottom -->
    <img src="img/logo.png" alt="Logo Perusahaan">
  </div>
  <form>
    <div class="form-group">
      <input type="text" class="form-control" placeholder="Email" required>
    </div>
    <div class="form-group">
      <input type="password" class="form-control" placeholder="Password" required>
    </div>
    <a href="index.php" class="btn btn-primary mb-3">Masuk</a> <!-- Changed button to anchor -->
    <button type="button" class="btn btn-google">
      <i class="fab fa-google"></i> Masuk dengan Google
    </button>
  </form>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
