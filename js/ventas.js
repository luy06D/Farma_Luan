$(document).ready(function () {


    
    function productos_listar_ventas(filtro) {
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: { 'op': 'productos_listar_ventas', 'filtro': filtro },
            success: function (result) {
                $("#tabla_producto_venta tbody").html(result);
                
   
                $(".editar-product").removeClass("active");
            }
        });
    }
    

    $(document).on("click", ".editar-product", function () {
        // Marca el botón activo con la clase 'active'
        $(this).addClass("active");
    
        // Obtén el idproducto y otros datos de la fila correspondiente
        var idproducto = $(this).data("idproducto");
    
        // Realiza una solicitud AJAX para obtener la información del producto
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'POST',
            data: { 'op': 'productos_listar_id', 'idproducto': idproducto },
            dataType: 'json',  // Asegura que se interprete la respuesta como JSON
            success: function (response) {
                if (response.status) {
                    // Asigna la información del producto a los campos del modal
                    var producto = response.data[0];  // La respuesta es un array, toma el primer elemento
                    $("#idproducto").val(idproducto);
                    $("#Nombreproducto").text(producto.nombreproducto); // Cambiado de .val() a .text()
                    $("#stock").text(producto.stock); // Cambiado de .val() a .text()
    
                    // Muestra el modal
                    $("#modal-agregarP").modal("show");
                } else {
                    console.error(response.message);
                }
            },
        });
    });
    


    $("#buscar-producto").on("input", function () {
        var filtro = $(this).val();
        productos_listar_ventas(filtro);

        var valor = $(this).val();
        if (valor !== "") {
            $("#clear-input").show();
        } else {
            $("#clear-input").hide();
        }
    });


    $("#clear-input").on("click", function () {
        $("#buscar-producto").val(""); // Limpiar 
        productos_listar_ventas(""); 
    });


   function productos_registrar() {
        const idproducto = $("#idproducto").val().trim();
        const cantidad = $("#cantidad").val().trim();

        if (idproducto === '' || cantidad === '' || parseInt(cantidad) <= 0) {
            // Agrega una condición para verificar si la cantidad es mayor que 0
            completeCampos();
        } else {
            // Realiza la solicitud AJAX para obtener la información del producto
            $.ajax({
                url: '../controllers/ventas.controller.php',
                type: 'POST',
                data: { 'op': 'productos_listar_id', 'idproducto': idproducto },
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        var producto = response.data[0];
                        var stockDisponible = producto.stock;

                        // Verifica si hay suficiente stock
                        if (parseInt(stockDisponible) < parseInt(cantidad)) {
                            // Actualizado: Cambiado de stockDisponible === 0 a parseInt(stockDisponible) < parseInt(cantidad)
                            stockInsuficiente();
                        } else {
                            // Continúa con el registro
                            const senData = {
                                'op': 'registrar_producto_lista',
                                'idproducto': $("#idproducto").val(),
                                'cantidad': $("#cantidad").val(),
                            };

                            // Realiza la solicitud AJAX
                            $.ajax({
                                url: '../controllers/ventas.controller.php',
                                type: 'POST',
                                data: senData,
                                success: function (result) {
                                    $("#productos")[0].reset();
                                    $("#modal-agregarP").modal('hide');
                                   
                                    productos_listar_ventas("");
                                    productos_listar();
                                    
                                    $("#guardar").on("click", function () {
                                        $("#buscar-producto").val("");                                   
                                    });

                                    toastFinalizar("Agregado correctamente");
                                }
                            });
                        }
                    } 
                    
                },
            });
        }
    }



    $(document).on("click", ".eliminar-fila", function () {
        var iddetalleventa = $(this).data("iddetalleventa");
        var row = $(this).closest("tr");  // Encuentra la fila actual

        mostrarPreguntaDesactivar().then((result) => {
            if (result.isConfirmed) {
                // Si el usuario confirma, llama a la función para eliminar el producto
                $.ajax({
                    url: '../controllers/ventas.controller.php',
                    type: 'POST',
                    data: { 'op': 'eliminarProducto', 'iddetalleventa': iddetalleventa },
                    dataType: 'json',
                    success: function (result) {
                        if (result.status) {
                            // Elimina la fila de la tabla
                            row.remove();   
                            productos_listar_ventas("");
                            console.log("Producto eliminado correctamente");
                        } else {
                            console.error(result.message);
                        }
                    },
                    error: function (xhr, status, error) {
                        console.error("Error en la solicitud AJAX: " + error);
                    }
                });
            } else {
                // Si el usuario cancela, realiza cualquier otra acción que desees
                console.log("Eliminación cancelada por el usuario");
            }
        });
        
    });
    
    


    function productos_listar(){
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: {'op' : 'lista_productos'},
            success: function (result){
                $("#tabla_producto tbody").html(result);
  
            }
        })
    }

    $("#guardar").click(productos_registrar);

    productos_listar();
    productos_listar_ventas("");
});
