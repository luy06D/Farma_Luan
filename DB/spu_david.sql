USE farma_luan;

-- PROCEDIMIENTOS PRODUCTOS

-- LISTAR PRODUCTOS / PDF STOCK
DELIMITER $$
CREATE PROCEDURE spu_productos_listar()
BEGIN 

SELECT 	PRO.idproducto, PRO.nombreproducto, nombrecategoria,
	PRO.stock,PRO.estado, PRO.precio, unidadmedida,
	PRO.fechavencimiento, PRO.fechaproduccion, PRO.recetamedica
FROM productos PRO
INNER JOIN unidades UN ON UN.idunidad = PRO.idunidad;
END $$

CALL spu_productos_listar();


-- REGISTRAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_productos_registrar
(
IN _idunidad	INT,
IN _nombreproducto VARCHAR(50),
IN _nombrecategoria VARCHAR(50),
IN _descripcion	    VARCHAR(150),
IN _stock	    SMALLINT,
IN _precio	    SMALLINT,
IN _fechaproduccion	DATE,
IN _fechavencimiento	DATE,
IN _recetamedica	VARCHAR(15)
)
BEGIN 

INSERT INTO productos (idunidad, nombreproducto, nombrecategoria, descripcion, stock, precio, fechaproduccion, fechavencimiento, recetamedica) VALUES
		(_idunidad, _nombreproducto, _nombrecategoria, _descripcion, _stock, _precio, _fechaproduccion, _fechavencimiento, _recetamedica);

	UPDATE productos SET estado = 
        CASE
            WHEN stock > 0 THEN 'Disponible'
            ELSE 'Agotado'
        END
	WHERE idproducto = LAST_INSERT_ID();
END $$



-- ACTUALIZAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_productos_update
(
IN _idproducto	INT,
IN _idunidad    INT,
IN _nombreproducto VARCHAR(50),
IN _nombrecategoria VARCHAR(50),
IN _descripcion	    VARCHAR(150),
IN _precio	    SMALLINT,
IN _fechaproduccion	DATE,
IN _fechavencimiento	DATE,
IN _recetamedica	VARCHAR(15)
)
BEGIN 

	UPDATE productos SET
	idunidad	= _idunidad,	
	nombreproducto 	= _nombreproducto,
	nombrecategoria = _nombrecategoria,
	descripcion	= _descripcion,
	precio 		= _precio,
	fechaproduccion = _fechaproduccion,
	fechavencimiento = _fechavencimiento,	
	recetamedica 	= _recetamedica	
	WHERE idproducto = _idproducto;

END $$

CALL spu_productos_update(1, 1, 'Paracetamol', 'Analgesia para aliviar el dolor', 5.99, '2022-01-01', '2025-01-01', 12345, 'No requiere');

-- GET PRODUCTOS

DELIMITER $$
CREATE PROCEDURE spu_getProductos(IN _idproducto INT)
BEGIN

SELECT 	PRO.idproducto, PRO.stock, PRO.nombreproducto, PRO.nombrecategoria, UN.idunidad,
	PRO.stock,PRO.estado, PRO.precio, PRO.fechaproduccion,
	PRO.fechavencimiento, PRO.recetamedica, PRO.descripcion
FROM productos PRO
INNER JOIN unidades UN ON UN.idunidad = PRO.idunidad
WHERE PRO.idproducto = _idproducto;

END $$

CALL spu_getProductos(13);

-- BUSCAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_producto_buscar(IN _buscar VARCHAR(100))
BEGIN 
	SELECT 	PRO.idproducto, PRO.stock, PRO.nombreproducto, PRO.descripcion,
		PRO.nombrecategoria,UN.idunidad,
		PRO.stock,PRO.estado, PRO.precio, PRO.fechaproduccion,
		PRO.recetamedica
	FROM productos PRO
	INNER JOIN unidades UN ON UN.idunidad = PRO.idunidad
	WHERE PRO.nombreproducto LIKE CONCAT('%',_buscar,'%');
END $$
CALL spu_producto_buscar('para');


-- REGISTRAR COMPRAS
DELIMITER $$
CREATE PROCEDURE spu_compra_registrar
(

IN _idusuario INT,
IN _tipocomprobante VARCHAR(20),
IN _numlote	INT,
IN _numfactura INT
)
BEGIN 
	
	INSERT INTO compraProductos (idusuario, tipocomprobante, numlote, numfactura) VALUES
		(_idusuario, _tipocomprobante, _numlote, _numfactura);
		
	SELECT LAST_INSERT_ID() AS idcompraproducto;

END $$

-- REGISTRAR DETALLE DE COMPRAS
DELIMITER $$
CREATE PROCEDURE spu_detalleC_registrar
(
IN _idproducto INT,
IN _idcompraproducto INT,
IN _cantidad SMALLINT,
IN _preciocompra DECIMAL(7,2)
)
BEGIN

	INSERT INTO detalleCompras (idproducto, idcompraproducto, cantidad, preciocompra) VALUES
			(_idproducto, _idcompraproducto, _cantidad, _preciocompra);
			
	UPDATE productos SET stock = stock + _cantidad
	WHERE idproducto = _idproducto;
	
	UPDATE productos SET estado = 
		CASE
		WHEN stock > 0 THEN 'Disponible'
		ELSE 'Agotado'
		END
	WHERE idproducto = _idproducto;

END $$ 

SELECT * FROM compraProductos
SELECT * FROM detalleCompras
SELECT * FROM usuarios


