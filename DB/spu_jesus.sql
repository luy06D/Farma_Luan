USE farma_luan;



-- PROCEDIMIENTOS VENTAS
DELIMITER $$
CREATE PROCEDURE listarUsuario()
BEGIN
    SELECT nomusuario FROM usuarios
    ORDER BY idusuario;
END $$




DELIMITER $$
CREATE PROCEDURE RegistrarVenta(
    IN nombreUsuario VARCHAR(20)
)
BEGIN
    DECLARE usuarioID INT;


    SELECT idusuario INTO usuarioID FROM usuarios WHERE nomusuario = nombreUsuario;


    IF usuarioID IS NOT NULL THEN

        INSERT INTO ventas (idusuario, fechaventa) VALUES (usuarioID, NOW());
    END IF;
END $$


DELIMITER $$
CREATE PROCEDURE spu_productos_listar_ventas(IN nombreP VARCHAR(40))
BEGIN 
    SELECT 
        idproducto, 
        nombreproducto,		
	nombrecategoria,
        stock, 
        precioUnitario,
        precioBlister,
        nblister,
	precioCaja,
        ncaja,
	fechavencimiento, 
        recetamedica
    FROM productos 
    WHERE nombreP = '' OR productos.nombreproducto LIKE CONCAT(nombreP, '%');
END $$


CALL  spu_productos_listar_ventas('paracetam');

DELIMITER $$
CREATE PROCEDURE spu_productos_categoria(IN categoriaP VARCHAR(50))
BEGIN
    SELECT 
        idproducto, 
        nombreproducto,		
	nombrecategoria,
        stock, 
        precioUnitario,
        precioBlister,
        nblister,
	precioCaja,
        ncaja,
	fechavencimiento, 
        recetamedica
    FROM productos
    WHERE nombrecategoria = categoriaP AND nombreproducto <> categoriaP;
END $$


CALL spu_productos_categoria ('paracetamol');

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
    IN p_unidad      VARCHAR(10),
    IN p_cantidad    SMALLINT
)
BEGIN
    DECLARE v_precio DECIMAL(5,2);
    DECLARE v_precioTotal DECIMAL(5,2);
    DECLARE v_stock_actual INT;
    DECLARE v_cantidad_real SMALLINT;
    DECLARE v_ultimo_idventa INT;
    DECLARE v_nblister INT;
    DECLARE v_ncaja INT;

    -- Obtener el último idventa
    SELECT MAX(idventa) INTO v_ultimo_idventa FROM ventas;

    -- Verificar si hay suficiente stock para agregar a la lista
    SELECT stock, nblister, ncaja INTO v_stock_actual, v_nblister, v_ncaja FROM productos WHERE idproducto = p_idproducto;

    IF v_stock_actual > 0 THEN
        -- Calcular la cantidad real según la unidad
        CASE
            WHEN p_unidad IN ('unidad', 'blister', 'caja') THEN
                -- Para 'unidad', 'blister' y 'caja', se mantiene la misma lógica
                SET v_cantidad_real = p_cantidad;
            ELSE
                -- Manejar otro caso según sea necesario
                SET v_cantidad_real = 0;
        END CASE;

        -- Ajustar la cantidad real según el tipo de unidad
        IF p_unidad = 'blister' THEN
            SET v_cantidad_real = v_cantidad_real * v_nblister;  -- Ajustar la cantidad según nblister
        ELSEIF p_unidad = 'caja' THEN
            SET v_cantidad_real = v_cantidad_real * v_ncaja;  -- Ajustar la cantidad según ncaja
        END IF;

        -- Obtener el precio del producto según la unidad
        CASE
            WHEN p_unidad = 'unidad' THEN
                SELECT precioUnitario INTO v_precio FROM productos WHERE idproducto = p_idproducto;
            WHEN p_unidad = 'blister' THEN
                SELECT precioBlister INTO v_precio FROM productos WHERE idproducto = p_idproducto;
            WHEN p_unidad = 'caja' THEN
                SELECT precioCaja INTO v_precio FROM productos WHERE idproducto = p_idproducto;
            ELSE
                -- Manejar otro caso según sea necesario
                SET v_precio = 0;
        END CASE;

        -- Calcular el precio total
        IF p_unidad = 'blister' THEN
            SET v_precioTotal = v_precio * (v_cantidad_real / v_nblister); -- Ajustar precio total según cantidad real por blister
        ELSEIF p_unidad = 'caja' THEN
            SET v_precioTotal = v_precio * (v_cantidad_real / v_ncaja); -- Ajustar precio total según cantidad real por caja
        ELSE
            SET v_precioTotal = v_precio * v_cantidad_real;
        END IF;

        -- Verificar si el producto ya está en la lista temporal
        IF EXISTS (SELECT 1 FROM ventaTemporal WHERE idproducto = p_idproducto AND idventa = v_ultimo_idventa AND unidadproducto = p_unidad) THEN
            -- El producto ya está en la lista, actualizar cantidad y precio total
            UPDATE ventaTemporal
            SET cantidad = cantidad + p_cantidad, preciototal = preciototal + v_precioTotal
            WHERE idproducto = p_idproducto AND idventa = v_ultimo_idventa AND unidadproducto = p_unidad;
        ELSE
            -- Agregar el producto a la lista temporal
            INSERT INTO ventaTemporal (idproducto, idventa, cantidad, unidadproducto, preciototal)
            VALUES (p_idproducto, v_ultimo_idventa, p_cantidad, p_unidad, v_precioTotal);
        END IF;

        -- Verificar si el producto ya está en la lista de ventas
        IF EXISTS (SELECT 1 FROM detalleVentas WHERE idproducto = p_idproducto AND idventa = v_ultimo_idventa AND unidadproducto = p_unidad) THEN
            -- El producto ya está en la lista, actualizar cantidad y precio total
            UPDATE detalleVentas
            SET cantidad = cantidad + p_cantidad, preciototal = preciototal + v_precioTotal
            WHERE idproducto = p_idproducto AND idventa = v_ultimo_idventa AND unidadproducto = p_unidad;
        ELSE
            -- Agregar el producto a la lista de ventas
            INSERT INTO detalleVentas (idproducto, idventa, cantidad, unidadproducto, preciototal)
            VALUES (p_idproducto, v_ultimo_idventa, p_cantidad, p_unidad, v_precioTotal);
        END IF;

        -- Actualizar el stock del producto
        UPDATE productos
        SET stock = stock - v_cantidad_real
        WHERE idproducto = p_idproducto;
    END IF;
