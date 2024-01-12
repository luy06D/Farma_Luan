<?php require_once './cabezera.php'?>
<?php


    if (isset($_SESSION['segurity']) && $_SESSION['segurity']['status']){
        header('Location: /index.php');
    }
?>


<!-- DataTable -->
<link href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.2.0/css/bootstrap.min.css">
<link href="https://cdn.datatables.net/1.13.1/css/dataTables.bootstrap5.min.css" rel="stylesheet">

<link href="https://cdn.datatables.net/1.13.6/css/jquery.dataTables.min.css" rel="stylesheet">
<link href="https://cdn.datatables.net/responsive/2.5.0/css/responsive.dataTables.min.css" rel="stylesheet">


  <main id="main" class="main">


    <div class="pagetitle">
      <h1>Inicio</h1>
      <nav>
        <ol class="breadcrumb">
          <li class="breadcrumb-item"><a href="./contratos.php">Contratos</a></li>
          <li class="breadcrumb-item active">Inicio</li>
        </ol>
      </nav>
    </div><!--  -->

    <section class="section dashboard">
      <div class="row">

        <div class="col-lg-12">
          <div class="row">

            <!-- Ingreso de ventas diario -->
            <!-- <div class="col-xxl-4 col-md-6">
              <div class="card info-card ventasdiario-card">

                <div class="card-body">
                  <h5 class="card-title">Ingreso ventas<span>| Día</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cash"></i>
                    </div>
                    <div class="ps-3" id="montototalventadia">
                      <div></div>
                    </div>
                  </div>
                </div>

              </div>
            </div> -->
            <!-- fin -->

            <!-- Cantidad de ventas por día -->
            <!-- <div class="col-xxl-4 col-md-6">
              <div class="card info-card cantidadventa-card">

                <div class="card-body">
                  <h5 class="card-title">Cantidad venta<span>| Día</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart-check"></i>
                    </div>
                    <div class="ps-3" id="cantidad_ventas">
                      <div></div>
                    </div>
                  </div>
                </div>

              </div>
            </div> -->
            <!-- fin -->
            
            <!-- Equipos mas vendidos por año -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card product-card">

                <div class="card-body">
                  <h5 class="card-title">Lo más vendido <span>| Año</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-box-seam"></i>
                    </div>
                    <div class="ps-3" id="equipos_vendidos">
                      <div></div>
                    </div>
                  </div>
                </div>

              </div>
            </div><!-- fin -->

            <!-- Cliente con mas contratos realizados -->
            <div class="col-xxl-4 col-md-6">

              <div class="card info-card customers-card">

                <div class="card-body">
                  <h5 class="card-title">Clientes <span>| Año</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-people"></i>
                    </div>
                    <div class="ps-3" id="solicitado">
                      <div>
                        
                      </div>
                      <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->

                    </div>
                  </div>

                </div>
              </div>

            </div>

            <!-- Card servicio mas solicitado  -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card customers-card-service">
                <div class="card-body">
                  <h5 class="card-title">Servicio <span>| Año</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-clipboard2-check-fill"></i>
                    </div>
                    <div class="ps-3" id="servicio_solicitado">
                      <div>
                        
                      </div>
                      <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->

                    </div>
                  </div>

                </div>
              </div>
            </div> <!-- fin -->

            <!-- Ganancias de las ventas equipos -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">

                <div class="card-body">
                  <h5 class="card-title">Ingresos ventas<span>| Mes</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-piggy-bank"></i>
                    </div>
                    <div class="ps-3" id="ganancias">
                      <!-- <h6>S/28.000</h6> -->
                      <div></div>
                      <!-- <span class="text-success small pt-1 fw-bold">8%</span> <span class="text-muted small pt-2 ps-1">increase</span> -->

                    </div>
                  </div>
                </div>

              </div>
            </div><!-- fin -->
            

            <!-- Gastos de compras en equipos -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card sales-card">

                <div class="card-body">
                  <h5 class="card-title">Egresos <span>| Mes</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-wallet2"></i>
                    </div>
                    <div class="ps-3" id="egresosmonto">
                      <div></div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Ingresos de servicios -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card revenue-card">
                <div class="card-body">
                  <h5 class="card-title">Ingresos servicios <span>| Mes</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                    <i class="bi bi-currency-dollar"></i>
                    </div>
                    <div class="ps-3" id="ganancia_servicios">
                      <div>
                        
                      </div>
                      <!-- <span class="text-danger small pt-1 fw-bold">12%</span> <span class="text-muted small pt-2 ps-1">decrease</span> -->

                    </div>
                  </div>

                </div>
              </div>
            </div>

            <div class="col-xxl-4 col-md-6">
              <div class="card info-card inicio-card">

                <div class="card-body">
                  <h5 class="card-title">Servicios por iniciar<span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-hourglass"></i>
                    </div>
                    <div class="ps-3" id="noiniciado_serivicos">
                      <div></div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
        
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card proceso-card">

                <div class="card-body">
                  <h5 class="card-title">Servicios en proceso<span></span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-hourglass-split"></i>
                    </div>
                    <div class="ps-3" id="procesos_serivicos">
                      <div></div>
                    </div>
                  </div>
                </div>

              </div>
            </div>

            <!-- Cantidad total de ventas por mes -->
            <div class="col-xxl-4 col-md-6">
              <div class="card info-card cantidadventamensual-card">

                <div class="card-body">
                  <h5 class="card-title">Cantidad venta   <span>| Mes</span></h5>

                  <div class="d-flex align-items-center">
                    <div class="card-icon rounded-circle d-flex align-items-center justify-content-center">
                      <i class="bi bi-cart-check"></i>
                    </div>
                    <div class="ps-3" id="cantidad_ventas_mes">
                      <div></div>
                    </div>
                  </div>
                </div>

              </div>
            </div>
            <!-- fin -->

            
          </div>


          <div class="col-lg-12">
            <div class="row"> 

            <!-- Grafico de los 5 clientes que mas contratos tienen -->
              <div class="col-lg-8">
                <div class="card">
  
                  <div class="card-body">
                    <h5 class="card-title">Clientes que mas contratos realizan <span>| Este año</span></h5>
                    <canvas id="grafico-clienteC"></canvas>

                  </div>
  
                </div>
              </div>

              <!-- Equipos por agotarse-->
              <div class="col-lg-4">
                <div class="card top-selling overflow-auto">
                  <div class="card-body pb-0">
                    <h5 class="card-title">Equipos por agotarse</h5>
                    <canvas id="grafico1"></canvas>
                    <ul id="lista-leyenda1"></ul>
                  </div>
                </div>
                <!-- fin -->
              </div> 
              
              <!-- Graficos de ingresos-->
              <div class="col-lg-6">
                <div class="card top-selling overflow-auto">

                  <div class="card-body pb-0">
                    <h5 class="card-title">Gráfico de Ingresos<span>| Meses</span></h5>
                    <!-- <h5 class="card-title">Top Selling <span>| Today</span></h5> -->
                    <canvas id="grafico2"></canvas>
                    <ul id="lista-leyenda2"></ul>
  
                  </div>
                </div>
              </div> <!-- fin-->

              <!-- Graficos de egresos-->
              <div class="col-lg-6">
              
                <div class="card">
                  <div class="card-body pb-0">
                    <h5 class="card-title">Gráfico de Egresos<span>| Meses</span></h5>
                      <canvas id="grafico3"></canvas>
                      <ul id="lista-leyenda3"></ul>
    
                  </div>
                </div>
              </div>
            </div>   
          </div>   <!-- fin -->

        </div><!-- fin -->

        <!-- Graficos de ganacias de servicios -->
        <div class="col-lg-6">

        <div class="card">
          <div class="card-body pb-0">
            <h5 class="card-title">Ganancias de Servicios<span>| Meses</span></h5>
              <canvas id="G-Servicios"></canvas>
              <ul id="L-Servicios"></ul>
          </div>
        </div>
              
        </div><!-- fin -->
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




  <?php include './footer.php' ?>