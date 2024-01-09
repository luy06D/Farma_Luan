$(document).ready(function(){

    let searchTimer;
    
    // REGISTRAR COMPRAS PRODUCTOS
    function compras_productos(){
        
    }

    // BUSCAR PRODUCTOS
    function buscar_producto(){      
        //cronometrar 
    clearTimeout(searchTimer);
        
    searchTimer = setTimeout(function (){
        const searchTerm = $("#b-producto").val();
          
        if(searchTerm.trim() === ""){
  
        $("#producto_buscado").empty();
        return;
  
        }
  
        $.ajax({
        url:'../controllers/compras.controller.php',
        type: 'GET',
        dataType: 'JSON',
        data: {
        'op': 'producto_buscar',
        'buscar': $("#b-producto").val()
        },
        success: function(result){  
            console.log(result)                     
        $("#producto_buscado").empty();
  
        if(result.length > 0){
  
            for(let i=0 ; i < result.length; i++){
            const producto = result[i];
            const cardProducto = `
                <div class="card mb-2">
                    <div class="card-body">
                        <h5 class="card-title">${producto.nombreproducto}</h5>
                        <p class="card-text">Categoria: ${producto.nombrecategoria}</p>  
                        <p class="card-text">Descripción: ${producto.descripcion}</p>                                        
                        <button type="button" class="btn btn-success select-producto" value="${producto.idproducto}">Seleccionar</button>
                    </div>
                </div>
            `;

            $("#producto_buscado").append(cardProducto);
            }
  
            $(".select-producto").click(function () {
            idproducto = $(this).val();     
            selecProducto = $(this).closest(".card").find(".card-title").text();             

            $("#modal-productoB").modal('hide');
             $("#b-producto").val(""); 
            $("#producto_buscado").empty();

            agregar_producto(idproducto, selecProducto);


  
            })
  
        }else {
            $("#producto_buscado").html("<p>No se encontro el producto </p>");
        }
        }
    })
    }, 100);
    
    };


    function agregar_producto(idproducto, selecProducto){

        const $tabla = $("#tbody-productoCompra");
        const $filas = $tabla.find("#tr");

           // Crea un nuevo input para ingresar datos
        const inputCantidad = $("<input>")
        .attr("type", "number")
        .attr("placeholder", "Cantidad")
        .addClass("form-control");

        const inputPrecioC = $("<input>")
        .attr("type", "number")
        .attr("placeholder", "Precio")
        .addClass("form-control");

        const link = $("<a>")
        .addClass("btn btn-outline-danger btn-sm quitar")
        .append("<i class='bi bi-trash'></i");


        $tabla.append(
            "<tr><td style='display: none;'>" + idproducto + "</td><td>"
            + selecProducto + "</td><td>"          
            + inputCantidad.prop('outerHTML') + "</td><td>"
            + inputPrecioC.prop('outerHTML') + "</td><td>"
            + link.prop('outerHTML') + "</td></tr>"
          );
        
    }



    $("#b-producto").keyup(buscar_producto);

      //Evento click al boton para quitar en compras
  $("#tbody-productoCompra").on("click" , ".quitar", function (){
    $(this).closest("tr").remove();

  });



})