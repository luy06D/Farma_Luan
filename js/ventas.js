$(document).ready(function () {

    

    function productos_listar_ventas(filtro) {
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: { 'op': 'productos_listar_ventas', 'filtro': filtro },
            success: function (result) {
                $("#tabla_producto_venta tbody").html(result);

                dataTable.clear().rows.add($("#tabla_producto_venta tbody tr")).draw();
                

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
        const cantidad = $("#cantidad").val().trim();

        if (idproducto === '' || cantidad === '' || parseInt(cantidad) <= 0) {
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

                        if (parseInt(stockDisponible) < parseInt(cantidad)) {
                            stockInsuficiente();
                        } else {
                            const senData = {
                                'op': 'registrar_producto_lista',
                                'idproducto': $("#idproducto").val(),
                                'cantidad': $("#cantidad").val(),
                            };

                            $.ajax({
                                url: '../controllers/ventas.controller.php',
                                type: 'POST',
                                data: senData,
                                success: function (response) {
                                    $("#productos")[0].reset();
                                    $("#modal-agregarP").modal('hide');
                                    
                                    $("#guardar").on("click", function () {
                                        $("#buscar-producto").val("");
                                    });


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
        order: [[0, 'desc']],
        columnDefs:[
            {
                targets: [0],
                visible: false,
            }
        ]
       
    });

    $("#guardar").click(productos_registrar);

    productos_listar();
    productos_listar_ventas("");
});