
<!DOCTYPE html>
<html lang="es">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">

  <title>Farma Luan</title>
  <meta content="" name="description">
  <meta content="" name="keywords">

  <!-- Favicons -->
  <link href="./img/favicon.png" rel="icon">
  <link href="./img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Google Fonts -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Croissant+One&family=EB+Garamond&family=Inclusive+Sans&family=Mooli&display=swap" rel="stylesheet">
  <!-- Vendor CSS Files -->
  <link href="../vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="../vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="../vendor/boxicons/css/boxicons.css" rel="stylesheet">
  <link href="../vendor/quill/quill.snow.css" rel="stylesheet">
  <link href="../vendor/quill/quill.bubble.css" rel="stylesheet">
  <link href="../vendor/remixicon/remixicon.css" rel="stylesheet">
  <link href="../vendor/simple-datatables/style.css" rel="stylesheet">


  <!-- Template Main CSS File -->
  <link href="../css/style.css" rel="stylesheet">

</head>

<body>

  <!-- ======= Header ======= -->
  <header id="header" class="header fixed-top d-flex align-items-center">

    <div class="d-flex align-items-center justify-content-between">
      <a href="./index.php" class="logo d-flex align-items-center">
        <!-- <img src="../img/3plogo.png" alt="logo 3p"> -->
        <span class="d-none d-lg-block"><span style="color: red;"><span style="color: #0193F2 ;">Farma</span><span> Luan</span></span>
      </a>
      <i class="bi bi-list toggle-sidebar-btn"></i>
    </div><!-- End Logo -->


    <nav class="header-nav ms-auto">
      <ul class="d-flex align-items-center">
        
        <li class="nav-item dropdown pe-3">

          <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
            <img src="" alt="Perfil" class="rounded-circle">
         
          </a><!-- End Profile Iamge Icon -->

          <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow profile">
            <li class="dropdown-header">
              <!-- <h6><?= $_SESSION['segurity']['nombres']?> </h6> -->
              <span>Usuario</span>
            </li>
            <li>
              <hr class="dropdown-divider">
            </li>

            <li>
              <a class="dropdown-item d-flex align-items-center" href="../controllers/usuarios.controller.php?operation=destroy">
                <i class="bi bi-box-arrow-right"></i>
                <span >Cerrar sesión</span>
              </a>
            </li>

          </ul><!-- End Profile Dropdown Items -->
        </li><!-- End Profile Nav -->

      </ul>
    </nav><!-- End Icons Navigation -->

  </header><!-- End Header -->

  <!-- ======= Sidebar ======= -->
  <aside id="sidebar" class="sidebar">

    <ul class="sidebar-nav" id="sidebar-nav">

      <li class="nav-item">
        <a class="nav-link collapsed" href="../views/index.php">
          <i class="bi bi-grid"></i>
          <span>Inicio</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../views/ventas.php">
        <i class="bi bi-file-earmark-text"></i>
          <span>Ventas</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="../views/Serviciostabs.php">
        <i class="bi bi-person-lines-fill"></i>
          <span>Medicamentos</span>
        </a>
      </li>

      <li class="nav-item">
        <a class="nav-link collapsed" href="../views/garantiatabs.php">
          <i class="bi bi-journal-text"></i>
          <span>Caja</span>
        </a>
      </li><!-- End Dashboard Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../views/Tecnicostabs.php">
          <i class="bi bi-tools"></i>
          <span>Proveedores</span>
        </a>
      </li>

      <li class="nav-heading">Componentes</li>
        <li class="nav-item">
          <a class="nav-link collapsed" href="../views/tipoequipos.php">
            <i class="bi bi-bookmark-check"></i>
            <span>Clientes</span>
          </a>
        </li><!-- End Profile Page Nav -->
        
        <li class="nav-item">
          <a class="nav-link collapsed" href="../views/comprastabs.php">
            <i class="bi bi-bag-check"></i>
            <span>Reportes</span>
          </a>
        </li><!-- End Profile Page Nav -->

      <li class="nav-item">
        <a class="nav-link collapsed" href="../controllers/usuarios.controller.php?operation=destroy">
          <i class="bi bi-box-arrow-left"></i>
          <span>Salir</span>
        </a>
      </li><!-- End Profile Page Nav -->

    </ul>

  </aside><!-- End Sidebar-->

