<?php
require_once '../models/Unidades.php';

if(isset($_GET['op'])){

    $unidades = new Unidades();

    if($_GET['op'] == 'unidades_listar'){
        $data = $unidades->unidades_listar();

        if($data){
            foreach($data as $list){
                echo "
            <tr>
                <td>{$list['idunidad']}</td>
                <td>{$list['unidadmedida']}</td>                                    
                <td>                               
                <a class='editar-unidad btn btn-warning btn-sm' data-bs-toggle='modal' data-bs-target='#modal-editarunidad' data-idunidad ='{$list['idunidad']}'><i class='bi bi-pencil-square'></i></a>
               </td>                                             
            </tr>
   
                ";
                
            }
        }
    }
}

?>