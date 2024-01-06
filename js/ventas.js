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
    

    $(document).on("click", ".eliminar-product", function () {

        if (confirm("¿Estás seguro de que quieres eliminar este producto?")) {
            // Realiza una solicitud AJAX para eliminar el producto
            $.ajax({
                url: '../controllers/ventas.controller.php',
                type: 'POST',
                data: { 'op': 'eliminarProducto', 'iddetalleventa': iddetalleventa },
                dataType: 'json',
                success: function (result) {

                    if (result.status) {

                        console.log("Producto eliminado correctamente");
                    } else {

                        console.error(result.message);
                    }
                },
                error: function (xhr, status, error) {
                    // Maneja errores de la solicitud AJAX
                    console.error("Error en la solicitud AJAX: " + error);
                }
            });
        }
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
    
        if (idproducto === '' || cantidad === '') {
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
                        if (stockDisponible === 1 || cantidad > stockDisponible) {
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
                                    productos_listar();
                                    productos_listar_ventas("");
                                    toastFinalizar("Registrado correctamente");
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
        
        if (confirm("¿Estás seguro de que quieres eliminar este producto?")) {
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
        }
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
