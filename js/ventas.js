$(document).ready(function () {

    var ventaIniciada = false;

    function cargarUsuarios() {
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: { 'op': 'lista_usuario' },
            success: function (result) {
                $("#usuario").html(result);

                if (ventaIniciada) {
                    $("#buscar-producto, #clear-input, #guardar").prop("disabled", false);
                } else {
                    $("#buscar-producto, #clear-input, #guardar").prop("disabled", true);
                }
            }
        });
    }


    function Registrar_venta(nomusuario) {
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'POST',
            data: { 'op': 'registrar_venta', 'nomusuario': nomusuario},
            success: function () {
                ventaIniciada = true;

                // Desactivar o activar input y botones según el estado de la venta
                $("#buscar-producto, #clear-input, #guardar").prop("disabled", false);
            }
        });
    }


    $("#iniciarV").on("click", function () {
        // Obtener el valor seleccionado del select de usuarios
        var nomusuario = $("#usuario option:selected").text();

        // Verificar si se seleccionó un usuario
        if (nomusuario !== 'Seleccione') {
            $("#Iusuario").text(nomusuario);
            Registrar_venta(nomusuario);
            toastFinalizar("Venta Iniciada");
            $("#IniciarVenta").modal("hide");
        } else {
            // Mostrar un mensaje de error o realizar alguna acción
            console.log("Por favor, seleccione un usuario.");
        }
    });



    function productos_listar_ventas(filtro) {
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: { 'op': 'productos_listar_ventas', 'filtro': filtro },
            success: function (result) {
                $("#tabla_producto_venta tbody").html(result);

                dataTable.clear().rows.add($("#tabla_producto_venta tbody tr")).draw();
                calcularMontoTotal();
                calcularVuelto();
                $(".editar-product").removeClass("active");
            }
        });
    }

    function productos_listar_por_categoria(categoria) {
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: { 'op': 'productos_listar_categoria', 'categoria': categoria },
            success: function (result) {
                $("#tabla_producto_marca tbody").html(result);
                dataTableMarca.clear().rows.add($("#tabla_producto_marca tbody tr")).draw();
            }
        });
    }
    

    var dataTable = $("#tabla_producto_venta").DataTable({
        language: {
            url: '../js/Spanish.json'
        },
        responsive: true,
        pageLength: 3,
        lengthChange: false,
        searching: false,
        columnDefs: [
            {
                targets: [0, 3],
                visible: false,
            }
        ]
    });

    var dataTableMarca = $("#tabla_producto_marca").DataTable({
        language: {
            url: '../js/Spanish.json'
        },
        responsive: true,
        pageLength: 3,
        lengthChange: false,
        searching: false,
        columnDefs: [
            {
                targets: [0],
                visible: false,
            }
        ]
    });


    $(document).on("click", ".editar-product", function () {

        $(this).addClass("active");

        var idproducto = $(this).data("idproducto");

        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'POST',
            data: { 'op': 'productos_listar_id', 'idproducto': idproducto },
            dataType: 'json',
            success: function (response) {
                if (response.status) {
                    var producto = response.data[0];
                    $("#idproducto").val(idproducto);
                    $("#Nombreproducto").text(producto.nombreproducto);
                    $("#stock").text(producto.stock);
                    
                    $("#modal-agregarP").modal("show");
                } else {
                    console.error(response.message);
                }
            },
        });
    });


    $("#tabla_producto_venta tbody").on("click", "tr", function () {
            var nombreProducto = $(this).find("td:eq(1)").text();
            $("#buscar-producto").val(nombreProducto).trigger("input");

    });


    $("#buscar-producto").on("input", function () {
        var filtro = $(this).val();

        productos_listar_ventas(filtro);


        productos_listar_por_categoria(filtro);
       

        var valor = $(this).val();
        if (valor !== "") {
            $("#clear-input").show();
        } else {
            $("#clear-input").hide();
        }
    });

    $("#clear-input").on("click", function () {
        $("#buscar-producto").val("");
        productos_listar_ventas("");
        productos_listar_por_categoria(""); 
    });
    
    function productos_registrar() {
        const idproducto = $("#idproducto").val().trim();
        const unidad = $("#unidad").val().trim(); 
        const cantidad = $("#cantidad").val().trim();
    
        if (idproducto === '' || unidad === '' || cantidad === '' || parseInt(cantidad) <= 0) {
            stockInsuficiente();
        } else {
            $.ajax({
                url: '../controllers/ventas.controller.php',
                type: 'POST',
                data: { 'op': 'productos_listar_id', 'idproducto': idproducto },
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        var producto = response.data[0];
                        var stockDisponible = producto.stock;
    
                        // Validar según la unidad seleccionada
                        var cantidadAComparar = 0;
    
                        if (unidad === 'unidad') {
                            cantidadAComparar = parseInt(cantidad);
                        } else if (unidad === 'blister') {
                            // Validar que haya suficiente stock teniendo en cuenta nblister
                            cantidadAComparar = parseInt(cantidad) * parseInt(producto.nblister);
                            if (cantidadAComparar > parseInt(stockDisponible)) {
                                stockInsuficiente();
                                return;  // Salir de la función si hay insuficiencia de stock
                            }
                        } else if (unidad === 'caja') {
                            // Validar que haya suficiente stock teniendo en cuenta ncaja
                            cantidadAComparar = parseInt(cantidad) * parseInt(producto.ncaja);
                            if (cantidadAComparar > parseInt(stockDisponible)) {
                                stockInsuficiente();
                                return;  // Salir de la función si hay insuficiencia de stock
                            }
                        }
    
                        // Resto del código para agregar el producto a la lista
                        const senData = {
                            'op': 'registrar_producto_lista',
                            'idproducto': $("#idproducto").val(),
                            'unidad': $("#unidad").val(),
                            'cantidad': $("#cantidad").val(),
                        };
    
                        $.ajax({
                            url: '../controllers/ventas.controller.php',
                            type: 'POST',
                            data: senData,
                            success: function (response) {
                                $("#productos")[0].reset();
                                $("#modal-agregarP").modal('hide');
    
                                // Actualizar la tabla de productos
                                productos_listar_ventas("");
                                productos_listar_por_categoria(""); 
                                productos_listar();
    
                                toastFinalizar("Agregado correctamente");
                            }
                        });
                    }
                },
            });
        }
    }
    
    
    function productos_registrar() {
        const idproducto = $("#idproducto").val().trim();
        const unidad = $("#unidad").val().trim(); 
        const cantidad = $("#cantidad").val().trim();
    
        if (idproducto === '' || unidad === '' || cantidad === '' || parseInt(cantidad) <= 0) {
            stockInsuficiente();
        } else {
            $.ajax({
                url: '../controllers/ventas.controller.php',
                type: 'POST',
                data: { 'op': 'productos_listar_id', 'idproducto': idproducto },
                dataType: 'json',
                success: function (response) {
                    if (response.status) {
                        var producto = response.data[0];
                        var stockDisponible = producto.stock;
    
                        // Validar según la unidad seleccionada
                        var cantidadAComparar = 0;
    
                        if (unidad === 'unidad') {
                            cantidadAComparar = parseInt(cantidad);
                        } else if (unidad === 'blister') {
                            cantidadAComparar = parseInt(cantidad) * parseInt(producto.nblister);
                        } else if (unidad === 'caja') {
                            cantidadAComparar = parseInt(cantidad) * parseInt(producto.ncaja);
                        }
    
                        if (cantidadAComparar > parseInt(stockDisponible)) {
                            stockInsuficiente();
                        } else {
                            // Agregar el producto a la lista
                            const senData = {
                                'op': 'registrar_producto_lista',
                                'idproducto': $("#idproducto").val(),
                                'unidad': $("#unidad").val(),
                                'cantidad': $("#cantidad").val(),
                            };
    
                            $.ajax({
                                url: '../controllers/ventas.controller.php',
                                type: 'POST',
                                data: senData,
                                success: function (response) {
                                    $("#productos")[0].reset();
                                    $("#modal-agregarP").modal('hide');
    
                                    // Actualizar la tabla de productos
                                    productos_listar_ventas("");
                                    productos_listar_por_categoria(""); 
                                    productos_listar();
    
                                    toastFinalizar("Agregado correctamente");
                                }
                            });
                        }
                    }
                },
            });
        }
    }
    
    

    $("#cancelar").on("click", function () {
        $("#buscar-producto").val("");
        productos_listar_ventas("");
        productos_listar_por_categoria(""); 
    });


    $(document).on("click", ".eliminar-fila", function () {
        var iddetalleventa = $(this).data("iddetalleventa");
        var row = $(this).closest("tr");

        mostrarPreguntaDesactivar().then((result) => {
            if (result.isConfirmed) {
                $.ajax({
                    url: '../controllers/ventas.controller.php',
                    type: 'POST',
                    data: { 'op': 'eliminarProducto', 'iddetalleventa': iddetalleventa },
                    dataType: 'json',
                    success: function (result) {
                        if (result.status) {
                            row.remove();
                            productos_listar();
                            $("#buscar-producto").val("");
                            productos_listar_ventas("");
                            productos_listar_por_categoria(""); 
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

                data.clear().rows.add($("#tabla_producto tbody tr")).draw();
  
            }
        })
    }

    var data = $("#tabla_producto ").DataTable({
        language: {
            url: '../js/Spanish.json'
        },
        responsive: true,
        pageLength: 3,
        lengthChange: false,
        searching: false,
        paging: false,
        order: [[0, 'desc']],
        columnDefs:[
            {
                targets: [0],
                visible: false,
            }
        ]
       
    });


    function calcularMontoTotal() {
        var montoTotal = 0;
    
        $("#tabla_producto tbody tr").each(function () {
            var precioTotal = parseFloat($(this).data("precio-total")) || 0;
            montoTotal += precioTotal;
        });
    
        console.log("Monto Total Calculado:", montoTotal);
    
        $("#monto_total").val(montoTotal.toFixed(2));
    }


    function calcularVuelto() {
        var montoTotal = parseFloat($("#monto_total").val()) || 0;
        var pago = parseFloat($("#pago").val()) || 0;
    
        // Verificar que el pago sea mayor o igual al monto total
        if (pago >= montoTotal) {
            // Calcular el vuelto solo si el pago es mayor o igual al monto total
            var vuelto = pago - montoTotal;
    
            // Actualizar el campo de vuelto
            $("#vuelto").val(vuelto.toFixed(2));
        } else {
            // Si el pago es menor al monto total, mostrar vuelto como cero
            $("#vuelto").val("0.00");
        }
    }
    
    $("#pago").on("input", function () {
        // Solo calcular el vuelto si el campo de pago es mayor o igual a cero
        if (parseFloat($(this).val()) >= 0) {
            calcularVuelto();
        }
    });
    
    
    $("#guardar").on("click", function () {
        console.log("Antes de productos_registrar");
        productos_registrar();
        console.log("Después de productos_registrar");

        setTimeout(function () {
            calcularMontoTotal();
            calcularVuelto();
        }, 100);

       
    });
    

    calcularMontoTotal();
    calcularVuelto();
    cargarUsuarios();
    productos_listar();
    productos_listar_ventas("");
    
    
});