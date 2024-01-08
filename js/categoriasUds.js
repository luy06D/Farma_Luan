$(document).ready(function(){


    // LISTAR PRODUCTOS
    function unidades_listar(){
        $.ajax({
            url: '../controllers/unidades.controller.php',
            type: 'GET',
            data: {'op' : 'unidades_listar'},
            success: function (result){
                var table = $("#table-unidades").DataTable();
                table.destroy();
                $("#table-unidades tbody").html(result);
                $("#table-unidades").DataTable({
                    language:{
                        url: '../js/Spanish.json'
                    },
                    responsive: true,
                    pageLength: 5, 
                    lengthChange: false,
                    order: [[0, 'desc']],

            

                })
                
            }
        })
    }

    unidades_listar();


})