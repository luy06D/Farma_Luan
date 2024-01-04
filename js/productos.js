$(document).ready(function(){

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
                    searching: false

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

        senData = {
            'op'                : 'registrar_producto',
            'idcategoria'       : $("#ls-categoria").val(),
            'nombreproducto'    : $("#nombreProducto").val(),
            'descripcion'       : $("#descripcion").val(),
            'precio'            : $("#precio").val(),
            'fechaproduccion'   : $("#fechaproduccion").val(),
            'fechavencimiento'  : $("#fechavencimiento").val(),
            'numlote'           : $("#numlote").val(),
            'recetamedica'      : $("#ls-receta").val(),            
        }

        mostrarPregunta('Productos', '¿Está seguro de realizar la operación?')
        .then((result) => {
            if(result.isConfirmed){
                if(idcategoria === '' || producto === '' || precio === '' || 
                    fechaproducc === '' || fechavencim === '' || numlote === '' ||
                    receta === ''){
                        completeCampos();
                    }else{
                        toastFinalizar("Registrado correctamente");
                        $.ajax({
                            url: '../controllers/productos.controller.php',
                            type: 'POST',
                            data: senData,
                            success: function(result){
                                $("#form-productos")[0].reset();
                                $("#modal-newProduct").modal('hide');
                                productos_listar();
                            }
                        })
                    }
            }
        })

        
    }

    $("#guardarProducto").click(productos_registrar);


    productos_listar();
    get_categorias();
})