END $$

CALL agregarProductoALaLista(1, 'unidad', 1);
CALL agregarProductoALaLista(1, 'unidad', 7);




DELIMITER $$
CREATE PROCEDURE ListarLiderDetalleVenta()
BEGIN
    SELECT 
        iddetalleventa,
        nombreproducto AS nombre_producto,
        nomusuario AS nombre_usuario,
        cantidad,
        unidadproducto,
        preciototal
    FROM  ventaTemporal 
    INNER JOIN productos ON ventaTemporal.idproducto = productos.idproducto
    INNER JOIN ventas ON ventaTemporal.idventa = ventas.idventa
    INNER JOIN usuarios ON ventas.idusuario = usuarios.idusuario
    WHERE cantidad > 0;  
END $$  

DELIMITER $$

CREATE PROCEDURE eliminarProducto(
    IN p_iddetalleventa INT
)
BEGIN
    DECLARE v_idproducto INT;
    DECLARE v_cantidad INT;
    DECLARE v_unidadproducto VARCHAR(10);
    DECLARE v_nblister INT;
    DECLARE v_ncaja INT;


    SELECT idproducto, cantidad, unidadproducto INTO v_idproducto, v_cantidad, v_unidadproducto
    FROM ventaTemporal
    WHERE iddetalleventa = p_iddetalleventa;

    -- Verificar si el registro existe en la lista temporal
    IF v_idproducto IS NOT NULL THEN
        -- Obtener los valores de nblister y ncaja del producto
        SELECT nblister, ncaja INTO v_nblister, v_ncaja FROM productos WHERE idproducto = v_idproducto;

        -- Devolver la cantidad al stock de productos según la unidadproducto
        CASE
            WHEN v_unidadproducto = 'blister' THEN
                UPDATE productos
                SET stock = stock + (v_cantidad * v_nblister)
                WHERE idproducto = v_idproducto;
            WHEN v_unidadproducto = 'caja' THEN
                UPDATE productos
                SET stock = stock + (v_cantidad * v_ncaja)
                WHERE idproducto = v_idproducto;
            ELSE
                -- Para unidad u otros casos, devolver la cantidad directamente
                UPDATE productos
                SET stock = stock + v_cantidad
                WHERE idproducto = v_idproducto;
        END CASE;


        DELETE FROM ventaTemporal WHERE iddetalleventa = p_iddetalleventa;


        DELETE FROM detalleVentas WHERE iddetalleventa = p_iddetalleventa;
    END IF;
END $$







CALL  eliminarProducto(3); 


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



CALL RealizarPago('Efectivo', 1000.00);

-- PROCEDIMINETO spu_productos_listar_ventas
CALL  spu_productos_listar_ventas('p');

-- PROCEDIMINETO agregarProductoALaLista
CALL agregarProductoALaLista(2, 'blister', 1 );
CALL agregarProductoALaLista(2, 1);

CALL ListarLiderDetalleVenta();


-- lISTAR PRODUCTOS
SELECT * FROM ventaTemporal;
SELECT * FROM detalleVentas;
SELECT * FROM pagos;
 

-- PROCEDIMINETO finalizarVenta
CALL finalizarVenta();

