USE farma_luan;

-- PROCEDIMIENTOS VENTAS

DELIMITER $$
CREATE PROCEDURE spu_productos_listar_ventas(IN nombreP VARCHAR(255))
BEGIN 
    SELECT 
        productos.idproducto, 
        productos.nombreproducto,		
        categorias.nombrecategoria,
        productos.stock, 
        productos.precio,
        productos.fechavencimiento, 
        productos.recetamedica
    FROM productos 
    INNER JOIN categorias ON categorias.idcategoria = productos.idcategoria
    WHERE productos.estado = '1' AND (nombreP = '' OR productos.nombreproducto LIKE CONCAT(nombreP, '%'))
    ORDER BY productos.nombreproducto;
END $$






CALL  spu_productos_listar_ventas('amoxicilin');


