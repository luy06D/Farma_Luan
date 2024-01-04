$(document).ready(function () {

    // LISTAR PRODUCTOS
    function productos_listar_ventas(filtro) {
        $.ajax({
            url: '../controllers/ventas.controller.php',
            type: 'GET',
            data: { 'op': 'productos_listar_ventas', 'filtro': filtro },
            success: function (result) {
                $("#tabla-producto_venta tbody").html(result);
            }
        });
    }

    // Evento de escucha para el input de búsqueda
    $("#buscar-producto").on("input", function () {
        var filtro = $(this).val();
        productos_listar_ventas(filtro);
    });

    // ...

    productos_listar_ventas("");
});

