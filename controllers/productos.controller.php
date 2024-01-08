<?php

require_once '../models/Producto.php';


if(isset($_POST['op'])){
    $productos = new Productos();

    if($_POST['op'] == 'registrar_producto'){
        $data = [            
            "idunidad"          => $_POST['idunidad'],
            "nombreproducto"    => $_POST['nombreproducto'],
            "nombrecategoria"    => $_POST['nombrecategoria'],
            "descripcion"       => $_POST['descripcion'],
            "stock"             => $_POST['stock'],
            "precio"            => $_POST['precio'],
            "fechaproduccion"   => $_POST['fechaproduccion'],
            "fechavencimiento"  => $_POST['fechavencimiento'],            
            "recetamedica"      => $_POST['recetamedica'],
        ];

        $respuesta = $productos->productos_registrar($data);
        echo json_encode($respuesta);
    }

    
    if($_POST['op'] == 'actualizar_producto'){
        $data = [
            "idproducto"        => $_POST['idproducto'],     
            "idunidad"           => $_POST['idunidad'],                    
            "nombreproducto"    => $_POST['nombreproducto'],
            "nombrecategoria"   => $_POST['nombrecategoria'],
            "descripcion"       => $_POST['descripcion'],
            "precio"            => $_POST['precio'],
            "fechaproduccion"   => $_POST['fechaproduccion'],
            "fechavencimiento"  => $_POST['fechavencimiento'],            
            "recetamedica"      => $_POST['recetamedica'],
        ];

        $respuesta = $productos->productos_actualizar($data);
        echo json_encode($respuesta);
    }


    if($_POST['op'] == 'getUnidades'){

        echo json_encode($productos->get_unidades());
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
                <td>S/.{$list['precio']}</td>
                <td>{$list['estado']}</td>
                <td>{$list['unidadmedida']}</td>
                <td>{$list['fechavencimiento']}</td>
                <td>{$list['recetamedica']}</td>                                    
                <td>                
                <a class='compras btn btn-success btn-sm' data-idcontrato ='{$list['idproducto']}' ><i class='bi bi-cart-plus'></i></a>                  
                <a class='editar-product btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-editarequipo' data-idproducto ='{$list['idproducto']}'><i class='bi bi-pencil-square'></i></a>
               </td>                                             
            </tr>
                
                
                ";
            }
        }
    }

    if($_GET['op'] == 'get_productos'){
        $data = $productos->get_productos($_GET['idproducto']);
        echo json_encode($data);
    }
}

?>