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

    
    if($_POST['op'] == 'actualizar_producto'){
        $data = [
            "idproducto"       => $_POST['idproducto'],
            "idcategoria"       => $_POST['idcategoria'],
            "nombreproducto"    => $_POST['nombreproducto'],
            "descripcion"       => $_POST['descripcion'],
            "precio"            => $_POST['precio'],
            "fechaproduccion"   => $_POST['fechaproduccion'],
            "fechavencimiento"  => $_POST['fechavencimiento'],
            "numlote"           => $_POST['numlote'],
            "recetamedica"      => $_POST['recetamedica'],
        ];

        $respuesta = $productos->productos_actualizar($data);
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
                <td>S/.{$list['precio']}</td>
                <td>{$list['estado']}</td>
                <td>{$list['fechaproduccion']}</td>
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