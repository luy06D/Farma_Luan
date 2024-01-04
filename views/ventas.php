<?php require_once './cabezera.php' ?>


<!-- DataTable -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">


  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Ventas</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
          <!-- <li class="breadcrumb-item"></li> -->
          <li class="breadcrumb-item active"><a href="./ventas.php">Ventas</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <section class="section">
      <div class="row">
        <div class="col-lg-12">

          <div class="card">
            <div class="card-body mt-3">
              <!-- <h5 class="card-title">Bordered Tabs</h5> -->

              <!-- Bordered Tabs -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Venta</button>
                </li>
                
              </ul>

              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                 <section class="section mt-3">
                  <div class="row">
                    <div class="col-lg-12">
                    <div class="card text-center">
                          <div class="card-body">
                              <h5 class="card-title">Realizar Venta</h5>

                              <div class="form-floating col-md-4 mx-auto">
                                <input type="text" id="buscar-producto" class="form-control nota-practica text-center" placeholder="" min="0" max="20">
                                <label for="floatingInput">Buscar</label>
                            </div>

                              

                              <form class="row g-3 mt-4">
                              <table id="tabla-producto_venta" class="table table-striped table-hover responsive nowrap" style="width:100%">
                                <thead >
                                  <tr>
                                    <th>#</th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                    <th>Precio</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Receta Médica</th>                                    
                                    <th>Operación</th>
                                  </tr>
                                </thead>
                                <tbody>
                                  <!-- DATOS ASINCRONOS -->
                                </tbody>
                              </table>
                            </form>
                          </div>
                      </div>
                    </div>
                  </div>       
                 </section>

                 
                </div>
               </div>

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

  <script src="../js/ventas.js"></script>


  <?php include './footer.php' ?>