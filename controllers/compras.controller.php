<?php
require_once '../models/Compras.php';

if(isset($_POST['op'])){

    $compras = new Compras();

    if($_POST['op'] == 'registrar_compra'){

        $data = [
            "idusuario"     => $_POST['idusuario'],
            "tipocomprobante" => $_POST['tipocomprobante'],
            "numlote"       => $_POST['numlote'],
            "numfactura"    => $_POST['numfactura'],

        ];

        $respuesta = $compras->compras_registrar($data);

        if($respuesta["status"]){
            $respuesta["idcompraproducto"] = $respuesta["idcompraproducto"]; 
        }
        
        echo json_encode($respuesta);
    }

    if($_POST['op'] == 'registrar_detalleC'){

        $data = [
            "idproducto"        => $_POST['idproducto'],
            "idcompraproducto"  => $_POST['idcompraproducto'],
            "cantidad"          => $_POST['cantidad'],
            "preciocompra"      => $_POST['preciocompra'],

        ];

        $respuesta = $compras->detalleC_registrar($data);
        echo json_encode($respuesta);
    }

 

}

if(isset($_GET['op'])){

    $compras = new Compras();

    
    if($_GET['op'] == 'producto_buscar'){
        
        $data = $compras->buscar_productos($_GET['buscar']);
        echo json_encode($data);
    }

}

?>