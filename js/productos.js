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
                    pageLength: 10, 
                    lengthChange: false,
                    order: [[0, 'desc']],
            

                })
                
            }
        })
    }

    function  get_categorias(){

        const lsCategorias = document.querySelector("#ls-categoria");
        const parameters = new URLSearchParams();
        parameters.append("op", "getCategorias");
    
        fetch("../controllers/productos.controller.php", {
          method: 'POST',
          body: parameters
        })
        .then(response => response.json())
        .then(data => {
          lsCategorias.innerHTML = "<option value=''>Seleccione</option>";
          data.forEach(element => {
            const optionTag = document.createElement("option");
            optionTag.value = element.idcategoria
            optionTag.text = element.nombrecategoria;
            lsCategorias.appendChild(optionTag);
            
          });
        });
      }
    

    

    // REGISTRAR PRODUCTOS
    function productos_registrar(){
        const idcategoria   = $("#ls-categoria").val().trim();
        const producto      = $("#nombreProducto").val().trim();
        const precio        = $("#precio").val().trim();
        const fechaproducc  = $("#fechaproduccion").val().trim();
        const fechavencim   = $("#fechavencimiento").val().trim();
        const numlote       = $("#numlote").val().trim();
        const receta        = $("#ls-receta").val().trim();        

        let sendData = {
            'op'                : 'registrar_producto',
            'idcategoria'       : $("#ls-categoria").val(),
            'nombreproducto'    : $("#nombreProducto").val(),
            'descripcion'       : $("#descripcion").val(),
            'precio'            : $("#precio").val(),
            'fechaproduccion'   : $("#fechaproduccion").val(),
            'fechavencimiento'  : $("#fechavencimiento").val(),
            'numlote'           : $("#numlote").val(),
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
                if(idcategoria === '' || producto === '' || precio === '' || 
                    fechaproducc === '' || fechavencim === '' || numlote === '' ||
                    receta === ''){
                        completeCampos();
                    }else{
                        toastFinalizar("Operación exitosa");
                        $.ajax({
                            url: '../controllers/productos.controller.php',
                            type: 'POST',
                            data: sendData,
                            success: function(result){
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
    
                $("#ls-categoria").val(result.idcategoria);
                $("#nombreProducto").val(result.nombreproducto);
                $("#descripcion").val(result.descripcion);
                $("#precio").val(result.precio);
                $("#fechaproduccion").val(result.fechaproduccion);
                $("#fechavencimiento").val(result.fechavencimiento);
                $("#numlote").val(result.numlote);
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
        dataNew =true;

    }


    // Generar un reporte PDF del Inventario
    function createPDF(){
        window.open(`../reports/inventario.report.php`, `_blank`);
    }

    // Ontener el idproducto de la lista
    $("#tabla-producto tbody").on("click", ".editar-product", function (){
        idproducto = $(this).data("idproducto");
        obtenerProducto(idproducto);
    })
    
    $("#abrir-modal-registro").click(abriModalRegistro);
    $("#guardarProducto").click(productos_registrar);
    $("#reporte-inventario").click(createPDF);


    productos_listar();
    get_categorias();
})