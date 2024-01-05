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
                    $("#Nombreproducto").val(producto.nombreproducto); // Ajusta la propiedad según tus datos reales
                    $("#stock").val(producto.stock); // Ajusta la propiedad según tus datos reales
    
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


    function productos_listar(){
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: {'op' : 'lista_productos'},
            success: function (result){
                $("#tabla_producto tbody").html(result);
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

    $("#guardar").click(productos_registrar);

    productos_listar();
    productos_listar_ventas("");
});
