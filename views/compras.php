<?php require_once './cabezera.php' ?>


<!-- DataTable -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">


  <main id="main" class="main">

    <div class="pagetitle">
      <h1>Ingresos Almacén</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
          <!-- <li class="breadcrumb-item"></li> -->
          <li class="breadcrumb-item active"><a href="./compras.php">Compras</a></li>
        </ol>
      </nav>
    </div><!-- End Page Title -->

    <div class="card">
            <div class="card-body mt-4">
              <!-- <h5 class="card-title">Bor</h5> -->

              <!-- Borde -->
              <ul class="nav nav-tabs nav-tabs-bordered" id="borderedTab" role="tablist">
                <li class="nav-item" role="presentation">
                  <button class="nav-link active" id="tab-cotizacion" data-bs-toggle="tab" data-bs-target="#bordered-cotizacion" type="button" role="tab" aria-controls="coti" aria-selected="false">Compra</button>
                <!-- </li>
                <li class="nav-item" role="presentation">
                  <button class="nav-link " id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Contratos</button>
                </li> -->
                <!-- <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">Filtro</button>
                </li>               -->
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">   

                <div class="tab-pane fade show active" id="bordered-cotizacion" role="tabpanel" aria-labelledby="tab-cotizacion">
                  <!-- INICIO CONTENIDO COTIZACIÓN  -->
                  <div class="">                    
                    <section class="section">
                            <div class="row">
                                <div class="col-lg-12  col-sm-12"> <!-- Primera columna -->
                                    <div class="card">
                                        <div class="card-body">
                                            <h5 class="card-title">Registro de compras</h5>
                                            <!-- Formulario para realizar la cotización -->
                                            <form class="row g-4" id="form-compra">
                                                <!-- Contenido del formulario -->                                              

                                                <div class="col-md-4">
                                                  <label for="lsTipoComprobante" class="form-label">Tipo Comprobante:</label>
                                                  <select id="lsTipoComprobante" class="form-select">
                                                    <option>Seleccione</option>
                                                    <option value="boleta">Boleta</option>
                                                    <option value="factura">factura</option>
                                                    
                                                  </select>
                                                </div> 

                                                <div class="col-md-4">
                                                    <label for="numfactura" class="form-label">N° Factura:</label>
                                                    <input type="number"  class="form-control" id="numfactura" placeholder="Escriba aqui">
                                                </div>                                                                                   
                                       
                                                <div class="col-md-4  mb-4">
                                                  <label for="numlote" class="form-label">N° Lote:</label>
                                                  <input type="number" class="form-control" id="numlote" placeholder="Escriba aqui" >
                                                </div>

                                                <div class="col-md-4  mb-4">
                                                  <label for="idusuario" class="form-label">usuario:</label>
                                                  <input type="number" class="form-control" id="idusuario" placeholder="Escriba aqui" >
                                                </div>

                                                <div>
                                                    <button type="button" id="btnAgregarP" class="btn btn-success shadow-lg mb-3 mt-3"  data-bs-toggle='modal' data-bs-target='#modal-productoB'>Buscar Productos  <i class="bi bi-search"></i></button>                                                                
                                                </div>

                                                <section class="section mb-3 mt-4">
                                                        <div class="row">                                                  
                                                          <!-- Default Table -->
                                                          <div class="col-lg-12">
                                                              <table class="table" id="table-compras">
                                                                      <thead class="table-success">
                                                                        <tr>
                                                                        <th style="display: none;" scope="col">item</th>
                                                                          <th scope="col">Producto</th>
                                                                          <th scope="col">Cantidad de ingreso</th>                                                                                                                       
                                                                          <th scope="col">Precio de compra/Unidad</th>                                                                          
                                                                          <th scope="col">Quitar</th>
                                                                        </tr>
                                                                      </thead>
                                                                      <tbody id="tbody-productoCompra">                                                                 
                                                            
                                                                      </tbody>
                                                              </table>       
                                                              
                                                          </div>                                                                                           
                                                        </div>
                                                 
                                                </section>  
                                                <div>
                                                    <button type="button" id="btn-registrarC" class="btn btn-success shadow-lg mb-3 mt-3" >Registrar compra</button>                                                                
                                                    <button type="button" id="prueba" class="btn btn-success shadow-lg mb-3 mt-3" >prueba</button>                                                                
                                                </div>                                                                                                                                                                                                                                                                                                                                                                                                                                                                               
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                            
                            </div>                       
                              
                    </section>            
                  </div>                  
                  <!-- FIN DE COTIZACION  -->
                </div>

                <div class="tab-pane fade" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">

                </div>

                
              </div><!-- FIN DEL TABS -->

            </div>
    </div>

    <section>
    <!-- Modal buscar equipos de contrato -->        
    <div class="modal fade" id="modal-productoB" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
        <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
            <div class="modal-content">
                <div class="modal-header" id="" >
                    <h5 class="modal-title card-title" id="">Buscar Producto</h5>
                </div>
                <div class="modal-body">
                <div class="input-group flex-nowrap mb-2">
                  <span class="input-group-text" id=""><i class="bi bi-search"></i></span>
                  <input type="text" class="form-control" id="b-producto" placeholder="Buscar aqui......." aria-label="Username" aria-describedby="addon-wrapping" autocomplete="off">
                </div>
                <div class="list-group mt-4" id="producto_buscado">

                </div>          
                <div class="modal-footer">           
                    
                    <button type="button" class="btn btn-danger shadow-lg" data-bs-dismiss="modal">Cerrar</button>
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
  <script src="../js/compras.js"></script>




  <?php include './footer.php' ?>