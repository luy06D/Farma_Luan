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
            "idproducto"    => $_POST['idproducto'],
            "cantidad"      => $_POST['cantidad'],
            "preciocompra"  => $_POST['preciocompra'],

        ];
    }

    $respuesta = $compras->compras_registrar($data);
    echo json_encode($respuesta);

}

if(isset($_GET['op'])){

    $compras = new Compras();

    
    if($_GET['op'] == 'producto_buscar'){
        
        $data = $compras->buscar_productos($_GET['buscar']);
        echo json_encode($data);
    }

}

?>