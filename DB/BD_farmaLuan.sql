DROP DATABASE IF EXISTS farma_luan;
CREATE DATABASE farma_luan;
USE farma_luan;

CREATE TABLE personas
(
idpersona 	INT AUTO_INCREMENT PRIMARY KEY,
nombres		VARCHAR(30)	NOT NULL,
apellidos	VARCHAR(30)	NOT NULL
)
ENGINE=INNODB;

INSERT INTO personas (nombres, apellidos) VALUES
('Jesus','Camacho Carrasco'),
('Luis David','Cusi Gonzales'),
('Alejandro','Gallardo Yañez');


CREATE TABLE usuarios
(
idusuario	INT AUTO_INCREMENT PRIMARY KEY,
idpersona	INT 		NOT NULL,
nomusuario	VARCHAR(20) 	NOT NULL,
claveacceso	VARCHAR(100)	NOT NULL,
estado		CHAR(1)		NOT NULL DEFAULT '1',
nivelacceso	VARCHAR(20)     NOT NULL, 
CONSTRAINT uk_nom_usu UNIQUE (nomusuario),
CONSTRAINT fk_idp_usu FOREIGN KEY (idpersona) REFERENCES personas (idpersona)
)
ENGINE=INNODB;

INSERT INTO usuarios (idpersona, nomusuario, claveacceso, nivelacceso) VALUES
	(1, 'Jesu_04', '200418', 'admin'),
	(2, 'Luy_06', '060903', 'admin'),
	(3, 'Alej_08', '200418', 'admin');
	


CREATE TABLE unidades
(
idunidad	INT AUTO_INCREMENT PRIMARY KEY,
unidadmedida	VARCHAR(10) NOT NULL,
CONSTRAINT uk_uni_uni UNIQUE(unidadmedida)
)
ENGINE = INNODB;

INSERT INTO unidades (unidadmedida) VALUES
('mg'),
('g'),
('mcg'),
('ml'),
('UI');


CREATE TABLE productos 
(
idproducto		INT AUTO_INCREMENT PRIMARY KEY,
idunidad		INT 		NOT NULL,
nombreproducto		VARCHAR(50) 	NOT NULL,
nombrecategoria		VARCHAR(50)     NOT NULL,
descripcion		VARCHAR(150)	NULL,
stock			SMALLINT	NOT NULL DEFAULT 0 ,
precio			DECIMAL(5,2)	NOT NULL,
fechaproduccion		DATE		NULL,
fechavencimiento	DATE		NULL,	
recetamedica		VARCHAR(15)	NOT NULL, -- REQUIERE , NO REQUIERE
estado 			VARCHAR(10)	NOT NULL DEFAULT 'Agotado',
create_at		DATETIME 	NOT NULL DEFAULT NOW(),
update_at		DATETIME	NULL,
inactive_at		DATETIME 	NULL,
CONSTRAINT fk_idu_pro FOREIGN KEY (idunidad) REFERENCES unidades(idunidad),
CONSTRAINT uk_nom_pro UNIQUE(nombreproducto),
CONSTRAINT ck_pre_pro CHECK (precio > 0)
)
ENGINE = INNODB;

INSERT INTO productos (idunidad, nombreproducto, nombrecategoria, descripcion, stock, precio, fechaproduccion, fechavencimiento, recetamedica)VALUES 
(1, 'Paracetamol', 'Paracetamol', 'Analgesia para aliviar el dolor', 100, 5.99, '2022-01-01', '2025-01-01', 'No requiere'),
(2, 'Amoxicilina', 'Amoxicilina', 'Antibiótico para tratar infecciones', 100, 12.99, '2022-02-01', '2025-02-01', 'Requiere'),
(3, 'Ibuprofeno', 'Ibuprofeno', 'Antiinflamatorio para reducir la inflamación', 100, 7.50, '2022-03-01', '2026-03-01', 'No requiere'),
(4, 'GriPachek', 'GriPachek', 'Analgesia para aliviar el dolor', 100, 5.99, '2022-01-01', '2025-01-01', 'No requiere'),

(1, 'Cetamol', 'Paracetamol', 'Antibiótico para tratar infecciones', 100, 12.99, '2022-02-01', '2025-02-01', 'Requiere'),
(2, 'Cilina', 'Amoxicilina', 'Antiinflamatorio para reducir la inflamación', 10, 7.50, '2022-03-01', '2026-03-01', 'No requiere'),
(3, 'Profeno', 'Ibuprofeno', 'Analgesia para aliviar el dolor', 100, 5.99, '2022-01-01', '2025-01-01', 'No requiere'),
(4, 'Pachek', 'GriPachek', 'Antibiótico para tratar infecciones', 100, 12.99, '2022-02-01', '2025-02-01', 'Requiere'),

