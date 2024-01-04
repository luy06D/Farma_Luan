USE farma_luan;

-- PROCEDIMIENTOS PRODUCTOS

-- LISTAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_productos_listar()
BEGIN 

SELECT 	PRO.idproducto, PRO.nombreproducto, CA.nombrecategoria,
	PRO.stock, PRO.precio,
	PRO.fechavencimiento, PRO.recetamedica
FROM productos PRO
INNER JOIN categorias CA ON CA.idcategoria = PRO.idcategoria
WHERE PRO.estado = '1';
END $$

CALL spu_productos_listar()

-- REGISTRAR PRODUCTOS
DELIMITER $$
CREATE PROCEDURE spu_productos_registrar
(
IN _idcategoria INT,
IN _nombreproducto VARCHAR(40),
IN _descripcion	    VARCHAR(150),
IN _precio	    SMALLINT,
IN _fechaproduccion	DATE,
IN _fechavencimiento	DATE,
IN _numlote		INT,
IN _recetamedica	VARCHAR(15)
)
BEGIN 

INSERT INTO productos (idcategoria, nombreproducto, descripcion, precio, fechaproduccion, fechavencimiento, numlote, recetamedica) VALUES
		(_idcategoria, _nombreproducto, _descripcion, _precio, _fechaproduccion, _fechavencimiento, _numlote, _recetamedica);

END $$

