$(document).ready(function () {

    // LISTAR PRODUCTOS
    function productos_listar_ventas(filtro) {
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: { 'op': 'productos_listar_ventas', 'filtro': filtro },
            success: function (result) {
                $("#tabla-producto_venta tbody").html(result);
                productos_listar();
            }
        });
    }

    // Evento de escucha para el input de búsqueda
    $("#buscar-producto").on("input", function () {
        var filtro = $(this).val();
        productos_listar_ventas(filtro);
    });

    function productos_listar(){
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: {'op' : 'lista_productos'},
            success: function (result){
                $("#tabla_producto tbody").html(result);
                $("#tabla_producto").DataTable({
                    language:{
                        url: '../js/Spanish.json'
                    }
                })
                
            }
        })
    }

    productos_listar_ventas("");
});

