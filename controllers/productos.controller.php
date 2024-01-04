<?php

require_once '../models/Producto.php';


if(isset($_POST['op'])){
    $productos = new Productos();

    if($_POST['op'] == 'registrar_producto'){
        $data = [
            "idcategoria"       => $_POST['idcategoria'],
            "nombreproducto"    => $_POST['nombreproducto'],
            "descripcion"       => $_POST['descripcion'],
            "precio"            => $_POST['precio'],
            "fechaproduccion"   => $_POST['fechaproduccion'],
            "fechavencimiento"  => $_POST['fechavencimiento'],
            "numlote"           => $_POST['numlote'],
            "recetamedica"      => $_POST['recetamedica'],
        ];

        $respuesta = $productos->productos_registrar($data);
        echo json_encode($respuesta);
    }

       
    if($_POST['op'] == 'getCategorias'){

        echo json_encode($productos->get_categorias());
    }

}

if(isset($_GET['op'])){

    $productos = new Productos();

    if($_GET['op'] == 'productos_listar'){
        $data = $productos->productos_listar();

        if($data){
            foreach($data as $list){
                echo "
                <tr>
                <td>{$list['idproducto']}</td>
                <td>{$list['nombreproducto']}</td>
                <td>{$list['nombrecategoria']}</td>
                <td>{$list['stock']}</td>
                <td>{$list['precio']}</td>
                <td>{$list['fechavencimiento']}</td>
                <td>{$list['recetamedica']}</td>                                    
                <td>                
                <a class=' btn btn-outline-success btn-sm' data-idcontrato ='{$list['idproducto']}' ><i class='bi bi-plus-circle-dotted'></i></a>                  
               </td>                                             
            </tr>
                
                
                ";
            }
        }
    }
}

?>