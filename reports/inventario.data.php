<div style="position: relative;">
    <h1 class="text-center text-md mb-4 mt-3">Reporte Inventario</h1>
    <h3 class="text-center text-md mb-5">"Farma Luan"</h3>
    <!-- <img src="" alt="" class="logo mb-5" style="position: absolute; top: 10px; left: 20px;"> -->
    <!-- <label for="" class=" fecha mt-5">Contratos del ''<?=$fechainicio?>'' al ''<?=$fechafin?>''</label> -->
</div>

<table class="table table-border text-center">
    <colgroup>
        <col style="width: 19%;">
        <col style="width: 17% ;">
        <col style="width: 10%;">
        <col style="width: 12%;">
        <col style="width: 14%;">
        <col style="width: 14%;">
        <col style="width: 14%;">
    </colgroup>

    <thead class="table-cabez">
        <tr>
        <th>Producto</th>
        <th>Categoria</th>
        <th>Stock</th>
        <th>Precio</th>
        <th>Fecha producción</th>   
        <th>Fecha vencimiento</th> 
        <th>Receta médica</th> 
        </tr>            
    </thead>
    <tbody>
        
    <?php foreach($data as $registro): ?>
        <tr>
      
            <td><?=$registro['nombreproducto']?></td> 
            <td><?=$registro['nombrecategoria']?></td>
            <td><?=$registro['stock']?></td>
            <td><?=$registro['precio']?></td>
            <td><?=$registro['fechaproduccion']?></td>
            <td><?=$registro['fechavencimiento']?></td>
            <td><?=$registro['recetamedica']?></td>        
      
        </tr>

    <?php endforeach;?>
    
    </tbody>

</table>