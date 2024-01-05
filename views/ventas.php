<?php require_once './cabezera.php' ?>


<!-- DataTable -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">


<style>
    .input-container {
      position: relative;
      width: 300px;
      margin: 20px;
    }

    #buscar-producto {
      width: 100%;
      padding-right: 30px; /* Ajusta el espaciado para que haya espacio para el ícono */
    }

    .clear-icon {
      position: absolute;
      top: 50%;
      right: 10px;
      transform: translateY(-50%);
      cursor: pointer;
      display: none;
      color: red; /* Cambiar a color rojo */
      font-size: 16px; /* Ajustar tamaño de fuente */
      font-weight: bold; /* Ajustar el grosor de la fuente */
    }

    #idproducto {
    opacity: 0;
    position: absolute;
    left: -9999px;  /* Mueve el campo fuera de la pantalla */
}


    #buscar-producto:not(:placeholder-shown) + .clear-icon {
      display: block;
    }
  </style>
  
  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Medicamento/Producto</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
          <!-- <li class="breadcrumb-item"></li> -->
          <li class="breadcrumb-item active"><a href="./ventas.php">Ventas</a></li>

          <li class="breadcrumb-item active"><a href="./productos.php">Productos</a></li>
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
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Buscar Medicamento/Producto</button>
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

                              <div class="form-floating col-md-4 mx-auto position-relative">
                                <input type="text" id="buscar-producto" class="form-control nota-practica text-center" placeholder="" min="0" max="20" >
                                <span id="clear-input" class="clear-icon">&#10006;</span>
                                <label for="floatingInput">Buscar</label>
                                
                              </div>

                              <form class="row g-3 mt-4">
                              <table id="tabla_producto_venta" class="table table-striped table-hover responsive nowrap" style="width:100%">
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
                  
                    <div class="row">
                      <div class="col-lg-12">
                      <div class="card text-center">
                            <div class="card-body">
                                <h5 class="card-title">Lista de Medicamento/productos agregados</h5>

                                <form class="row g-3 mt-4">
                                <table id="tabla_producto" class="table table-striped table-hover responsive nowrap" style="width:100%">
                                  <thead >
                                    <tr>
                                      <th>#</th>
                                      <th>Producto</th>
                                      <th>Usuario</th>
                                      <th>Cantidad</th>
                                      <th>Unidad/blister</th>
                                      <th>precioTotal</th>
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


                 <!-- Modal-->
                  <div class="modal fade" id="modal-agregarP" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                  <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-secondary" id="modal-header01">
                          <h5 class="modal-title text-white" id="modal-titulo01">Registro de producto</h5> 
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form id="productos">
                            <div class="row">

                              <div class="col-lg-4 mt-2">
                                  <label for="cantidad" class="col-form-label">Nombre producto</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="Nombreproducto"  disabled>
                                  </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                  <label for="cantidad" class="col-form-label">Stock actual</label>
                                  <div class="col-sm-12">
                                      <input type="text" class="form-control" id="stock" disabled>
                                  </div>
                              </div>


                              <div class="col-lg-4 mt-2">
                                <label for="cantidad" class="col-form-label">Cantidad</label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="cantidad" placeholder="Escriba aquí">
                                </div>
                              </div>

                              
                              <input type="text" class="form-control" id="idproducto" placeholder="Escriba aquí">

                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-success" id="guardar">Agregar</button>
                          <button type="reset" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  </div>


                </div>
          </div>
        </div>
       </div>
      </div>
    </section>

  </main><!--fin main -->


  
  </main>
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
  <script src="../js/alertSweet.js"></script>


  <?php include './footer.php' ?>