(1, 'Ceta', 'Paracetamol', 'Antiinflamatorio para reducir la inflamación', 100, 7.50, '2022-03-01', '2026-03-01', 'No requiere'),
(2, 'Moxilona', 'Amoxicilina', 'Analgesia para aliviar el dolor', 100, 5.99, '2022-01-01', '2025-01-01', 'No requiere'),
(3, 'Uprofeno', 'Ibuprofeno', 'Antibiótico para tratar infecciones', 100, 12.99, '2022-02-01', '2025-02-01', 'Requiere'),
(4, 'Ipachek', 'GriPachek', 'Antiinflamatorio para reducir la inflamación', 100, 7.50, '2022-03-01', '2026-03-01', 'No requiere');



CREATE TABLE compraProductos
(
idcompraproducto	INT AUTO_INCREMENT PRIMARY KEY,
idusuario		INT	NOT NULL,
fechacompra		DATE	NOT NULL DEFAULT NOW(),
CONSTRAINT fk_idu_com FOREIGN KEY(idusuario) REFERENCES usuarios (idusuario)
)
ENGINE = INNODB;



CREATE TABLE detalleCompras
(
iddetallecompra INT AUTO_INCREMENT PRIMARY KEY,
idproducto 	 INT 		NOT NULL,
idcompraproducto INT 		NOT NULL,
cantidad 	 SMALLINT 	NOT NULL,
preciocompra	 DECIMAL(7,2)	NOT NULL,
fechadetalleC	 DATE 		NOT NULL DEFAULT NOW(),
CONSTRAINT fk_idpro_det FOREIGN KEY (idproducto) REFERENCES productos (idproducto),
CONSTRAINT fk_idc_det FOREIGN KEY (idcompraproducto) REFERENCES compraProductos (idcompraproducto)
)
ENGINE=INNODB;


CREATE TABLE ventas
(
idventa		INT AUTO_INCREMENT PRIMARY KEY,
idusuario 	INT 	NOT NULL, 
fechaventa 	DATE 	NOT NULL DEFAULT NOW(),
CONSTRAINT fk_idu_ven FOREIGN KEY (idusuario) REFERENCES usuarios (idusuario)
)	
ENGINE=INNODB;

INSERT INTO ventas (idusuario)VALUES
	(1);
	
INSERT INTO ventas (idusuario)VALUES
	(1);

CREATE TABLE detalleVentas
(
iddetalleventa  INT AUTO_INCREMENT PRIMARY KEY,
idproducto	INT 		NOT NULL,
idventa		INT 		NOT NULL,
cantidad	SMALLINT 	NOT NULL,
unidadproducto 	VARCHAR(30)	NOT NULL,
preciototal	DECIMAL(6,2) 	NOT NULL,
CONSTRAINT fk_idp_det FOREIGN KEY (idproducto) REFERENCES productos (idproducto),
CONSTRAINT fk_idv_det FOREIGN KEY (idventa) REFERENCES ventas (idventa)
)
ENGINE=INNODB;
 
CREATE TABLE pagos
(
idpago 		INT AUTO_INCREMENT PRIMARY KEY,
idventa 	INT 		NOT NULL,
tipopago 	VARCHAR(20) 	NOT NULL,
fechapago 	DATE 		NOT NULL DEFAULT NOW(),
montototal	DECIMAL(6,2)	NULL,
pago		DECIMAL(6,2)	NULL,
cambio		DECIMAL(6,2)	NULL,
CONSTRAINT fk_idv_pag FOREIGN KEY (idventa) REFERENCES ventas (idventa)  
)	
ENGINE=INNODB;


CREATE TABLE ganancias 
(
idganancia	INT AUTO_INCREMENT PRIMARY KEY,
iddetalleventa	INT  		NOT NULL,
montototal	DECIMAL(7,2) 	NOT NULL,
CONSTRAINT fk_idd_idg FOREIGN KEY (iddetalleventa) REFERENCES detalleVentas (iddetalleventa)
)
ENGINE = INNODB;

CREATE TABLE transacciones
(
idtransaccione		INT AUTO_INCREMENT PRIMARY KEY,
idganancia		INT 		NOT NULL,
tipotransaccion		VARCHAR(30) 	NOT NULL,
detalletransaccion	VARCHAR(50)	NOT NULL,
fechatransaccion	DATE		NOT NULL DEFAULT NOW(),
CONSTRAINT fk_idg FOREIGN KEY (idganancia) REFERENCES ganancias (idganancia)
)
ENGINE = INNODB;
















