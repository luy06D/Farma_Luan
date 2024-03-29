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


    #stock {
        white-space: nowrap; 
        overflow: hidden; 
        text-overflow: ellipsis; 
        max-width: 100%;
    }


    #tabla_producto_venta {
        max-height: 100px; /* Puedes ajustar la altura máxima según tus necesidades */
        overflow-y: auto;
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

                <li class="nav-item" role="presentation">
                  <button class="nav-link" id="home-tab" data-bs-toggle="tab" data-bs-target="#venta-pago" type="button" role="tab" aria-controls="home" aria-selected="true">Lista y Pago de la venta</button>
                </li>
              </ul>

              <div class="tab-content pt-2" id="borderedTabContent">

                <div class="tab-pane fade show active" id="bordered-home" role="tabpanel" aria-labelledby="home-tab">
                 <section class="section mt-3">


                  <div class="row">
                    <div class="col-lg-12">
                      <div class="card ">
                          <div class="card-body">
                          
                                  <div class="card border-success mt-2" style="max-width: 18rem;">
                                    <button type="button" class="btn btn-outline-success me-2" data-bs-toggle="modal" data-bs-target="#IniciarVenta">
                                        Iniciar Venta
                                    </button>
                                    <div class="card-body text-success">
                                      <h5 class="card-title">Venta iniciada por</h5>
                                      <p class="card-title text-center " id="Iusuario">.....</p>
                                    </div>
                                  </div>

                              
                              <h5 class="card-title text-center" >Realizar Venta</h5>

                              <div class="form-floating col-md-4 mx-auto position-relative">
                                        <input type="text" id="buscar-producto" class="form-control nota-practica text-center" placeholder="" min="0" max="20">
                                        <span id="clear-input" class="clear-icon">&#10006;</span>
                                        <label for="floatingInput">Buscar</label>                     
                              </div>

                              <form class="row g-3 mt-1">
                              <table id="tabla_producto_venta" class="table table-hover" style="width:100%">
                                <thead class="table-danger">
                                  <tr>
                                    <th style="display: none;">Item</th>
                                    <th></th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                    <th>Precio Unidad</th>
                                    <th>Uni Blister</th>
                                    <th>Precio blister</th>
                                    <th>Uni Caja</th>
                                    <th>Precio Caja</th>
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

                          <div class="card-body">

                              <h5 class="card-title text-center" >Medicamentos de Marca</h5>

                              <form class="row g-3 mt-1">
                              <table id="tabla_producto_marca" class="table table-hover" style="width:100%">
                                <thead class="table-danger">
                                  <tr>
                                    <th style="display: none;">Item</th>
                                    <th></th>
                                    <th>Producto</th>
                                    <th>Categoria</th>
                                    <th>Stock</th>
                                    <th>Precio Unidad</th>
                                    <th>Uni Blister</th>
                                    <th>Precio blister</th>
                                    <th>Uni Caja</th>
                                    <th>Precio Caja</th>
                                    <th>Fecha Vencimiento</th>
                                    <th>Receta Médica</th>                                    
                                    <th>Operación</th>s
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

                  <!-- Modal iniciar venta-->
                 

                 <!-- Modal listar producto-->
                 <div id="modal-agregarP" class="modal fade" tabindex="-1" aria-hidden="true" style="overflow-y: scroll; display: none;">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content" style="border-radius: 10px; background-color: white;">

                            <div class="modal-body">
                                <form id="productos">

                                    <div class="card" id="modal-header01" style="width: 250px; margin: 0 auto;">
                                        <div class="card-header">
                                            <h5 class="modal-title text-secondary" id="modal-titulo01">Listar producto</h5>
                                        </div>
                                        <div class="card-footer text">
                                            <h5 class="card-title text-center" id="Nombreproducto"></h5>

                                            <div class="text-center">
                                              <span class="card-text">Stock:</span>
                                              <span id="stock" ></span>
                                            </div>
                                        

                                            <div class="row justify-content-center">
                                                <div class="col-md-8 mt-4">
                                                  <select id="unidad" class="form-select " aria-label="Default select example">
                                                    <option value="unidad">Unidad</option>
                                                    <option value="blister">Blister</option>
                                                    <option value="caja">Caja</option>
                                                  </select>

                                                  <input type="number" class="form-control mt-2" id="cantidad" placeholder="Cantidad">
                                                </div>

                                                
                                            </div>
                                        </div>

                                        <div class="card-footer text-muted">
                                            <button type="button" class="btn btn-success" id="guardar">Agregar</button>
                                            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"  id="cancelar">Cancelar</button>
                                        </div>
                                    </div>

                                    <input type="text" class="form-control" id="idproducto">

                                </form>
                            </div>
                        </div>
                    </div>
                </div>


                <div id="IniciarVenta" class="modal fade" tabindex="-1" aria-hidden="true" style="overflow-y: scroll; display: none;">
                    <div class="modal-dialog modal-sm modal-dialog-centered" role="document">
                        <div class="modal-content" style="border-radius: 10px; background-color: white;">

                            <div class="modal-body">
                                <form id="venta">                                                                 

                                    <div class="card text-center" id="modal-header01" style="width: 250px; margin: 0 auto;">

                                    <div class="card-header">
                                      <h5 class="modal-title text-secondary" id="modal-titulo01">Seleccionar Usuario</h5>
                                    </div>

                                    <div class="row justify-content-center">
                                      <div class="col-md-8">
                                        <select id="usuario" class="form-select mt-5" aria-label="Default select example">
                                          <option selected>Seleccione</option>
                                        </select>
                                        
                                      </div>
                                    </div>
                                                
                                    

                                    <div class="card-footer text-muted mt-5">
                                            <button type="button" class="btn btn-success" id="iniciarV">Iniciar</button>
                                            <button type="reset" class="btn btn-danger" data-bs-dismiss="modal"  id="">Cancelar</button>
                                        </div>
                                    </div>

                                </form>
                            </div>

                        </div>
                    </div>
                </div>

              </div>


              <div class="tab-pane fade show" id="venta-pago" role="tabpanel" aria-labelledby="home-tab">
                 <section class="section mt-3">

                 <div class="row">
                      <div class="col-lg-12">
                      <div class="card ">
                            <div class="card-body">
                                <h5 class="card-title text-center">Lista de Medicamento/productos agregados</h5>

                                <form class="row g-3">
                                <table id="tabla_producto" class="table table-striped table-hover responsive nowrap" style="width:100%">
                                  <thead class="table-danger">
                                    <tr>
                                      <th style="display: none;">Item</th>
                                      <th></th>
                                      <th>Producto</th>
                                      <th>Usuario</th>
                                      <th>Cantidad</th>
                                      <th>Unidad/blister</th>
                                      <th>precioTotal</th>
                                      <th>Operaciónes</th>
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
                      <div class="col-lg-16">
                        <div class="card">
                          <div class="card-body">
                            <h5 class="card-title text-center">Pago de la venta</h5>

                            <div class="row">
                              <div class="col-md-3">
                                <span class="text">Tipo de pago</span>
                                <select class="form-select mt-2" aria-label="Default select example">
                                  <option selected>Seleccionar</option>
                                  <option value="Efectivo">Efectivo</option>
                                  <option value="Yape">Yape</option>
                                  <option value="Plin">Plin</option>
                                </select>
                              </div>

                              <div class="col-md-4">
                                <span class="text">Monto total</span>
                                <div class="input-group mt-2">
                                  <span class="input-group-text">s/</span>
                                  <input type="number" class="form-control" id="monto_total" disabled>
                                </div>
                              </div>

                              <div class="col-md-3">
                                <span class="text">Pago</span>
                                <div class="input-group mt-2">
                                  <span class="input-group-text">s/</span>
                                  <input type="number" class="form-control" id="pago" >
                                </div>
                              </div>

                              <div class="col-md-2">
                                <span class="text">Vuelto</span>
                                <div class="input-group mt-2">
                                  <span class="input-group-text" >s/</span>
                                  <input type="number" class="form-control" id="vuelto" placeholder="...." disabled>
                                </div>
                              </div>               

                            </div>

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