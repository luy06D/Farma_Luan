<?php require_once './cabezera.php' ?>


<!-- DataTable -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Categorias/Uds</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
          <!-- <li class="breadcrumb-item"></li> -->
          <li class="breadcrumb-item active"><a href="./categoriasUds.php">Categorias/Uds</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
        <div class="row">
            <!-- First Card -->
            <div class="col-lg-6">
                <div class="card">
                    <div class="card-body">
                    <h5 class="card-title">Lista Categorias</h5>
                    <table class="table">
                        <thead>
                        <tr>
                            <th scope="col">#</th>
                            <th scope="col">Categorias</th>
                            <th scope="col">Estante</th>                            
                            <th scope="col">Operaciones</th>
                        </tr>
                        </thead>
                        <tbody>
                            <!-- DATOS ASINCRONOS  -->
                        </tbody>
                    </table>
                    </div>
                </div>
            </div>
            <!-- End First Card -->

            <!-- Second Card -->
            <div class="col-lg-6">
            <div class="card">
                <div class="card-body">
                <h5 class="card-title">Lista Unidades de medida</h5>
                <table class="table" id="table-unidades">
                    <thead>
                    <tr>
                        <th scope="col">Item</th>
                        <th scope="col">Unidades</th>
                        <th scope="col">Operaciones</th>
                    </tr>
                    </thead>
                    <tbody>
                        <!-- DATOS ASINCRONOS  -->
                    </tbody>
                </table>
                </div>
            </div>
            </div>

        </div>
    </section>


    
 



  </main><!--fin main -->

  <!-- sweetalert2 -->
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
  <!-- AJAX = JavaScript asincrónico-->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.1/jquery.min.js"></script>

  <!-- datatable-->
  <script src="https://cdn.datatables.net/1.13.1/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/1.13.1/js/dataTables.bootstrap5.min.js"></script>

  <!-- opcional-->
  <script src="https://code.jquery.com/jquery-3.7.0.js"></script>
  <script src="https://cdn.datatables.net/1.13.6/js/jquery.dataTables.min.js"></script>
  <script src="https://cdn.datatables.net/responsive/2.5.0/js/dataTables.responsive.min.js"></script>


  <!-- Incluye Chart.js -->
  <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
  <script src="../js/alertSweet.js"></script>
  <script src="../js/categoriasUds.js"></script>
  



  <?php include './footer.php' ?>