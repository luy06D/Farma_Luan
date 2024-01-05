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
    WHERE productos.estado = '1' AND (nombreP = '' OR productos.nombreproducto LIKE CONCAT(nombreP, '%'));
END $$

DELIMITER $$
CREATE PROCEDURE spu_listar_productoid(IN p_idproducto INT)
BEGIN 
    SELECT 
        nombreproducto,		
        stock
    FROM productos
    WHERE idproducto = p_idproducto;
END $$


CREATE TABLE ventaTemporal
(
	iddetalleventa  INT AUTO_INCREMENT PRIMARY KEY,
	idproducto	INT 		NOT NULL,
	idventa		INT 		NOT NULL,
	cantidad	SMALLINT 	NOT NULL,
	unidadproducto 	VARCHAR(30)	NOT NULL,
	preciototal	DECIMAL(6,2) 	NOT NULL,
	CONSTRAINT fk_idp_v FOREIGN KEY (idproducto) REFERENCES productos (idproducto),
	CONSTRAINT fk_idv_v FOREIGN KEY (idventa) REFERENCES ventas (idventa)
)
ENGINE=INNODB;

DELIMITER $$
CREATE PROCEDURE agregarProductoALaLista(
    IN p_idproducto  INT,
    IN p_cantidad    SMALLINT
)
BEGIN
    DECLARE v_precio DECIMAL(6,2);
    DECLARE v_precioTotal DECIMAL(6,2);
    DECLARE v_stock_actual INT;
    DECLARE v_ultimo_idventa INT;

    -- Obtener el último idventa
    SELECT MAX(idventa) INTO v_ultimo_idventa FROM ventas;

    -- Verificar si hay suficiente stock para agregar a la lista
    SELECT stock INTO v_stock_actual FROM productos WHERE idproducto = p_idproducto;

    IF v_stock_actual >= p_cantidad THEN
        -- Obtener el precio del producto
        SELECT precio INTO v_precio FROM productos WHERE idproducto = p_idproducto;

        -- Calcular el precio total
        SET v_precioTotal = v_precio * p_cantidad;

        -- Verificar si el producto ya está en la lista temporal
        IF EXISTS (SELECT 1 FROM ventaTemporal WHERE idproducto = p_idproducto AND idventa = v_ultimo_idventa) THEN
            -- El producto ya está en la lista, actualizar cantidad y precio total
            UPDATE ventaTemporal
            SET cantidad = cantidad + p_cantidad, preciototal = preciototal + v_precioTotal
            WHERE idproducto = p_idproducto AND idventa = v_ultimo_idventa;
        ELSE
            -- Agregar el producto a la lista temporal
            INSERT INTO ventaTemporal (idproducto, idventa, cantidad, unidadproducto, preciototal)
            VALUES (p_idproducto, v_ultimo_idventa, p_cantidad, 'unidad', v_precioTotal);
        END IF;

        -- Verificar si el producto ya está en la lista de ventas
        IF EXISTS (SELECT 1 FROM detalleVentas WHERE idproducto = p_idproducto AND idventa = v_ultimo_idventa) THEN
            -- El producto ya está en la lista, actualizar cantidad y precio total
            UPDATE detalleVentas
            SET cantidad = cantidad + p_cantidad, preciototal = preciototal + v_precioTotal
            WHERE idproducto = p_idproducto AND idventa = v_ultimo_idventa;
        ELSE
            -- Agregar el producto a la lista de ventas
            INSERT INTO detalleVentas (idproducto, idventa, cantidad, unidadproducto, preciototal)
            VALUES (p_idproducto, v_ultimo_idventa, p_cantidad, 'unidad', v_precioTotal);
        END IF;

        -- Actualizar el stock del producto
        UPDATE productos
        SET stock = stock - p_cantidad
        WHERE idproducto = p_idproducto;
    END IF;
END $$



DELIMITER $$
CREATE PROCEDURE ListarLiderDetalleVenta()
BEGIN
    SELECT 
        vt.iddetalleventa,
        p.nombreproducto AS nombre_producto,
        u.nomusuario AS nombre_usuario,
        vt.cantidad,
        vt.unidadproducto,
        vt.preciototal
    FROM 
        ventaTemporal vt
    INNER JOIN productos p ON vt.idproducto = p.idproducto
    INNER JOIN ventas v ON vt.idventa = v.idventa
    INNER JOIN usuarios u ON v.idusuario = u.idusuario;
END $$

DELIMITER $$
CREATE PROCEDURE RealizarPago(
    IN p_tipopago VARCHAR(20),
    IN p_monto DECIMAL(6,2)
)
BEGIN
    DECLARE v_ultimo_idventa INT;
    DECLARE v_totalVenta DECIMAL(6,2);
    DECLARE v_cambio DECIMAL(6,2);

    -- Obtener el último idventa
    SELECT MAX(idventa) INTO v_ultimo_idventa FROM ventas;

    -- Calcular el total de la venta sumando los preciototal de los productos
    SELECT SUM(preciototal) INTO v_totalVenta
    FROM detalleVentas
    WHERE idventa = v_ultimo_idventa;

    -- Verificar si el monto ingresado es suficiente para cubrir la venta
    IF p_monto >= v_totalVenta THEN
        -- Calcular el cambio
        SET v_cambio = p_monto - v_totalVenta;

        -- Registrar el pago
        INSERT INTO pagos (idventa, tipopago, fechapago, montototal, pago, cambio)
        VALUES (v_ultimo_idventa, p_tipopago, NOW(), v_totalVenta, p_monto, v_cambio);
    ELSE
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'El monto ingresado no es suficiente para cubrir la venta.';
    END IF;
END $$


CALL RealizarPago('Efectivo', 20.00);

-- PROCEDIMINETO spu_productos_listar_ventas
CALL  spu_productos_listar_ventas('amoxi');

-- PROCEDIMINETO agregarProductoALaLista
CALL agregarProductoALaLista(1, 1);
CALL agregarProductoALaLista(2, 1);

CALL ListarLiderDetalleVenta();


-- lISTAR PRODUCTOS
SELECT * FROM ventaTemporal;
SELECT * FROM detalleVentas;
SELECT * FROM pagos;
 

-- PROCEDIMINETO finalizarVenta
CALL finalizarVenta();



