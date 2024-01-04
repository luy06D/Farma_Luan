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


-- Tabla temporal para la lista de productos
CREATE TABLE listaProductos
(
    idproducto      INT,
    nombreproducto  VARCHAR(40),
    cantidad        SMALLINT,
    preciototal     DECIMAL(7,2)
)
ENGINE=INNODB;


DELIMITER $$
CREATE PROCEDURE agregarProductoALaLista(
    IN p_idproducto INT,
    IN p_cantidad   SMALLINT
)
BEGIN
    DECLARE v_precio DECIMAL(5,2);
    DECLARE v_precioTotal DECIMAL(7,2);
    DECLARE v_stock_actual INT;
    DECLARE v_nombre_producto VARCHAR(40);

    -- Obtener el nombre del producto
    SELECT nombreproducto INTO v_nombre_producto FROM productos WHERE idproducto = p_idproducto;

    -- Obtener el precio del producto
    SELECT precio INTO v_precio FROM productos WHERE idproducto = p_idproducto;

    -- Obtener el stock actual del producto
    SELECT stock INTO v_stock_actual FROM productos WHERE idproducto = p_idproducto;

    -- Verificar si hay suficiente stock para agregar a la lista
    IF v_stock_actual >= p_cantidad THEN
        -- Calcular el precio total
        SET v_precioTotal = v_precio * p_cantidad;

        -- Verificar si el producto ya está en la lista temporal
        IF EXISTS (SELECT 1 FROM listaProductos WHERE idproducto = p_idproducto) THEN
            -- El producto ya está en la lista, actualizar cantidad y precio total
            UPDATE listaProductos
            SET cantidad = cantidad + p_cantidad, preciototal = preciototal + v_precioTotal
            WHERE idproducto = p_idproducto;
        ELSE
            -- Agregar el producto a la lista temporal
            INSERT INTO listaProductos (idproducto, nombreproducto, cantidad, preciototal)
            VALUES (p_idproducto, v_nombre_producto, p_cantidad, v_precioTotal);
        END IF;

        -- Actualizar el stock del producto
        UPDATE productos
        SET stock = stock - p_cantidad
        WHERE idproducto = p_idproducto;
    END IF;
END $$



-- PROCEDMINETO finalizarVenta
DELIMITER $$
CREATE PROCEDURE finalizarVenta()
BEGIN
    -- Limpiar
    DELETE FROM listaProductos;
END $$


-- PROCEDIMINETO spu_productos_listar_ventas
CALL  spu_productos_listar_ventas('amoxicilin');

-- PROCEDIMINETO agregarProductoALaLista
CALL agregarProductoALaLista(1, 2);
CALL agregarProductoALaLista(3, 1);

-- lISTAR PRODUCTOS
SELECT * FROM listaProductos;

-- PROCEDIMINETO finalizarVenta
CALL finalizarVenta();



