<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Bootstrap Sidebar</title>
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome CSS -->
  <link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css" rel="stylesheet">
  <style>
    body {
      background-color: #f2f2f2; /* Background color for the body */
      margin: 0;
      overflow-x: hidden; 
    }

    .sidebar {
      position: fixed;
      top: 0;
      left: 0;
      height: 100%;
      width: 250px;
      background-color: #fff; /* Background color for sidebar */
      color: #333; /* Text color for sidebar */
      padding-top: 20px;
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow to sidebar */
      transition: all 0.3s ease; /* Adding transition effect */
    }

    .sidebar-logo {
      text-align: center;
      margin-bottom: 20px;
    }

    .sidebar-menu {
      list-style: none;
      padding: 0;
      margin: 0;
    }

    .sidebar-menu li {
      padding: 10px 20px;
      border-bottom: none; /* Remove border */
    }

    .sidebar-menu li a {
      color: #333;
      text-decoration: none;
    }

    .sidebar-menu li a i {
      margin-right: 10px; /* Add space between icon and text */
    }

    .content {
      margin-left: 250px; /* Adjust margin to accommodate sidebar */
      padding: 20px;
    }


    .card {
      border: none; /* Remove border from card */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow to outer card */
    }

    .navbar {
      background-color: #fff; /* Background color for navbar */
      padding: 10px 5px;
      margin-left: 250px; /* Adjust margin to accommodate sidebar */
      box-shadow: 0 0 10px rgba(0, 0, 0, 0.1); /* Add shadow to navbar */
    }

    .navbar .navbar-nav .nav-link {
      color: #333; /* Text color for navbar */
    }

    .navbar .navbar-nav .nav-link.active,
    .navbar .navbar-nav .nav-link:hover {
      color: #333; /* Text color for active/hover navbar links */
    }

    /* Custom CSS for centering the search bar */
    .search-bar-container {
      display: flex;
      justify-content: center;
      align-items: center;
      margin-right: auto;
      margin-left: auto;
      width: 100%;
    }

    .search-bar-input {
      width: 50%;
      padding: 8px;
      border-radius: 5px;
      border: 1px solid #ccc;
      font-size: 16px;
    }

    /* Custom CSS for profile icon */
    .nav-link i {
      font-size: 36px; /* Adjusting the size of the icon */
      width: 73px; /* Adjusting the width of the icon */
      height: 75px; /* Adjusting the height of the icon */
      display: flex;
      justify-content: center;
      align-items: center;
    }
  </style>
</head>
<body>

<div class="sidebar" id="sidebar"> <!-- Added id for sidebar -->
  <div class="sidebar-logo">
    <img src="img/Logo.png" alt="Logo Perusahaan" width="150">
  </div>
  <ul class="sidebar-menu">
    <li><a href="#"><i class="fas fa-home"></i> Home</a></li>
    <li><a href="owner/owner1.php"><i class="fas fa-user"></i> Pemilik Rekening</a></li>
    <li><a href="Permohonan/Permohonan1.php"><i class="fas fa-file-alt"></i> Permohonan</a></li>
    <li><a href="Pegawai/Pegawai1.php"><i class="fas fa-users"></i> Pegawai</a></li>
    <li><a href="invoice/Invoice1.php"><i class="fas fa-file-invoice"></i> Invoice</a></li>
    <li><a href="Login.php"><i class="fas fa-sign-out-alt"></i> Logout</a></li>
  </ul>
</div>

<nav class="navbar navbar-expand navbar-dark">
  <div class="container-fluid">
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarSupportedContent">
      <div class="search-bar-container">
        <input class="search-bar-input" type="search" placeholder="Search" aria-label="Search">
      </div>
      <ul class="navbar-nav ms-auto">
        <li class="nav-item">
          <img src="img/Profile.png" alt="Profile Photo" class="nav-link rounded-circle">
          <div class="profile-name">Admin</div>
        </li>
      </ul>
    </div>
  </div>
</nav>

<div class="content container-fluid" style="align-items: center; margin-top: 150px; ">
  <div class="row justify-content-center">
    <div class="col-md-6" style="margin-right: 170px;">
        <div class="card text-center" style="margin-right: 150px;"> <!-- Removed inline style for card -->
          <div class="card-body">
            <img src="img/Logo.png" alt="Logo Perusahaan" class="card-img-top" style="width: 300px; margin: 0 auto;">
            <p class="card-text">PT Jatarim Binau Lines adalah perusahaan pelayaran yang bergerak di bidang pengiriman barang Otomotif. Kantor pusatnya berada di Kota Bekasi, Jawa Barat.</p>
          </div>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha1/dist/js/bootstrap.bundle.min.js"></script>
<!-- Font Awesome Script -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/js/all.min.js"></script>
</body>
</html>
