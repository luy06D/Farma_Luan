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
                })
                
            }
        })
    }

    // REGISTRAR PRODUCTOS
    function productos_registrar(){
        
    }


    productos_listar();
})