<?php

require_once '../models/Venta.php';


if(isset($_GET['op'])){

    $ventas = new Ventas();

    if($_GET['op'] == 'productos_listar_ventas'){
        $filtro = isset($_GET['filtro']) ? $_GET['filtro'] : '';

        $data = $ventas->productos_listar_ventas($filtro);

        if($data){
            foreach($data as $listar){
                echo "
                <tr>
                <td>{$listar['idproducto']}</td>
                <td>{$listar['nombreproducto']}</td>
                <td>{$listar['nombrecategoria']}</td>
                <td>{$listar['stock']}</td>
                <td>{$listar['precio']}</td>
                <td>{$listar['fechavencimiento']}</td>
                <td>{$listar['recetamedica']}</td>                                    
                <td>                
                <a class=' btn btn-outline-success btn-sm' data-idcontrato ='{$listar['idproducto']}' ><i class='bi bi-plus-circle-dotted'></i></a>                  
               </td>                                             
            </tr>
                
                
                ";
            }
        }
    } 
    

}
