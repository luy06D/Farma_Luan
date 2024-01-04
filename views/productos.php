<?php require_once './cabezera.php' ?>


<!-- DataTable -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">


  <main id="main" class="main">

  <div class="pagetitle">
      <h1>Productos</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./index.php">Inicio</a></li>
          <!-- <li class="breadcrumb-item"></li> -->
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
                  <button class="nav-link active" id="home-tab" data-bs-toggle="tab" data-bs-target="#bordered-home" type="button" role="tab" aria-controls="home" aria-selected="true">Inventario</button>
                </li>
                <!-- <li class="nav-item" role="presentation">
                  <button class="nav-link" id="profile-tab" data-bs-toggle="tab" data-bs-target="#bordered-profile" type="button" role="tab" aria-controls="profile" aria-selected="false">---</button>
                </li>
                
                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="detallec-tab" data-bs-toggle="tab" data-bs-target="#bordered-detallec" type="button" role="tab" aria-controls="tipe" aria-selected="false">----</button>
                </li> -->
                
              </ul>
              <div class="tab-content pt-2" id="borderedTabContent">
                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                  <section class="section mt-3">
                    <div class="row">
                      <div class="col-lg-12">
                        <div class="card">

                          <div class="card-body">
                            <h5 class="card-title">Registrar Producto</h5>
                            <div class="mb-3 row">
                              <div class="col-lg-6 col-12"> 
                                <button type="button" id="abrir-modal-registro" class="btn btn-primary btn-md ml-2 mr-2" data-bs-toggle="modal" data-bs-target="#modal-newProduct">
                                  Nuevo
                                </button>
                                <!-- <button type="button" id="abrir-modal-recuperar" class="btn btn-primary btn-md ml-2 mr-2" data-bs-toggle="modal" data-bs-target="#modal-RecuperarEquipo">
                                  <i class="bi bi-arrow-counterclockwise"></i>Recuperar
                                </button> -->
                              </div>
                            </div>

                            <form class="row g-3">
                              <table id="tabla-producto" class="table table-hover" style="width:100%">
                                <thead class="table-primary">
                                  <tr>
                                    <th>Item</th>
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

                  <!-- Modal Registrar Equipo -->
                  <div class="modal fade" id="modal-newProduct" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-xl" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary" id="modal-header01">
                          <h5 class="modal-title text-white" id="modal-titulo01">Registro de producto</h5> 
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form id="form-productos">
                            <div class="row">
                              <div class="col-lg-4">
                                <label for="ls-categoria" class="col-form-label">Categoria:</label>
                                <div class="col-sm-12">
                                  <select class="form-select" id="ls-categoria">
                                    <option selected>Seleccione</option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-lg-4 mt-2">
                                <label for="nombreProducto" class="col-form-label">Nombre Producto:</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" id="nombreProducto" placeholder="Escriba aquí">
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <label for="precio" class="col-form-label">Precio Unitario:</label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="precio" placeholder="Escriba aquí">
                                </div>
                              </div>
                              <div class="col-lg-4 mt-2">
                                <label for="fechaproduccion" class="col-form-label">Fecha Producción:</label>
                                <div class="col-sm-12">
                                  <input type="date" class="form-control" id="fechaproduccion" >
                                </div>
                              </div>                              
                              <div class="col-lg-4 mt-2">
                                <label for="fechavencimiento" class="col-form-label">Fecha Vencimiento:</label>
                                <div class="col-sm-12">
                                  <input type="date" class="form-control" id="fechavencimiento" >
                                </div>
                              </div>

                              <div class="col-lg-4 mt-2">
                                <label for="numlote" class="col-form-label">N° lote:</label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="numlote" placeholder="Escriba aquí" >
                                </div>
                              </div>

                              <div class="col-lg-4 mt-2">
                                <label for="ls-receta" class="col-form-label">Receta médica:</label>
                                <div class="col-sm-12">
                                  <select class="form-select" id="ls-receta">
                                    <option selected>Seleccione</option>
                                    <option value="No requiere">No requiere</option>
                                    <option value="Requiere">Requiere</option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-lg-8 mt-2">
                                <label for="descripcion" class="col-form-label">Descripción:</label>
                                <div class="col-sm-12">
                                  <textarea type="text" class="form-control" placeholder="Ingrese una descripción (Opcional)" id="descripcion" rows="3"></textarea>
                                </div>
                              </div>

                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" id="guardarProducto">Guardar</button>
                          <button type="reset" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        </div>
                      </div>
                    </div>
                  </div> 
                  

                  <!-- Modal agregar a stock -->
                  <div class="modal fade" id="modal-stock" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary" id="modal-registro-header">
                          <h5 class="modal-title text-white" id="modalTitleId">Agregar a stock</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <form id="form-equipos-md">
                            <div class="row">
                              <div class="col-lg-6" style="display: none;">
                                <label for="item-md" class="col-form-label">Item:</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" id="item-md" readonly>
                                </div>
                              </div>
                              <div class="col-lg-6" style="display: none;">
                                <label for="idusua" class="col-form-label">Usuario:</label>
                                <div class="col-sm-12">
                                  <input type="text" class="form-control" id="idusua" value="<?= $_SESSION['segurity']['idusuario']?>">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <label for="tipocomprobante" class="col-form-label">Tipo Comprobante:</label>
                                <div class="col-sm-12">
                                  <select class="form-select" id="tipocomprobante">
                                    <option >Seleccione</option>
                                    <option value="Boleta">Boleta</option>
                                    <option value="Factura">Factura</option>
                                  </select>
                                </div>
                              </div>

                              <div class="col-lg-4">
                                <label for="ncomprobante-md" class="col-form-label">N° comprobante:</label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="ncomprobante-md" placeholder="digité número">
                                </div>
                              </div>

                              <div class="col-lg-4">
                                <label for="precio-md" class="col-form-label">Precio compra:</label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="precio-md" placeholder="S/.">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <label for="stok-md" class="col-form-label">Cantidad:</label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="stok-md" placeholder="digité cantidad">
                                </div>
                              </div>
                              <div class="col-lg-4">
                                <label for="monto-md" class="col-form-label">Monto total:</label>
                                <div class="col-sm-12">
                                  <input type="number" class="form-control" id="monto-md" readonly>
                                </div>
                              </div>
                            </div>
                          </form>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" id="agregarstockequipo">Agregar</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  
                  
                  <!-- Modal-Recuperar Equipo -->
                  <div class="modal fade" id="modal-RecuperarEquipo" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-md" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary" id="modal-registro-header">
                          <h5 class="modal-title text-white" id="modal-titulo4">Activar equipo</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <!-- Multi Columns Form -->
                          <!-- Horizontal Form -->
                          <form id="form-equipoA">
                            <div class="input-group flex-nowrap mb-2">
                              <span class="input-group-text" id=""><i class="bi bi-search"></i></span>
                              <input type="text" class="form-control" id="buscarequipomd" placeholder="nombre equipo" aria-label="Username" aria-describedby="addon-wrapping" autocomplete="off">
                            </div>   

                            <div class="list-group mt-4" id="resultadoBusqueda"></div>
                            
                          </form><!-- End Horizontal Form -->
                        </div>
                        
                      </div>
                    </div>
                  </div>
                </div>

                <div class="tab-pane fade" id="bordered-profile" role="tabpanel" aria-labelledby="profile-tab">
                  <section class="section mt-3">
        
                    <div class="row"> <!-- row justify-content-center align-items-center --> 
                      <div class="col-lg-12">
                        <div class="card"> <!-- card mx-auto -->
                          <div class="card-body">
                            <h5 class="card-title">Registrar serie</h5>
                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                              <table id="tabla-series" class="table table-hover" style="width:100%">
                                <thead class="table-primary">
                                  <tr>
                                    <th style="display: none;">Item</th>
                                    <th>Equipo</th>
                                    <th>Marca</th>
                                    <th>Modelo</th>
                                    <th>Cantidad</th>
                                    <th>Operación</th>
                                  </tr>
                                </thead>
                                <tbody>
                                </tbody>
                              </table>
                            </form><!-- End Multi Columns Form -->
                          </div>
                        </div>
                      </div>
                    </div>

                    
                    <div class="row"> 
                      <div class="col-lg-12">
                        <div class="card"> 
                          <div class="card-body">
                            <h5 class="card-title">Búsqueda de serie</h5>
                            <!-- Multi Columns Form -->
                            <form class="row g-3">
                              <div class="col-lg-2">
                                <input type="search" id="buscarserie" class="form-control" placeholder="Ingrese el n° serie">
                              </div>
                              <div class="col-lg-10">
                                <div class="resultado-busqueda-container">
                                  <ul id="resultado-item" class="resultado-busqueda" style="display: none;"></ul>
                                  <ul id="resultado-equipo" class="resultado-busqueda"></ul>
                                  <ul id="resultado-marca" class="resultado-busqueda"></ul>
                                  <ul id="resultado-modelo" class="resultado-busqueda"></ul>
                                  <ul id="resultado-numeroserie" class="resultado-busqueda" style="display: none;"></ul>
                                  <ul id="resultado-fechacompra" class="resultado-busqueda"></ul>
                                  <ul id="resultado-estado" class="resultado-busqueda"></ul>
                                </div>
                              </div>
                            </form>
                          </div>
                        </div>
                      </div>
                    </div>

                  </section>

    
                  <!-- Modal agregar series -->
                  <div class="modal fade" id="modalId" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary">
                          <h5 class="modal-title text-white" id="modalTitleId">Agregar serie</h5>
                          <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <div class="form-group">
                            <form action="" id="form-serie">
                              <input type="hidden" id="iddetc">
                            </form>
                          </div>
                          <div class="row mt-2" id="input-container"></div>
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-primary" id="registrarseries">Registrar</button>
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
                      </div>
                    </div>
                  </div>               
                </div>

                <div class="tab-pane fade" id="bordered-detallec" role="tabpanel" aria-labelledby="detallec-tab">
                  <section class="section mt-3">
                    <div class="row"> <!-- row justify-content-center align-items-center --> 
                      <div class="col-lg-12">
                        <div class="card"> <!-- card mx-auto -->
                          <div class="card-body">
                            <h5 class="card-title">Búsqueda por rango de fechas</h5>
                            <form id="form-comprasdetalles">
                              <div class="row g-3">
                                <div class="col-md-4 col-lg-3 mt-2">
                                  <div class="input-group  ">
                                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' ></i></span>
                                    <input type="date" class="form-control" id="fechainiciocomprabuscar" placeholder="Fecha de Compra">
                                  </div>
                                </div>

                                <div class="col-md-4 col-lg-3 mt-2">
                                  <div class="input-group  ">
                                    <span class="input-group-text" id="basic-addon1"><i class='bx bx-calendar' ></i></span>
                                    <input type="date" class="form-control" id="fechafincomprabuscar" placeholder="Fecha de Compra">
                                  </div>
                                </div>

                                <div class="col-md-4 col-lg-3 mt-2">
                                  <button type="button" id="btnBuscarcompra" class="btn btn-primary">Buscar</button> 
                                  <button type="button" id="btnLimpiarcompra" class="btn btn-secondary">Limpiar</button>                     
                                </div>
                              </div>    
                            </form>

                            </div>
                          </div>
                        </div>

                        <div class="col-lg-12">
                          <div class="card"> <!-- card mx-auto -->
                            <div class="card-body">
                              
                              <form class="row g-3">
                                <table id="tablaResultados" class="table table-hover" style="width:100%">
                                  <thead class="table-primary">
                                    <tr>
                                      <th style="display: none;">Item</th>
                                      <th>Fecha Compra</th>
                                      <th>Usuario</th>
                                      <th>Operación</th>
                                    </tr>
                                  </thead>
                                  <tbody>
                                  </tbody>
                                </table>
                              </form>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                  </section>

                  
                  <!-- Modal Body -->
                  <div class="modal fade" id="compraDetallE" tabindex="-1" data-bs-backdrop="static" data-bs-keyboard="false" role="dialog" aria-labelledby="modalTitleId" aria-hidden="true">
                    <div class="modal-dialog modal-dialog-scrollable modal-dialog-centered modal-lg" role="document">
                      <div class="modal-content">
                        <div class="modal-header bg-primary">
                          <h5 class="modal-title text-white" id="modalTitleId">Detalles compras</h5>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                          <table class="table table-bordered border-primary" id="table-detalleC">
                            <thead>
                              <tr>
                                <th scope="col">Equipo</th>
                                <th scope="col">Marca</th>                                                                          
                                <th scope="col">Modelo</th>
                                <th scope="col">Cantidad</th>
                                <th scope="col">Precio</th>                                                                          
                                <th scope="col">Importe</th>
                              </tr>
                            </thead>
                            <tbody>                                                                 
                
                            </tbody>
                          </table>             
                        </div>
                        <div class="modal-footer">
                          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cerrar</button>
                        </div>
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
  <script src="../js/productos.js"></script>
  



  <?php include './footer.php' ?>