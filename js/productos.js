$(document).ready(function(){

    let dataNew = true;
    let idproducto = 0;



    // LISTAR PRODUCTOS
    function productos_listar(){
        $.ajax({
            url: '../controllers/productos.controller.php',
            type: 'GET',
            data: {'op' : 'productos_listar'},
            success: function (result){
                var table = $("#tabla-producto").DataTable();
                table.destroy();
                $("#tabla-producto tbody").html(result);
                $("#tabla-producto").DataTable({
                    language:{
                        url: '../js/Spanish.json'
                    },
                    responsive: true,
                    pageLength: 8, 
                    lengthChange: false,
                    order: [[0, 'desc']],
                    columnDefs:[
                        {
                            targets: [0],
                            visible: false,
                        },
                        {
                            responsivePriority: 1,
                            targets: [7],
                            render: function (data, type, row){
                                if(type === 'display'){
                                    if(data === "Agotado"){
                                        return '<span class="badge bg-danger text-white">Agotado</span>';  
                                }else{
                                    return '<span class="badge bg-success text-white">Disponible</span>';  
                                }
                                }
                                return data
                            }
                        }
                    ]
            

                })
                
            }
        })
    }


      function  get_unidades(){

        const lsUnidades = document.querySelector("#ls-unidades");
        const parameters = new URLSearchParams();
        parameters.append("op", "getUnidades");
    
        fetch("../controllers/productos.controller.php", {
          method: 'POST',
          body: parameters
        })
        .then(response => response.json())
        .then(data => {
          lsUnidades.innerHTML = "<option value=''>Seleccione</option>";
          data.forEach(element => {
            const optionTag = document.createElement("option");
            optionTag.value = element.idunidad
            optionTag.text = element.unidadmedida;
            lsUnidades.appendChild(optionTag);
            
          });
        });
      }
    

    

    // REGISTRAR PRODUCTOS
    function productos_registrar(){
        const idunidad      = $("#ls-unidades").val().trim();
        const producto      = $("#nombreProducto").val().trim();
        const categoria      = $("#nombreCategoria").val().trim();
        const unidades     = $("#ls-unidades").val().trim();
        const precio        = $("#precio_unidad").val().trim();
        const receta        = $("#ls-receta").val().trim();        

        let sendData = {
            'op'                : 'registrar_producto',
            'idunidad'          : $("#ls-unidades").val(),
            'nombreproducto'    : $("#nombreProducto").val(),
            'nombrecategoria'    : $("#nombreCategoria").val(),
            'descripcion'       : $("#descripcion").val(),
            'stock'             : $("#stock").val(),
            'precio_unidad'     : $("#precio_unidad").val(),
            'precio_blister'    : $("#precio_blister").val(),
            'precio_caja'       : $("#precio_caja").val(),
            'fechaproduccion'   : $("#fechaproduccion").val(),
            'fechavencimiento'  : $("#fechavencimiento").val(),            
            'recetamedica'      : $("#ls-receta").val(),            
        };

        // Operacion para actualizar
        if(!dataNew){
            sendData['op'] = 'actualizar_producto';
            sendData['idproducto'] = idproducto;
        }

        mostrarPregunta('Productos', '¿Está seguro de realizar la operación?')
        .then((result) => {
            if(result.isConfirmed){
                if(idunidad === '' || producto === '' || precio === '' || 
                   receta === '' || categoria === '' || unidades === ''){
                        completeCampos();
                    }else{
                        toastFinalizar("Operación exitosa");
                        $.ajax({
                            url: '../controllers/productos.controller.php',
                            type: 'POST',
                            data: sendData,
                            success: function(result){
                                console.log(result)
                                $("#form-productos")[0].reset();
                                $("#modal-newProduct").modal('hide');
                                dataNew = true;
                                idproducto = 0;
                                productos_listar();
                            }
                        })
                    }
            }
        })

        
    }

    function obtenerProducto(id){
        $.ajax({
            url: '../controllers/productos.controller.php',
            type: 'GET',
            data: {
                'op' : 'get_productos',
                'idproducto' : id
            },
            dataType: 'JSON',
            success: function (result){
    
                $("#ls-unidades").val(result.idunidad);
                $("#nombreProducto").val(result.nombreproducto);
                $("#nombreCategoria").val(result.nombrecategoria);
                $("#descripcion").val(result.descripcion);
                $("#stock").val(result.stock);
                $("#precio_unidad").val(result.precio_unidad);
                $("#precio_blister").val(result.precio_blister);
                $("#precio_caja").val(result.precio_caja);
                $("#fechaproduccion").val(result.fechaproduccion);
                $("#fechavencimiento").val(result.fechavencimiento);                
                $("#ls-receta").val(result.recetamedica);
            }
        });

        $("#modal-titulo01").html("Actualizar equipo"); 
        $("#modal-titulo01").removeClass("text-white"); 
        $("#modal-titulo01").addClass("text-black");               
        $("#modal-header01").removeClass("bg-primary");
        $("#modal-header01").addClass("bg-warning");
        $("#guardarProducto").addClass("btn btn-warning");
        $("#guardarProducto").html("Actualizar");

        dataNew = false;
        $("#modal-newProduct").modal("show");
        $("#stock").prop("disabled", true);


    }


    function abriModalRegistro(){

        $("#modal-titulo01").html("Registro de producto");
        $("#modal-titulo01").addClass("text-white");
        $("#modal-header01").removeClass("bg-warning");
        $("#modal-header01").addClass("bg-primary");
        $("#guardarProducto").html("Guardar");
        $("#guardarProducto").removeClass("btn btn-warning");
        $("#guardarProducto").addClass("btn btn-primary");
        $("#form-productos")[0].reset();
        $("#stock").prop("disabled", false );
        dataNew =true;


    }


    // Generar un reporte PDF del Inventario
    function createPDF(){
        window.open(`../reports/inventario.report.php`, `_blank`);
    }

    // Obtener el idproducto de la lista
    $("#tabla-producto tbody").on("click", ".editar-product", function (){
        idproducto = $(this).data("idproducto");
        obtenerProducto(idproducto);
    })

      // Obtener el idproducto de la lista para compras
      $("#tabla-producto tbody").on("click", ".compras", function (){
        idproducto = $(this).data("idproducto");
        $("#modal-stock").modal("show");
    })
    
    $("#abrir-modal-registro").click(abriModalRegistro);
    $("#guardarProducto").click(productos_registrar);
    $("#reporte-inventario").click(createPDF);


    productos_listar();
    get_unidades();
})