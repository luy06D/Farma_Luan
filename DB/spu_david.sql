USE farma_luan;

-- PROCEDIMIENTOS PRODUCTOS

-- LISTAR PRODUCTOS / PDF STOCK
DELIMITER $$
CREATE PROCEDURE spu_productos_listar()
BEGIN 

SELECT 	PRO.idproducto, PRO.nombreproducto, CA.nombrecategoria,
	PRO.stock,PRO.estado, PRO.precio, PRO.fechaproduccion,
	PRO.fechavencimiento, PRO.recetamedica
FROM productos PRO
INNER JOIN categorias CA ON CA.idcategoria = PRO.idcategoria;
END $$

CALL spu_productos_listar()

-- REGISTRAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_productos_registrar
(
IN _idcategoria INT,
IN _idunidad	INT,
IN _nombreproducto VARCHAR(40),
IN _descripcion	    VARCHAR(150),
IN _stock	    SMALLINT,
IN _precio	    SMALLINT,
IN _fechaproduccion	DATE,
IN _fechavencimiento	DATE,
IN _numlote		INT,
IN _recetamedica	VARCHAR(15)
)
BEGIN 

INSERT INTO productos (idcategoria, idunidad, nombreproducto, descripcion, stock, precio, fechaproduccion, fechavencimiento, numlote, recetamedica) VALUES
		(_idcategoria, _idunidad, _nombreproducto, _descripcion, _stock, _precio, _fechaproduccion, _fechavencimiento, _numlote, _recetamedica);

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
IN _idcategoria INT,
IN _nombreproducto VARCHAR(40),
IN _descripcion	    VARCHAR(150),
IN _precio	    DECIMAL(5,2),
IN _fechaproduccion	DATE,
IN _fechavencimiento	DATE,
IN _numlote		INT,
IN _recetamedica	VARCHAR(15)

)
BEGIN 

	UPDATE productos SET
	idcategoria 	= _idcategoria,
	nombreproducto 	= _nombreproducto,
	descripcion 	= _descripcion,
	precio 		= _precio,
	fechaproduccion = _fechaproduccion,
	fechavencimiento = _fechavencimiento,
	numlote 	= _numlote,
	recetamedica 	= _recetamedica	
	WHERE idproducto = _idproducto;

END $$

CALL spu_productos_update(1, 1, 'Paracetamol', 'Analgesia para aliviar el dolor', 5.99, '2022-01-01', '2025-01-01', 12345, 'No requiere');

-- GET PRODUCTOS

DELIMITER $$
CREATE PROCEDURE spu_getProductos(IN _idproducto INT)
BEGIN

SELECT 	PRO.idproducto, PRO.stock, PRO.nombreproducto,CA.idcategoria, UN.idunidad,
	PRO.stock,PRO.estado, PRO.precio, PRO.fechaproduccion,
	PRO.fechavencimiento, PRO.numlote, PRO.recetamedica, PRO.descripcion
FROM productos PRO
INNER JOIN categorias CA ON CA.idcategoria = PRO.idcategoria
INNER JOIN unidades UN ON UN.idunidad = PRO.idunidad
WHERE PRO.idproducto = _idproducto;

END $$


-- REGISTRAR COMPRAS
DELIMITER $$
CREATE PROCEDURE spu_compra_registrar
(
IN _idusuario INT,
IN _idproducto INT,
IN _cantidad SMALLINT,
IN _preciocompra DECIMAL(7,2)
)
BEGIN 
	DECLARE idcompra_g INT;
	
	INSERT INTO compraProductos (idusuario) VALUES
		(_idusuario);
		
	SELECT LAST_INSERT_ID() INTO idcompra_g;
	
	INSERT INTO detalleCompras (idproducto, idcompraproducto, cantidad, preciocompra) VALUES
			(_idproducto, idcompra_g, _cantidad, _preciocompra);
			
	UPDATE productos SET stock = stock + _cantidad
	WHERE idproducto = _idproducto;
	
	UPDATE productos SET estado = 
		CASE
		WHEN stock > 0 THEN 'Disponible'
		ELSE 'Agotado'
		END
	WHERE idproducto = _idproducto;

END $$

CALL spu_compra_registrar(1, 1, 2, 2);

SELECT * FROM compraProductos
SELECT * FROM productos

